<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Illuminate\Support\Facades\Response;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        return Response::json($coupons);
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
        if (Auth::user()->can('add-coupon')) {
            $data = $request->only(['name', 'code', 'offer', 'discount', 'description']);
            if (Auth::user()->coupons()->create($data)) {
                return Response::json(['message' => 'Coupon has been added']);
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
        $coupon = Coupon::find($id);
        if ($coupon) {
            return Response::json($coupon);
        }
        return Response::json(['message' => 'Coupon not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        if (Auth::user()->can('edit-coupon') && Auth::user()->hasCoupon($coupon)) {
            return Response::json($coupon);
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
        $coupon = Coupon::find($id);
        if (Auth::user()->can('edit-coupon') && Auth::user()->hasCoupon($coupon)) {
            $data = $request->only(['name', 'code', 'offer', 'discount', 'description', 'end_date']);
            if ($coupon->update($data)) {
                return Response::json(['message' => 'Coupon has been updated']);
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
        $coupon = Coupon::find($id);
        if (Auth::user()->can('remove-coupon') && Auth::user()->hasCoupon($coupon)) {
            if ($coupon->delete()) {
                return Response::json(['message' => 'Coupon has been removed']);
            }
            return Response::json(['message' => 'Something went wrong'], 422);
        }
        return Response::json(['message' => 'Permission denied'], 401);
    }
}
