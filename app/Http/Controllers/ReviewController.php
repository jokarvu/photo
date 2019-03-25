<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Illuminate\Support\Facades\Response;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorization', ['only' => ['store', 'update', 'destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviewFrom = Auth::user()->reviewFrom()->get();
        $reviewTo = Auth::user()->reviewTo()->get();
        return Response::json(compact(['reviewFrom', 'reviewTo']));
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
    public function store(Request $request)
    {
        if (Auth::user()->can('add-review')) {
            $data = $request->only(['content', 'rate', 'photographer_id']);
            if (Auth::user()->reviewFrom()->create($data)) {
                return Response::json(['message' => 'Reviewed']);
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
        $review = Review::find($id);
        if ($review) {
            return Response::json($review);
        }
        return Response::json(['message' => 'Review not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::find($id);
        if (Auth::user()->can('edit-review') && Auth::user()->hasReview($review)) {
            if ($review) {
                return Response::json($review);
            }
            return Response::json(['message' => 'Review not found'], 404);
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
        $review = Review::find($id);
        if (Auth::user()->can('edit-review') && Auth::user()->hasReview($review)) {
            $data = $request->only(['content', 'rate']);
            if ($review->update($data)) {
                return Response::json(['message' => 'Review has been updated']);
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
        $review = Review::find($id);
        if (Auth::user()->can('remove-review') && Auth::user()->hasReview($review)) {
            if ($review->delete()) {
                return Response::json(['message' => 'Review has been removed']);
            }
            return Response::json(['message' => 'Something went wrong'], 422);
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }
}
