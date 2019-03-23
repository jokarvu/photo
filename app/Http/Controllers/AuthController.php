<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\LoginRequest;
use Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->only(['email', 'password']);
        $remember = $request->input('remember');
        if (Auth::attempt($data, $remember)) {
            return Response::json(['message' => 'Logged in']);
        }
        return Response::json(['message' => 'Invalid email or password'], 422);
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return Response::json(['message' => 'Logged out']);
        }
        return Response::json(['message' => 'You have not logged in yet'], 403);
    }

    public function dashboard()
    {
        $dashboard = Auth::user()->role->dashboard;
        return Response::json($dashboard);
    }

    public function guest()
    {
        if (Auth::guest()) {
            return Response::json(['message' => 'true']);
        }
        return Response::json(['message' => 'false'], 403);
    }
}
