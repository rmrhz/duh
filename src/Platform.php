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

	/**
	 * Twig Instance
	 *
	 * @var \Twig_Environment
	 */
	protected $twig;

	public function __construct()
	{
		$this->db = new \DB(getenv('DB_HOST', 'localhost'), getenv('DB_NAME', 'duhnews'), getenv('DB_USER', 'root'), getenv('DB_PASS', ''));

		$this->twig = new \Twig_Environment((new \Twig_Loader_Filesystem(ROOT . '/resources/templates')), [
			'cache' => ROOT . '/cache/templates'
		]);
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
