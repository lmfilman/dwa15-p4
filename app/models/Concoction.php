<?php

class Concoction extends Eloquent  {

	public function user(){
		return $this->belongsTo('User');
	}

	public function tags(){
		return $this->belongsToMany('Tag');
	}
}
