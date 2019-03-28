<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Option;
use App\Coupon;
use App\Invoice;
use App\User;
use Auth;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fromInvoices = Auth::user()->fromInvoices()->get();
        $toInvoices = Auth::user()->toInvoices()->get();
        return Response::json(compact(['fromInvoices', 'toInvoices']));
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
        if (Auth::user()->can('add-invoice')) {
            // New Invoice
            $invoice = new Invoice();
            $data = $request->only(['photographer_id', 'start', 'end', 'note']);
            $data['user_id'] = Auth::id();
            $invoice->fill($data);
            $option_id = $request->input('options');
            $photographer = User::find($request->input('photographer_id'));
            // check if photographer exists
            if ($photographer && $photographer->can('be-hired')) {
                // Check working time conflict
                $tmp_1 = $photographer->toInvoices()->whereDate('start', '<=' , $invoice->start)->whereDate('end', '>=', $invoice->start)->get()->toArray();
                $tmp_2 = $photographer->toInvoices()->whereDate('start', '<=', $invoice->end)->whereDate('end', '>=', $invoice->end)->get()->toArray();
                $tmp = array_merge($tmp_1, $tmp_2);
                if ($tmp) {
                    $message = 'Photographer has been hired from '.$tmp[1]['start'].' to '.$tmp[1]['end'];
                    return Response::json(['message' => $message], 422);
                }
            } else {
                return Response::json(['message' => 'This is not a photographer account'], 422);
            }
            // Check option belongs to photographer
            $subtotal = 0;
            $option_info = Array();
            foreach($option_id as $key) {
                $option = Option::find($key);
                if ($photographer->options->contains('id', $key)) {
                    $subtotal += $option->price;
                    $option_info[$key] = ['option_name' => $option->name, 'price' => $option->price];
                    continue;
                }
                return Response::json(['message' => 'Option does not exist'], 404);
            }
            $invoice->fill(['subtotal' => $subtotal]);
            $total = $subtotal;
            // Check coupon
            if ($request->has('coupon_code')) {
                // Check if coupon is valid (not expired)
                $coupon = Coupon::whereCode($request->input('coupon_code'))->whereDate('start_date', '<=', Carbon::now())->whereDate('end_date', '>=', Carbon::now())->first();
                if ($coupon) {
                    $invoice->fill(['coupon_id' => $coupon->id]);
                    $total -= $subtotal*$coupon->offer;
                } else {
                    return Response::json(['message' => 'Coupon has been expired or invalid'], 404);
                }
            }
            $invoice->fill(['total' => $total]);
            if ($invoice->save()) {
                $invoice->options()->sync($option_info);
                return Response::json(['message' => 'Your invoice has been created']);
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
        $invoice = Invoice::find($id);
        if ($invoice && Auth::user()->hasInvoice($invoice)) {
            $invoice->load(['photographer', 'options', 'user']);
            return Response::json($invoice);
        }
        return Response::json(['message' => 'Invoice not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
