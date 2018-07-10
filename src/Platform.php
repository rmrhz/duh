<?php

namespace News;

use Symfony\Component\HttpFoundation\{
	RedirectResponse,
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

	public function getRemoveBulletin($bulletin_id) : RedirectResponse
	{
		$this->removeBulletin((int) $bulletin_id);

		return new RedirectResponse('/');
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

	public function getAddBulletinComment($bulletin_id) : Response
	{
		return new Response($this->twig->render('bulletin_comment_add.html', [
			'bulletin_id' => (int) $bulletin_id
		]));
	}

	public function postAddBulletinComment($bulletin_id) : RedirectResponse
	{
		$this->addBulletinComment((int) $bulletin_id, $this->request->get('content'));

		return new RedirectResponse('/' . $bulletin_id . '/comments');
	}

	public function getRemoveBulletinComment($bulletin_id, $comment_id) : RedirectResponse
	{
		$this->removeBulletinComment((int) $bulletin_id, (int) $comment_id);

		return new RedirectResponse('/');
	}
	
}
