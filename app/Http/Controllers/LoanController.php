<?php

namespace App\Http\Controllers;

use App\Client;
use App\Loan;
use App\Referees;
use Illuminate\Http\Request;

class LoanController extends Controller {
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Loan  $loan
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Loan $loan) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Loan  $loan
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Loan $loan) {
		//
	}

	public function referee(Request $request, $id) {
		// return $request->all();
		$client = Client::find($id);
		$loan = new Referees;
		$loan->loan_id = 'Loan_' . $request->loan_id;
		// $loan->loan_type = $request->loan_type;
		$loan->amount = $request->amount;
		$loan->client_id = $client->client_id;
		$loan->id_no = $client->id_no;
		$loan->save();
		return $loan;
	}

	public function loans(Request $request, $id) {
		// return $request->all();
		$loan = new Loan;
		// dd($loan);
		$loan->repayment_period = $request->repayment_period;
		$loan->application_date = $request->application_date;
		$loan->client_id = $id;
		$loan->loan_type = $request->loan_type;
		$loan->loan_id = 'Loan_' . $request->loan_id;
		$loan->amount = $request->amount;
		$loan->interest_rate = $request->interest_rate;
		$loan->status = 'Applied';
		$loan->save();
		return $loan;
	}

	public function getReferees() {
		return Referees::all();
	}

	public function getLoans() {
		return Loan::all();
	}

	public function getAppliedLoans() {
		return Loan::where('status', 'Applied')->get();
	}

	public function getDefaultedLoans() {
		return Loan::where('status', 'Defaulted')->get();
	}

	public function getRepayedLoans() {
		return Loan::where('status', 'Repaid')->get();
	}

	public function getDraftLoans() {
		return Loan::where('status', 'Draft')->get();
	}

	public function getRejectedLoans() {
		return Loan::where('status', 'Rejected')->get();
	}
}
