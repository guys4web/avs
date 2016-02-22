<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Requirement;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class RequirementsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$requirements = Requirement::latest()->get();
		return view('admin.requirements.index', compact('requirements'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.requirements.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		requirement::create($request->all());
		return redirect('admin/requirements')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$requirement = Requirement::findOrFail($id);
		return view('admin.requirements.show', compact('requirement'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$requirement = Requirement::findOrFail($id);
		return view('admin.requirements.edit', compact('requirement'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$requirement = Requirement::findOrFail($id);
		$requirement->update($request->all());
		return redirect('admin/requirements')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Requirement.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.requirements.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Requirement.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$requirement = Requirement::destroy($id);

            // Redirect to the group management page
            return redirect('admin/requirements')->with('success', Lang::get('message.success.delete'));

    	}

}