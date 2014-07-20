<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Moderate extends Controller
{
    public function __construct()
    {
        $session = Session::instance();

        if ($userId = $session->get('userid'))
        {

        }
        else
        {
            $this->redirect('login');
        }
    }

	public function action_index()
	{
        // Load all comments from the database
        $comments = ORM::factory('Comments')->getModerationComments();

        // Instantiate the view and assign the comments to the view
        $view = new View('moderate');
        $view->set('comments', $comments);

        // Display the view including all comments
		$this->response->body($view);
	}

    public function action_approve()
    {
        $comment_id = $this->request->param('commentid');

        $comment = ORM::factory('Comments', $comment_id);
        $comment->approved = '1';
        $comment->update();

        $this->redirect('moderate');
    }

    public function action_unapprove()
    {
        $comment_id = $this->request->param('commentid');

        $comment = ORM::factory('Comments', $comment_id);
        $comment->approved = '0';
        $comment->update();

        $this->redirect('moderate');
    }

    public function action_update()
    {
        var_dump($_POST);
    }

}
