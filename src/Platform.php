<?php

namespace News;

class Platform
{
	use Traits\Bulletin;

	/**
	 * PDO Instance
	 * https://packagist.org/packages/lincanbin/php-pdo-mysql-class
	 *
	 * @var \DB
	 */
	protected $db;

	public function __construct()
	{
		$this->db = new DB(env('DB_HOST', 'localhost'), env('DB_NAME', 'duhnews'), env('DB_USER', 'root'), env('DB_PASS', ''));
	}

	public function getIndex()
	{

	}

	public function getAddBulletin()
	{

	}

	public function postAddBulletin()
	{

	}

	public function getRemoveBulletin()
	{

	}

	public function getViewBulletin()
	{

	}

	public function getBulletinComments()
	{

	}

	public function getAddBulletinComment()
	{
		
	}

	public function postAddBulletinComment()
	{

	}

	public function getRemoveBulletinComment()
	{

	}
	
}
