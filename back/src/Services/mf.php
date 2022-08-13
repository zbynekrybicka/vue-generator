<?php

namespace App\Services;

class mf {

	public function User() {
		return User::get();
	}

	public function Product() {
		return Product::get();
	}


}