<?php

namespace App\Services;

class Comments extends Service {

	public static function get() 
	{
		static $instance;
		if (!$instance) {
			$instance = new Comments;
		}
		return $instance;
	}

	public function getComments() 
	{
		$comments = $this->getCommentsTable();
		$likes = $this->getLikesFromComments($comments);
		$comments = $this->joinLikesToComments($comments, $likes);
		
		return $comments;
	}

	private function getCommentsTable() 
	{
		return $this->db->select('comments.id, concat(firstname, \' \', lastname) as author, date_format(created, \'%d. %m. %Y %H:%i\') as created, content, video, image, youtube')
		  ->from('comments')
		  ->join('user')->on('comments.user_id = user.id')
		  ->orderBy('created desc')->fetchAll();
	}

	private function getLikesFromComments($comments) 
	{
		$commentIds = array_map(function($item) { return $item->id; }, $comments);
		return $this->db->select('user.id, comment_id, concat(firstname, \' \', lastname) as name')->from('likes')->join('user')->on('likes.user_id = user.id')->where('comment_id in %in', $commentIds)->fetchAll();
	}

	private function joinLikesToComments($comments, $likes) 
	{
		return array_map(function ($item) use ($likes) {
		  $item = (object) $item;
		  $item->likes = [];
		  foreach ($likes as $like) {
		    if ($like->comment_id === $item->id) {
		      $item->likes[] = [ 'user_id' => $like->id, 'name' => $like->name ];
		    }
		  }
		  return $item;
		}, $comments);
	}

	public function insertComment($userId, $content, $media) 
	{
		if ($media['type'] === 'image') {
		  $image = md5($userId . time());
		  $mediaContent = preg_replace('/^.*base64/','', $media['content']);
		  file_put_contents(__DIR__ . '/../../app/image/' . $image, base64_decode($mediaContent));
		} else {
		  $image = '';
		}
		if ($media['type'] === 'youtube') {
		  $youtube = $media['content'];
		} else {
		  $youtube = '';
		}
		$this->db->insert('comments', [
		  'user_id' => $userId,
		  'created' => date('Y-m-d H:i:s'),
		  'content' => $content,
		  'image' => $image,
		  'youtube' => $youtube,
		])->execute();
		$comments = $this->getComments();
		return reset($comments);
	}


}