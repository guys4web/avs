<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visa;
use App\Country;
use App\Service;
use App\Product;


use App\Http\Requests;
use App\Http\Controllers\Controller;

class VisasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminIndex()
    {
       $visas = Visa::all();

       $countries = Country::orderBy('name')->get();

        return View('admin.visas', [
                            'visas' => $visas ,
                            'countries' => $countries
                            ]);
    }



    public function findByService($serviceId)
    {
        $visas = Visa::join('service_visas', 'visas.id', '=', 'service_visas.visa_id')
                ->orderBy('price')
                ->where('service_id', '=', $serviceId)
                ->get();

        return \Response::json(array(
            'status' => 'success',
            'data' => iterator_to_array($visas)
        ));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $visa = new Visa();
        $visa->name = $request->get("name");
        $visa->description = $request->get("description","");
        $visa->save();

        $service = Service::findOrFail($request->get("service",0));

        $product = new Product;
        $product->visa_id = $visa->id;
        $product->service_id = $service->id;
        $product->price = $request->get('price',0);
        $product->save();

        return redirect()->action("VisasController@adminIndex")->with('message','Visa added');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $visa = Visa::findOrFail($id);
        $countries = Country::orderBy('name')->get();
        return view("admin.visa_show",["visa"=>$visa,"countries"=>$countries]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect()->action("VisasController@show",['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
