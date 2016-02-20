<?php namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Input;
use Lang;
use Redirect;
use Sentinel;
use View;

class RolesController extends JoshController
{
    /**
     * Show a list of all the roles.
     *
     * @return View
     */
    public function index()
    {
        // Grab all the roles
        $roles = Sentinel::getRoleRepository()->all();

        // Show the page
        return View('admin/roles/index', compact('roles'));
    }

    /**
     * Role create.
     *
     * @return View
     */
    public function create()
    {
        // Show the page
        return View('admin/roles/create');
    }

    /**
     * Role create form processing.
     *
     * @return Redirect
     */
    public function store(RoleRequest $request)
    {

        if ($role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => Input::get('name'),
            'slug' => str_slug(Input::get('name'))
        ])
        ) {
            // Redirect to the new role page
            return Redirect::route('roles')->with('success', Lang::get('roles/message.success.create'));
        }

        // Redirect to the role create page
        return Redirect::route('create/role')->withInput()->with('error', Lang::get('roles/message.error.create'));
    }

    /**
     * Role update.
     *
     * @param  int $id
     * @return View
     */
    public function edit($id = null)
    {


        try {
            // Get the role information
            $role = Sentinel::findRoleById($id);

        } catch (RoleNotFoundException $e) {
            // Redirect to the roles management page
            return Redirect::route('roles')->with('error', Lang::get('roles/message.role_not_found', compact('id')));
        }

        // Show the page
        return View('admin/roles/edit', compact('role'));
    }

    /**
     * Role update form processing page.
     *
     * @param  int $id
     * @return Redirect
     */
    public function update($id = null, RoleRequest $request)
    {
        try {
            // Get the role information
            $role = Sentinel::findRoleById($id);
        } catch (RoleNotFoundException $e) {
            // Redirect to the roles management page
            return Rediret::route('roles')->with('error', Lang::get('roles/message.role_not_found', compact('id')));
        }

        // Update the role data
        $role->name = Input::get('name');

        // Was the role updated?
        if ($role->save()) {
            // Redirect to the role page
            return Redirect::route('roles')->with('success', Lang::get('roles/message.success.update'));
        } else {
            // Redirect to the role page
            return Redirect::route('update/role', $id)->with('error', Lang::get('roles/message.error.update'));
        }

    }

    /**
     * Delete confirmation for the given role.
     *
     * @param  int $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'roles';
        $confirm_route = $error = null;
        try {
            // Get role information
            $role = Sentinel::findRoleById($id);


            $confirm_route = route('delete/role', ['id' => $role->id]);
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        } catch (RoleNotFoundException $e) {

            $error = Lang::get('admin/roles/message.role_not_found', compact('id'));
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
    }

    /**
     * Delete the given role.
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id = null)
    {
        try {
            // Get role information
            $role = Sentinel::findRoleById($id);

            // Delete the role
            $role->delete();

            // Redirect to the role management page
            return Redirect::route('roles')->with('success', Lang::get('roles/message.success.delete'));
        } catch (RoleNotFoundException $e) {
            // Redirect to the role management page
            return Redirect::route('roles')->with('error', Lang::get('roles/message.role_not_found', compact('id')));
        }
    }

}
