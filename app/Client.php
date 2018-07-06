<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
	use SoftDeletes;
    public function noks()
    {
    	return $this->hasMany('App\Nok', 'client_id');
    }

    public function receipts()
    {
    	return $this->hasMany('App\Receipt', 'client_id');
    }

    public function referees()
    {
        return $this->hasMany('App\Referees', 'client_id');
    }
    
     protected $dates = ['deleted_at'];
}
