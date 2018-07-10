<?php

namespace News\Traits;

trait Bulletin
{
	/**
	 * Returns all bulletins
	 *
	 * @return array
	 */
	public function fetchBulletins() : array
	{
		return $this->db->query("SELECT * FROM `bulletins`");
	}

	/**
	 * Adds a new bulletin
	 *
	 * @param string $subject
	 * @param string $content
	 * @return bool
	 */
	public function addBulletin(string $subject, string $content) : bool
	{
		$query = $this->db->query("INSERT INTO `bulletins` (subject, content) VALUES (:subject, :content)", [
			'subject' => $subject, 
			'content' => $content,
		]);

		return $query > 0 ? true : false;
	}

	/**
	 * Removes a bulletin
	 *
	 * @param int $id
	 * @return bool
	 */
	public function removeBulletin(int $id) : bool
	{
		$query = $this->db->query("DELETE FROM `bulletins` WHERE `id` = :id", ['id' => $id]);

		return $query > 0 ? true : false;
	}

	/**
	 * Views a bulletin
	 *
	 * @param int $id
	 * @return array
	 */
	public function fetchBulletin(int $id) : array
	{
		return $this->db->row("SELECT * FROM `bulletins` WHERE `id` = :id", ['id' => $id]);
	}

	/**
	 * Adds a comment to a bulletin
	 *
	 * @param int $bulletin_id
	 * @param string $content
	 * @return bool
	 */
	public function addBulletinComment(int $bulletin_id, string $content) : bool
	{
		$query = $this->db->query("INSERT INTO `bulletin_comments` (bulletin_id, content) VALUES (:bulletin_id, :content)", [
			'bulletin_id' => $bulletin_id, 
			'content' => $content,
		]);

		return $query > 0 ? true : false;
	}

	/**
	 * Removes a bulletin comment
	 *
	 * @param int $bulletin_id
	 * @param int $comment_id
	 * @return bool
	 */
	public function removeBulletinComment(int $bulletin_id, int $comment_id) : bool
	{
		$query = $this->db->query("DELETE FROM `bulletin_comments` WHERE `id` = :comment_id AND `bulletin_id` = :bulletin_id", [
			'comment_id' => $comment_id,
			'bulletin_id' => $bulletin_id,
		]);

		return $query > 0 ? true : false;
	}

	public function fetchBulletinComments(int $bulletin_id) : array
	{
		return $this->db->query("SELECT * FROM `bulletin_comments` WHERE `bulletin_id` = :bulletin_id", ['bulletin_id' => $bulletin_id]);
	}
}
