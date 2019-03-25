<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Option;
use Illuminate\Support\Facades\Response;
use Auth;
use App\Http\Requests\OptionStoreRequest;
use App\Http\Requests\OptionUpdateRequest;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Auth::user()->options()->get();
        return Response::json($options);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Response::json(['message' => 'Page not found'], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OptionStoreRequest $request)
    {
        if (Auth::user()->can('add-option')) {
            $option = new Option();
            $option->photographer_id = Auth::id();
            $option->name = $request->input('name');
            $option->price = $request->input('price');
            $option->description = $request->input('description');
            if ($option->save()) {
                return Response::json(['message' => 'Option has been added']);
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
    public function show($id)
    {
        if (Auth::user()->can('view-options')) {
            $option = Option::find($id);
            if ($option) {
                return Response::json($option);
            }
            return Response::json(['message' => 'Option not found'], 404);
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
        $option = Option::find($id);
        if (Auth::user()->can('edit-option') && Auth::user()->hasOption($option)) {
            return Response::json($option);
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
    public function update(OptionUpdateRequest $request, $id)
    {
        $option = Option::find($id);
        if (Auth::user()->can('edit-option') && Auth::user()->hasOption($option)) {
            $data = $request->only(['name', 'description', 'price']);
            if ($option->update($data)) {
                return Response::json(['message' => 'Option has been updated']);
            }
            return Response::json(['message' => 'Something went wrong'], 422);
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
        $option = Option::find($id);
        if (Auth::user()->can('remove-option') && Auth::user()->hasOption($option)) {
            if ($option->delete()) {
                return Response::json(['message' => 'Option has been removed']);
            }
            return Response::json(['message' => 'Something went wrong'], 422);
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }
}
