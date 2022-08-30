<?php

namespace App\Services;

class Likes extends Service {

	public static function get() 
	{
		static $instance;
		if (!$instance) {
			$instance = new Likes;
		}
		return $instance;
	}

	public function postLike($commentId, $userId) 
	{
		$this->db->insert('likes', [
		  'user_id' => $userId,
		  'comment_id' => $commentId,
		])->execute();
		return $this->db->select('id as user_id, concat(firstname, \' \', lastname) as name')->from('user')->where('id = %i', $userId)->fetch();
	}

	public function deleteLike($commentId, $userId) 
	{
		return $this->db->delete('likes')->where('user_id = %i and comment_id = %i', $userId, $commentId)->execute();
	}


}