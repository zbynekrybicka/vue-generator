<?php

namespace App\Services;

class Product extends Service {

	public static function get() 
	{
		static $instance;
		if (!$instance) {
			$instance = new Product;
		}
		return $instance;
	}

	public function getAllProducts() 
	{
		return $this->db->select('*')->from('products')->fetchAll();
	}


}