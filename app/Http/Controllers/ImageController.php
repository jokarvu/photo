<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Location;
use App\Album;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Tag;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('list-image')) {
            $images = Image::all()->load(['album', 'location', 'owner']);
            return Response::json($images);
        }
        $images = Auth::user()->images()->load(['album', 'location', 'owner'])->get();
        return Response::json($images);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('add-image')) {
            $tags = Tag::all();
            $locations = Location::all();
            $albums = Album::all();
            return Response::json(compact(['locations', 'albums', 'tags']));
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('add-image')) {
            $data = $request->only(['location_id', 'album_id']);
            $data['user_id'] = Auth::user()->id;
            if ($request->has('images')) {
                foreach($request->file('images') as $item) {
                    $ext = $item->getClientOriginalExtension();
                    $name = Auth::user()->id.'_'.Carbon::today()->format('Ymd').'_'.str_random(4).'.'.$ext;
                    if ($item->storeAs('images', $name, 'public')) {
                        $data['path'] = 'images/'.$name;
                        $image = Image::create($data);
                        $image->tags()->attach($request->input('tags'));
                    }
                }
                return Response::json(['message' => 'Images has been uploaded']);
            }
            return Response::json(['message' => 'No image was selected'], 422);
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
        return Response::json(['message' => 'Page not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Response::json(['message' => 'Page not found'], 404);
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
        return Response::json(['message' => 'Page not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);
        if (Auth::user()->can('remove-image') && Auth::id() == $image->user_id) {
            if ($image && $image->delete()) {
                Storage::disk('public')->delete($image->path);
                return Response::json(['message' => 'Image has been removed']);
            }
            return Response::json(['message' => 'Image not found'], 404);
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }
}
