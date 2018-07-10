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

	public function getIndex() : Response
	{
		$bulletins = $this->fetchBulletins();

		return new Response($this->twig->render('index.html', [
			'bulletins' => $bulletins
		]));
	}

	public function getAddBulletin() : Response
	{
		return new Response($this->twig->render('bulletin_add.html'));
	}

	public function postAddBulletin()
	{
		return new Response();
	}

	public function getRemoveBulletin()
	{
		return new Response();
	}

	public function getViewBulletin($bulletin_id) : Response
	{
		// We cast `int` instead of defining it in the method
		// This assumes the underlying routing library that will pass it doens't cast it
		$bulletin = $this->fetchBulletin((int) $bulletin_id);

		return new Response($this->twig->render('bulletin_view.html'));
	}

	public function getBulletinComments($bulletin_id) : Response
	{
		$comments = $this->fetchBulletinComments((int) $bulletin_id);

		return new Response($this->twig->render('bulletin_comments.html', [
			'comments' => $comments
		]));
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
