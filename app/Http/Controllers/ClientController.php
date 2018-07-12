<?php

namespace App\Http\Controllers;

use App\Client;
use App\Nok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller {
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		// return $request->all();
		$client = new Client;
		$client_no = 'CL_' . $request->client_no;
		$client->name = $request->name;
		$client->pin = $request->pin;
		$client->email = $request->email;
		$client->phone = $request->phone;
		$client->id_no = $request->id_no;
		$client->address = $request->address;
		$client->client_id = $client_no;
		$client->user_id = Auth::id();
		$client->save();
		return $client;
	}

	public function saveNok(Request $request, $id) {
		// return $request->all();
		$client = Client::find($id);
		$beneficiaries = collect($request->beneficiaries)->transform(function ($beneficiary) {
			return new Nok($beneficiary);
		});
		// $beneficiaries['client_id'] = $id;
		// $nok = Nok::find($id);
		// $client->save();
		// $post->comments()->saveMany(
		$client->noks()->saveMany($beneficiaries);
		// $client;
		return $beneficiaries;
	}

	public function updateNok(Request $request, $id) {
		// return $request->all();
		$client = Client::find($id);
		$beneficiaries = collect($request->beneficiaries)->transform(function ($beneficiary) {
			// new Nok($beneficiary);

			Nok::updateOrCreate(
				['client_id' => $client->id, 'id_no' => $beneficiaries->id_no],
				[$client->noks()->saveMany($beneficiaries)]
			);
		});
		return $beneficiaries;
		// $beneficiaries['client_id'] = $id;
		// $nok = Nok::find($id);
		// $client->save();
		// $post->comments()->saveMany(
		$client->noks()->saveMany($beneficiaries);
		// $client;
		return $beneficiaries;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Client  $client
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Client $client) {

		// return $request->all();
		$client = Client::find($request->id);
		$client_no = 'CL_' . $request->client_no;
		$client->address = $request->address;
		$client->name = $request->name;
		$client->pin = $request->pin;
		$client->email = $request->email;
		$client->phone = $request->phone;
		$client->id_no = $request->id_no;
		$client->user_id = Auth::id();
		$client->client_id = $client_no;
		$client->save();
		return $client;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Client  $client
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Client $client) {
		$client = Client::find($client->id)->delete();
		return response()->json($client);
	}

	public function getClients() {
		return Client::with('noks')->get();
	}

	public function getArchivedClients() {
		return Client::onlyTrashed()->get();
		// return response()->json($client);
	}

	public function ArchivedClients(Request $request, $id) {
		$clients = Client::onlyTrashed()
			->where('id', $id)
			->first();
		//         return $client;
		// foreach ($clients as $client) {
		//     $client = $client;
		// }
		$clients->restore();
		return $clients;
	}
}
