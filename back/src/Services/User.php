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
		$user = $this->db->select('id, password, secret')->from('user')->where('username = %s', $username)->fetch();
		if (!$user) {
		  throw new \Exception('Uživatel neexistuje.');
		}
		if (!password_verify($password, $user->password)) {
		  throw new \Exception('Chybné heslo');
		}
		return [
		  'authToken' => $user->secret ? '' : $this->jwtEncode(['id' => $user->id]),
		  'user_id' => $user->id
		];
	}

	public function getUser($authToken) 
	{
		return $this->jwtDecode($authToken);
	}

	public function authorize($userId, $authCode) 
	{
		$ga = new \PHPGangsta_GoogleAuthenticator();
		$secret = $this->db->select('secret')->from('user')->where('id = %i', $userId)->fetchSingle();
		if (!$ga->verifyCode($secret, $authCode)) {
		  throw new \Exception('Kódy se neshodují');
		}
		return $this->jwtEncode(['id' => $userId]);
	}

	public function registration($data) 
	{
		$this->db->insert('user', [
		  'username' => $data['username'],
		  'password' => password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12 ]),
		  'firstname' => $data['firstname'],
		  'lastname' => $data['lastname']
		])->execute();
		return $this->login($data['username'], $data['password']);
	}

	public function loadProfile($userId) 
	{
		$profile = $this->db->select('firstname, lastname, secret')->from('user')->where('id = %i', $userId)->fetch();
		$qrCodeUrl = $profile->secret ? $this->getQrCodeUrl($userId, $profile->secret) : '';
		
		return [
		  'profile' => [
		    'firstname' => $profile->firstname,
		    'lastname' => $profile->lastname
		  ],
		  'qrCodeUrl' => $qrCodeUrl
		];
	}

	private function getQrCodeUrl($userId) 
	{
		$ga = new \PHPGangsta_GoogleAuthenticator();
		$secret = $this->db->select('secret')->from('user')->where('id = %i', $userId)->fetchSingle();
		return $ga->getQRCodeGoogleUrl('zbynekrybicka.cz', $secret);
	}

	public function saveProfile($userId, $firstname, $lastname) 
	{
		$this->db->update('user', [
		  'firstname' => $firstname,
		  'lastname' => $lastname
		])->where('id = %i', $userId)->execute();
	}

	public function activateTwoFactor($userId) 
	{
		$ga = new \PHPGangsta_GoogleAuthenticator();
		$secret = $ga->createSecret();
		$this->db->update('user', [ 'secret' => $secret ])->where('id = %i', $userId)->execute();
		return $ga->getQRCodeGoogleUrl('zbynekrybicka.cz', $secret);
	}


}