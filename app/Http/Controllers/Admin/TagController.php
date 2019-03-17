<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('list-tag')) {
            $tags = Tag::all();
            return Response::json($tags);
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
        return Response::json(['message' => 'Page not found'], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagStoreRequest $request)
    {
        if (Auth::user()->can('add-tag')) {
            $tag = new Tag();
            $tag->name = $request->input('name');
            if ($tag->save()) {
                return Response::json(['message' => 'Tag has been added']);
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
        if (Auth::user()->can('view-tag')) {
            $tag = Tag::whereName($name)->first();
            if ($tag) {
                $users = $tag->users()->get();
                $albums = $tag->albums()->get();
                $locations = $tag->locations()->get();
                $images = $tag->images()->get();
                return Response::json(compact(['tag', 'users', 'albums', 'locations', 'images']));
            }
            return Response::json(['message' => 'Tag not found'], 404);
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
        if (Auth::user()->can('edit-tag')) {
            $tag = Tag::whereName($name)->first();
            if ($tag) {
                return Response::json($tag);
            }
            return Response::json(['message' => 'Tag not found'], 404);
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
    public function update(TagUpdateRequest $request, $id)
    {
        if (Auth::user()->can('edit-tag')) {
            $tag = Tag::find($id);
            if ($tag) {
                $tag->name = $request->input('name');
                if ($tag->save()) {
                    return Response::json(['message' => 'Tag has been updated']);
                }
                return Response::json(['message' => 'Tag not found'], 404);
            }
            return Response::json(['messaeg' => 'Something went wrong'], 422);
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
        if (Auth::user()->can('remove-tag')) {
            $tag = Tag::find($id);
            if ($tag) {
                if ($tag->delete()) {
                    return Response::json(['message' => 'Tag has been removed']);
                }
                return Response::json(['message' => 'Something went wrong'], 422);
            }
            return Response::json(['messsage' => 'Tag not found'], 404);
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }
}
