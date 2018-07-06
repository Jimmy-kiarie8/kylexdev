<?php

namespace App\Http\Controllers;

use App\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // return $request->all();
        $receipt = new Receipt;
        $receipt_no = 'RC_'.$request->receipt_no;
        $receipt->receipt_date = $request->receipt_date;
        $receipt->amount = $request->amount;
        $receipt->account = $request->account;
        $receipt->client_id = $request->client_id;
        $receipt->period = $request->period;
        $receipt->payment_type = $request->payment_type;
        $receipt->payment_mode = $request->payment_mode;
        $receipt->remarks = $request->remarks;
        $receipt->receipt_no = $receipt_no;
        $client->user_id = Auth::id();
        $receipt->period = $request->period;
        $receipt->save();
        return $receipt;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receipt $receipt)
    {
        $receipt = Receipt::find($request->id);
        $receipt_no = 'RC_'.$request->receipt_no;
        $receipt->receipt_date = $request->receipt_date;
        $receipt->amount = $request->amount;
        $receipt->account = $request->account;
        $receipt->client_id = $request->client_id;
        $receipt->period = $request->period;
        $receipt->payment_type = $request->payment_type;
        $receipt->payment_mode = $request->payment_mode;
        $receipt->remarks = $request->remarks;
        $receipt->receipt_no = $receipt_no;
        $client->user_id = Auth::id();
        $receipt->period = $request->period;
        $receipt->save();
        return $receipt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        //
    }

    public function getReceipts() {
        return Receipt::all();
    }
}
