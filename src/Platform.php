<?php

namespace News;

use Symfony\Component\HttpFoundation\{
	Request,
	Response
};

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

	/**
	 * Request Instance
	 *
	 * @var \Symfony\Component\HttpFoundation\Request
	 */
	protected $request;

	public function __construct()
	{
		$this->db = new \DB(getenv('DB_HOST', 'localhost'), getenv('DB_NAME', 'duhnews'), getenv('DB_USER', 'root'), getenv('DB_PASS', ''));

		$this->twig = new \Twig_Environment((new \Twig_Loader_Filesystem(ROOT . '/resources/templates')), [
			'cache' => ROOT . '/cache/templates'
		]);

		$this->request = Request::createFromGlobals(); // Avoid using super globals
	}

	public function getIndex()
	{
		return new Response();
	}

	public function getAddBulletin()
	{
		return new Response();
	}

	public function postAddBulletin()
	{
		return new Response();
	}

	public function getRemoveBulletin()
	{
		return new Response();
	}

	public function getViewBulletin()
	{
		return new Response();
	}

	public function getBulletinComments()
	{
		return new Response();
	}

	public function getAddBulletinComment()
	{
		return new Response();
	}

	public function postAddBulletinComment()
	{
		return new Response();
	}

	public function getRemoveBulletinComment()
	{
		return new Response();
	}
	
}
