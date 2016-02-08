<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;
use App\Country;
use App\Service;
use App\Visa;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\ApplicationRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
class CartController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function create(ApplicationRequest $request)
    {
        $services = Service::join('service_visas', 'services.id', '=', 'service_visas.service_id')
                ->orderBy('min_process')
                ->orderBy('max_process')
                ->where('country_id', '=', $request->get('country'))
                ->groupBy('service_id')
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

        $cart = Cart::where('user_id',Auth::user()->id)->first();

        if(!$cart){
            $cart =  new Cart();
            $cart->user_id=Auth::user()->id;
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
        $cartItem->save();

        return redirect('/cart');

    }

    public function showCart(){
        $cart = Cart::where('user_id',Auth::user()->id)->first();

        if(!$cart){
            $cart =  new Cart();
            $cart->user_id=Auth::user()->id;
            $cart->save();
        }

        $items = $cart->cartItems;
        $total=0;
        foreach($items as $item){
            $total+=$item->product->price;
        }

        return view('cart.view',['items'=>$items,'total'=>$total]);
    }

    public function removeItem($id){

        CartItem::destroy($id);
        return redirect('/cart');
    }

}
