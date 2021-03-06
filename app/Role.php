<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
	protected $fillable = [
		'name', 'description',
	];
	/**
	 * The users that belong to the role.
	 */
	public function users() {
		return $this->belongsToMany('App\User');
	}
}
