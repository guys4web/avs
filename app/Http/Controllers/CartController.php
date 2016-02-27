<?php
namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;
use App\Country;
use App\Service;
use App\Visa;
use App\Product;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\ApplicationRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Passenger;
use App\Order;

use Sentinel;
use Mail;


class CartController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function create(ApplicationRequest $request)
    {
        $services = Service::join('service_visas', 'services.id', '=', 'service_visas.service_id')
                ->select('services.id', 'services.name', 'min_process', 'max_process')
                ->orderBy('min_process')
                ->orderBy('max_process')
                ->where('country_id', '=', $request->get('country'))
                ->groupBy('services.id')
                ->get();

        $service = $services->first();

        $states = DB::table('states')
                ->orderBy('name', 'asc')
                ->lists('name', 'id');

        $countries = Country::orderBy('name')->lists('name', 'id');

        $country = Country::find($request->get('country'));

        return View('apply', ['services' => $services->lists('title', 'id'),
                            'service' => $service,
                            'country' => $country,
                            'countries' => $countries,
                            'states' => $states]);
    }


    protected function _getCartTotal($cart)
    {
        $items = $cart->cartItems;
        $total=0;
        foreach($items as $item){
            $total+=$item->product->price*$item->quantity;
        }

        return $total;
    }

    protected function _createCart($force=false)
    {

        $user =  Sentinel::getUser();
        $cart = Cart::where('user_id',$user->id)->where('closed','!=',1)->orderBy('id', 'DESC')->first();

        if(!$cart){

            if($force==true)
            {
                return null;
            }

            $cart =  new Cart();
            $cart->user_id=$user->id;
            $cart->save();
        }


        return $cart;
    }


    public function payment(Request $request)
    {
        $user = Sentinel::getUser();
        $cart = $this->_createCart();
        if(!$cart){
            return redirect("/");
        }
        $total = $this->_getCartTotal($cart);
        if($cart->payment_type=="cc")
        {
            return redirect()->route("prepare_payment",["currencycode"=>"DOLLAR","amt"=>$total]);
        }
        else
        {
          $request->session()->put('payment_data',serialize(array()))
          return redirect()->route("cart_done");
        }

    }

    public function addItem (Request $request,$productId){

        #check service
        $product = Product::find($productId);
        if(!$product){
            return redirect()->route("home")->with("error","No product select");
        }


        $qty = $request->get("qty",0);

        $user = Sentinel::getUser();
        $cart = $this->_createCart();
        $cart->payment_type = $request->get('payment_type');
        $cart->save();



        $expDate = $request->get('expDate-year','').'-'.$request->get('expDate-month','');
        $request->session()->put('cardnum',$request->get('cardnum',''));
        $request->session()->put('expDate',$expDate);
        $request->session()->put('ccv',$request->get('ccv',''));
        $request->session()->put('bname',$request->get('bname',''));
        $request->session()->put('bcity',$request->get('bcity',''));
        $request->session()->put('baddress',$request->get('baddress',''));
        $request->session()->put('bstate',$request->get('bstate',''));
        $request->session()->put('postal',$request->get('postal',''));



        $cartItem  = new Cartitem();
        $cartItem->product_id=$productId;
        $cartItem->cart_id= $cart->id;
        $cartItem->quantity = $qty;
        $cartItem->track_num = $request->get('track_num','');
        $cartItem->carrier = $request->get('carrier','');
        $cartItem->unit_price = $product->price;
        $cartItem->save();

        for($i=0;$i<$qty;$i++)
        {
            if(!$request->has("passenger_id-".$i))
            {

                $birthdate = $request->get("year-dob-".$i).'-'.$request->get("month-dob-".$i).'-'.$request->get("day-dob-".$i);
                $passport_expirate = $request->get("year-passportExp-".$i).'-'.$request->get("month-passportExp-".$i).'-'.$request->get("day-passportExp-".$i);
                $passenger = Passenger::create(['first_name'=>$request->get("fname-".$i),
                                              'last_name'=>$request->get("lname-".$i),
                                              'gender'=>$request->get("gender-".$i),
                                              'birthdate'=>$birthdate,
                                              'passport_num'=>$request->get("passport-".$i),
                                              'passport_expirate'=>$passport_expirate
                            ]);
            }

            $passenger->cartitem()->attach($cartItem);
        }


        return redirect('/cart');

    }

    public function showCart(){

        $user = Sentinel::getUser();
        $cart = $this->_createCart(true);
        if($cart==null){
            return redirect()->route("home");
        }

        $items = $cart->cartItems;
        $total=$this->_getCartTotal($cart);

        return view('cart.view',['items'=>$items,'total'=>$total,'cart'=>$cart]);

    }

    public function removeItem($id){

        CartItem::destroy($id);
        return redirect('/cart');
    }


    public function done(Request $request)
    {
        if($request->session()->has('payment_data'))
        {
            $cart = $this->_createCart(true);
            if($cart==null){
                return redirect()->route("home");
            }

            $billing_data = [
                "bcity" => $request->session()->pull('bcity',"") ,
                "baddress" => $request->session()->pull('baddress',"") ,
                "bstate" => $request->session()->pull('bstate',"") ,
                "postal" => $request->session()->put('postal',"")
            ];

            $order = new Order();
            $order->user_id = Sentinel::getUser()->id;
            $order->cart_id = $cart->id;
            $order->payment_data = $request->session()->pull("payment_data");
            $order->billing_data = $billing_data;
            $order->save();
            $cart->closed = 1 ;
            $cart->save();

            $user = Sentinel::getUser();

            Mail::send('emails.checkout', ['user' => $user , 'order'=>$order  ], function ($m) use ($user) {
                $m->from('lalainatest@gmail.com', 'Test');
                $m->to("mohamahm2001@yahoo.com","Admin")->subject('New order');
                $m->to("lalainatest@gmail.com","Test")->subject('New order');
            });

            return view("cart.done",["order"=>$order,"cart"=>$cart]);
        }

        return redirect()->route("home")->with("error","no valide payment");
    }


    public function passengers(Request $request)
    {
        $id = $request->get("id",0);
        $user = Sentinel::getUser();
        $cart = Cart::find($id);

        if(!$cart){
          return "" ;
        }
        if($cart->user_id!=$user->id){
          return "" ;
        }

        return view("partials.passengers",["cart"=>$cart]);

    }

}
