<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Auth;
use App\User;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('list-user')) {
            $users = User::all();
            return Response::json($users);
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
        if (Auth::user()->can('add-user')) {
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
    public function store(UserStoreRequest $request)
    {
        if (Auth::user()->can('add-user')) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role_id = $request->role_id;
            $user->status = $request->status;
            if ($user->save()) {
                return Response::json(['message' => 'User has been added']);
            }
            return Response::json(['message' => 'Something went wrong'], 422);
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
        if (Auth::user()->can('view-user')) {
            $user = User::whereName($name)->first();
            if ($user) {
                $user->load('profile');
                return Response::json($user);
            }
            return Response::json(['message' => 'User not found'], 404);
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('edit-user')) {
            $user = User::find($id);
            if ($user) {
                $user->load('profile');
                return Response::json($user);
            }
            return Response::json(['message' => 'User not found'], 404);
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
        if (Auth::user()->can('edit-user')) {
            $user = User::find($id);
            if ($user) {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = $request->password;
                $user->role_id = $request->role_id;
                $user->status = $request->status;
                if ($user->save()) {
                    return Response::json(['message' => 'User has been updated']);
                }
                return Response::json(['message' => 'Something went wrong'], 422);
            }
            return Response::json(['message' => 'Permission denied'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('remove-user')) {
            $user = User::find($id);
            if ($user->delete()) {
                return Response::json(['message' => 'You has been removed']);
            }
            return Response::json(['message' => 'Something went wrong'], 422);
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }
}
