<?php

class User extends Eloquent {

	public function concoctions(){
		return $this->hasMany('Concoction');
	}
}
