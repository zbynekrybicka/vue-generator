<?php

namespace App\Services;

class User extends Service {

	public static function get() 
	{
		static $instance;
		if (!$instance) {
			$instance = new User;
		}
		return $instance;
	}

	public function login($username,$password) 
	{
		$user = $this->db->select('id, password')->from('user')->where('username = %s', $username)->fetch();
		if (!$user) {
		  throw new \Exception('Uživatel neexistuje.');
		}
		if (!password_verify($password, $user->password)) {
		  throw new \Exception('Chybné heslo');
		}
		return $this->jwtEncode(['id' => $user->id]);
	}

	public function getUser($authToken) 
	{
		return $this->jwtDecode($authToken);
	}


}