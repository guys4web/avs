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

use Sentinel;


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

    public function payment(Request $request)
    {

    }

    public function addItem (Request $request,$productId){

        #check service
        $product = Product::find($productId);
        if(!$product){
            return redirect()->route("home")->with("errors","No product select");
        }


        $qty = $request->get("qty",0);

        $user = Sentinel::getUser();
        $cart = Cart::where('user_id',$user->id)->first();

        if(!$cart){
            $cart =  new Cart();
            $cart->user_id=$user->id;
            $cart->save();
        }


        if($request->has('cardnum')){
            $request->session()->put('cardnum',$request->get('cardnum'));
            $request->session()->put('expDate',$request->get('expDate'));
            $request->session()->put('ccv',$request->get('ccv'));
            $request->session()->put('bname',$request->get('bname'));
            $request->session()->put('bcity',$request->get('bcity'));
            $request->session()->put('baddress',$request->get('baddress'));
            $request->session()->put('bstate',$request->get('bstate'));
            $request->session()->put('postal',$request->get('postal'));
        }

        $cartItem  = new Cartitem();
        $cartItem->product_id=$productId;
        $cartItem->cart_id= $cart->id;
        $cartItem->quantity = $qty;
        $cartItem->save();

        for($i=0;$i<$qty;$i++)
        {
            if(!$request->has("passenger_id-".$i))
            {
                $passenger = Passenger::create(['first_name'=>$request->get("fname-".$i),
                                              'last_name'=>$request->get("lname-".$i),
                                              'gender'=>$request->get("gender-".$i),
                                              'birthdate'=>$request->get("dob-".$i),
                                              'passport_num'=>$request->get("passport-".$i),
                                              'passport_expirate'=>$request->get("passportExp-".$i)
                            ]);
            }

            $passenger->cartitems()->attach($cartItem->getId());

        }


        return redirect('/cart');

    }

    public function showCart(){

        $user = Sentinel::getUser();
        $cart = Cart::where('user_id',$user->id)->first();

        if(!$cart){
            $cart =  new Cart();
            $cart->user_id=$user->id;
            $cart->save();
        }

        $items = $cart->cartItems;
        $total=0;
        $prices = [];
        foreach($items as $item){
            $prices[$item->id] = $item->product->price*$item->quantity;
            $total+=$prices[$item->id];
        }

        return view('cart.view',['prices'=>$prices,'items'=>$items,'total'=>$total,'cart'=>$cart]);

    }

    public function removeItem($id){

        CartItem::destroy($id);
        return redirect('/cart');
    }

}
