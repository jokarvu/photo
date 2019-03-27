<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Location;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\LocationStoreRequest;
use Auth;
use App\Tag;
use App\Http\Requests\LocationUpdateRequest;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('list-location')) {
            $locations = Location::all()->load('father');
            return Response::json($locations);
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
        if (Auth::user()->can('add-location')) {
            $locations = Location::all();
            $tags = Tag::all();
            return Response::json(compact(['locations', 'tags']));
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationStoreRequest $request)
    {
        if (Auth::user()->can('add-location')) {
            $location = new Location();
            $location->name = $request->input('name');
            $location->parent_id = $request->input('parent_id');
            $location->description = $request->input('description');
            if ($location->save()) {
                $location->tags()->attach($request->input('tags'));
                return Response::json(['message' => 'Location has been added']);
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
        if (Auth::user()->can('view-location')) {
            $location = Location::find($id);
            if ($location) {
                $location->load('father');
                $images = $location->images()->with(['owner', 'album'])->get();
                return Response::json(compact(['location', 'images']));
            }
            return Response::json(['message' => 'Location not found'], 404);
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
        if (Auth::user()->can('edit-location')) {
            $location = Location::find($id);
            $locations = Location::where('id', '!=', $id)->get();
            if ($location) {
                return Response::json(compact(['location', 'locations']));
            }
            return Response::json(['message' => 'Location not found'], 404);
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
    public function update(LocationUpdateRequest $request, $id)
    {
        if (Auth::user()->can('edit-location')) {
            $location = Location::find($id);
            if ($location) {
                $data = $request->only(['name', 'description', 'parent_id']);
                if ($location->update($data)) {
                    return Response::json(['message' => 'Location has been updated']);
                }
                return Response::json(['message' => 'Something went wrong'], 422);
            }
            return Response::json(['message' => 'Location not found'], 404);
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
        if (Auth::user()->can('remove-location')) {
            $location = Location::find($id);
            if ($location) {
                if ($location->delete()) {
                    return Response::json(['message' => 'Location has been removed']);
                }
                return Response::json(['message' => 'Something went wrong'], 422);
            }
            return Response::json(['message' => 'Location not found'], 404);
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }
}
