<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use DB;
use App\Service;
use App\Country;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminIndex()
    {
        $services = Service::join('countries', 'services.country_id', '=', 'countries.id')
                             ->select('services.id', 'services.name', 'min_process', 'max_process', 'countries.name as country')
                             ->orderBy('services.min_process')->get();

        return View('admin.services', [
            'services' => $services ,
            'countries' => Country::all()
        ]);
    }

    public function countries($country)
    {
        $services = Service::leftJoin('service_visas', 'services.id', '=', 'service_visas.service_id')
              ->select('services.id', 'services.name', 'min_process', 'max_process')
              ->orderBy('min_process')
              ->orderBy('max_process')
              ->where('country_id', '=', $country)
              ->groupBy('services.id')
              ->get();


        return response()->json($services);  

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get('name');
        $country = $request->get('country');
        $min = $request->get('min');
        $max = $request->get('max');
        
        $service = new Service;
        $service->name = $name;
        $service->country_id = $country;
        $service->min_process = (int)$min;
        $service->max_process = (int)$max;
        $service->save();
        
        return redirect()->action("ServicesController@adminIndex");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    
    public function  delete()
    {
        
    }
}
