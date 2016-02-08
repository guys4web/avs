<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visa;

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
        $visas = Visa::join('service_visas', 'service_visas.visa_id', '=', 'visas.id')
                             ->join('services', 'service_visas.service_id', '=', 'services.id')
                             ->select('visas.id', 'visas.name', 'services.name as service_name', 'min_process', 'price')
                             ->orderBy('services.min_process')->get();

        return View('admin.visas', [
                            'visas' => $visas
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
        //
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
