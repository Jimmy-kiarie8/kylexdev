<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nok extends Model
{
	protected $fillable = [
		'name', 'phone', 'address', 'id_no',
	];
    public function client()
    {
    	return $this->belongsTo('App\Client', 'client_id');
    }
}
