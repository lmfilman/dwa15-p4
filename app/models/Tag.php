<?php

class Tag extends Eloquent {

	protected $fillable = array('name');

	public function concoctions(){
		return $this->belongsToMany('Concoction');
	}
	
}
