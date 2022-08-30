<?php

namespace App\Services;

class mf {

	public function User() {
		return User::get();
	}

	public function Comments() {
		return Comments::get();
	}

	public function Likes() {
		return Likes::get();
	}


}