<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\PermissionStoreRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Role;
use Auth;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('list-permission')) {
            $permissions = Permission::all();
            return Response::json($permissions);
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
        if (Auth::user()->can('add-permission')) {
            $roles = Role::all();
            return Response::json($roles);
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionStoreRequest $request)
    {
        if (Auth::user()->can('add-permission')) {
            $permission = new Permission();
            $permission->name = $request->input('name');
            $permission->description = $request->input('description');
            if ($permission->save()) {
                // TODO: attach roles to permission if neccessary
                if ($request->has('permission_roles')) {
                    $permission_roles = $request->input('permission_roles');
                    $permission->roles()->attach($permission_roles);
                }
                return Response::json(['message' => 'Permission has been added!']);
            }
            return Repsonse::json(['message' => 'Something went wrong'], 422);
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        if (Auth::user()->can('view-permission')) {
            $permission = Permission::whereName($name)->first();
            if ($permission) {
                $roles = $permission->roles()->get();
                return Response::json(compact(['permission', 'roles']));
            }
            return Response::json(['message' => 'Permission not found'], 404);
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
        if (Auth::user()->can('edit-permission')) {
            $permission = Permission::whereName($name)->first();
            if ($permission) {
                $roles = Role::all();
                $permission_roles = $permission->roles()->select('roles.id')->get(); 
                return Response::json(compact(['roles', 'permission_roles', 'permission']));
            }
            return Response::json(['message' => 'Permission not found'], 404);
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
    public function update(PermissionUpdateRequest $request, $id)
    {
        if (Auth::user()->can('edit-permission')) {
            $permission = Permission::find($id);
            if ($permission) {
                $permission->name = $request->input('name');
                $permission->description = $request->input('description');
                if ($permission->save()) {
                    // Update roles of permission
                    if ($request->has('permission_roles')) {
                        $permission_roles = $request->input('permission_roles');
                        $permission->roles()->sync($permission_roles);
                    }
                    return Response::json(['message' => 'Permission has been updated']);
                }
                return Response::json(['message' => 'Something went wrong'], 422);
            }
            return Response::json(['message' => 'Permission not found'], 404);
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
        if (Auth::user()->can('remove-permission')) {
            $permission = Permission::find($id);
            if ($permission) {
                if ($permission->delete()) {
                    return Response::json(['message' => 'Permission has been removed']);
                }
                return Response::json(['message' => 'Something went wrong'], 422);
            }
            return Response::json(['message' => 'Permission not found'], 404);
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }
}
