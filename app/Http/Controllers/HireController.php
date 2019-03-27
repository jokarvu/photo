<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Illuminate\Support\Facades\Response;
use App\Hire;

class HireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hires = Auth::user()->hires()->get();
        $beHired = Auth::user()->hisHires()->get();
        return Response::json(compact(['hires', 'beHired']));
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
        if (Auth::user()->can('add-hire')) {
            $data = $request->only(['photographer_id', 'hours', 'wage', 'note', 'end_date', 'start_date']);
            $coupon = Coupon::where('code', $request->input('coupon_code'))->first();
            if (User::find($request->input('photographer_id'))->hasCoupon($coupon)) {
                $data['coupon_id'] = $coupon->id;
            }
            if (Hire::create($data)) {
                return Response::json(['message' => 'Order completed']);
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
        $hire = Hire::find($id);
        if (Auth::user()->hasHire($hire)) {
            return Response::json($hire);
        }
        return Response::json(['message' => 'Order not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hire = Hire::find($id);
        if (Auth::user()->hasHire($hire)) {
            return Response::json($hire);
        }
        return Response::json(['message' => 'Order not found'], 404);
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
        //
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
