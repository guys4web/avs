<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Agent;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class AgentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$agents = Agent::latest()->get();
		return view('admin.agents.index', compact('agents'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.agents.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		agent::create($request->all());
		return redirect('admin/agents')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$agent = Agent::findOrFail($id);
		return view('admin.agents.show', compact('agent'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$agent = Agent::findOrFail($id);
		return view('admin.agents.edit', compact('agent'));
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
		$agent = Agent::findOrFail($id);
		$agent->update($request->all());
		return redirect('admin/agents')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Agent.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.agents.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Agent.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$agent = Agent::destroy($id);

            // Redirect to the group management page
            return redirect('admin/agents')->with('success', Lang::get('message.success.delete'));

    	}

}