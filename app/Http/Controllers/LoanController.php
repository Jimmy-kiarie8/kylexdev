<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Client;
use App\Referees;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }

    public function referee(Request $request, $id)
    {
        return $request->all();
        $client = Client::find($id);
        $loan = new Referees;
        $loan->loan_id = $request->loan_id;
        $loan->loan_type = $request->loan_type;
        $loan->amount = $request->amount;
        $loan->client_id = $request->client_id;
        $loan->$save()
        return $loan;
    }
}
