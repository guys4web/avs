<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Document;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class DocumentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$documents = Document::latest()->get();
		return view('admin.documents.index', compact('documents'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.documents.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		document::create($request->all());
		return redirect('admin/documents')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$document = Document::findOrFail($id);
		return view('admin.documents.show', compact('document'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$document = Document::findOrFail($id);
		return view('admin.documents.edit', compact('document'));
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
		$document = Document::findOrFail($id);
		$document->update($request->all());
		return redirect('admin/documents')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Document.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.documents.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Document.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$document = Document::destroy($id);

            // Redirect to the group management page
            return redirect('admin/documents')->with('success', Lang::get('message.success.delete'));

    	}

}