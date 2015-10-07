<?php

class Therapist extends \Eloquent {
	protected $fillable = [];

	protected $hidden = array('password');

	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);

	}
}