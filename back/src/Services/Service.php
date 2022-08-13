<?php
namespace App\Services;

use Dibi\Connection;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Service {

	protected $db;
	const jwt_key = 'JO^e44VUH&v2IvScSTfujLLwrGkJ*DFQwnPP5!kBQ2WjE!tCKu';

	protected function __construct() 
	{
		$this->db = new Connection([
			'host' => 'localhost',
			'username' => 'root',
			'database' => 'generator'
		]);
	}

	protected function jwtEncode($payload) 
	{
		return JWT::encode($payload, self::jwt_key, 'HS256');
	}

	protected function jwtDecode($authToken)
	{
		try {
			return JWT::decode($authToken, new Key(self::jwt_key, 'HS256'));
		} catch (\Exception $e) {
			return null;
		}
	}

}