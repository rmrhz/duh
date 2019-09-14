<?php

namespace News\Http\Controllers;

use News\Repositories\BulletinRepository;

final class PlatformController extends \News\Http\Controller
{
    protected $bulletins;

    public function __construct(BulletinRepository $bulletin)
    {
        $this->bulletins = $bulletin;
    }

    public function getIndex()
    {
        $bulletins = $this->bulletins->fetchBulletins();

        return $this->response('index.html', [
            'bulletins' => $bulletins
        ]);
    }

    public function getAddBulletin()
    {
        return $this->response('bulletin_add.html');
    }

    public function postAddBulletin()
    {
        $bulletin_id = $this->bulletins->addBulletin($this->request->get('subject'), $this->request->get('content'));

        return $this->redirect('/' . $bulletin_id);
    }

    public function getRemoveBulletin($bulletin_id)
    {
        $this->bulletins->removeBulletin((int) $bulletin_id);

        return $this->redirect('/');
    }

    public function getViewBulletin($bulletin_id)
    {
        // We cast `int` instead of defining it in the method
        // This assumes the underlying routing library that will pass it doens't cast it
        $bulletin = $this->bulletins->fetchBulletin((int) $bulletin_id);

        return $this->response('bulletin_view.html', [
            'bulletin' => $bulletin,
        ]);
    }

    public function getBulletinComments($bulletin_id)
    {
        $comments = $this->bulletins->fetchBulletinComments((int) $bulletin_id);

        return $this->response('bulletin_comments.html', [
            'bulletin_id' => $bulletin_id,
            'comments' => $comments,
        ]);
    }

    public function getAddBulletinComment($bulletin_id)
    {
        return $this->bulletins->response('bulletin_comment_add.html', [
            'bulletin_id' => (int) $bulletin_id
        ]);
    }

    public function postAddBulletinComment($bulletin_id)
    {
        $this->bulletins->addBulletinComment((int) $bulletin_id, $this->request->get('content'));

        return $this->redirect('/' . $bulletin_id . '/comments');
    }

    public function getRemoveBulletinComment($bulletin_id, $comment_id)
    {
        $this->bulletins->removeBulletinComment((int) $bulletin_id, (int) $comment_id);

        return $this->redirect('/');
    }
}
