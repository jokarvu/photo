<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Permission;
use App\Role;
use App\Http\Requests\RoleStoreRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('list-role')) {
            $roles = Role::all();
            return Response::json($roles);
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('add-role')) {
            $permissions = Permission::all();
            return Response::json($permissions);    
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        if (Auth::user()->can('add-role')) {
            $role = new Role();
            $role->name = $request->input('name');
            $role->description = $request->input('description');
            if ($role->save()) {
                // TODO: attach permission to role if neccessary + form request update
                return Response::json(['message' => 'Role has been added']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        if (Auth::user()->can('view-role')) {
            $role = Role::whereName($name)->first();
            if ($role) {
                $permission = $role->permissions();
                $users = $role->users();
                return Response::json(compact(['permission', 'users', 'role']));
            }
            return Response::json(['message' => 'Role not found'], 404);
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($name)
    {
        if (Auth::user()->can('edit-role')) {
            $role = Role::whereName($name)->first();
            if ($role) {
                $permissions = Permission::all();
                $role_permission = $role->permissions();
                return Response::json(compact(['permissions', 'role_permission', 'role']));
            }
            return Response::json(['message' => 'Role not found'], 404);
        }
        return Response::json(['message' => 'Permission denied'], 401);
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
        if (Auth::user()->can('edit-role')) {
            $role = Role::find($id);
            if ($role) {
                $role->name = $request->input('name');
                $role->description = $request->input('description');
                if ($role->save()) {
                    return Response::json(['message' => 'Role has been updated']);
                }
                return Response::json(['message' => 'Something went wrong'], 422);
            }
            return Response::json(['message' => 'Role not found'], 404);
        }
        return Response::json(['message' => 'Permission denied'], 401);
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
