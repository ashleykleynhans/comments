<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Moderate extends Controller
{
	public function action_index()
	{
        // Users must be logged in to moderate comments
        $session = Session::instance();

        if ($userId = $session->get('userid'))
        {
            // Load all comments from the database
            $comments = ORM::factory('Comments')->getModerationComments();

            // Instantiate the view and assign the comments to the view
            $view = new View('moderate');
            $view->set('comments', $comments);

            // Display the view including all comments
		    $this->response->body($view);
        }
        else
        {
            $this->redirect('login');
        }
	}

    public function action_approve()
    {
        // Users must be logged in to moderate comments
        $session = Session::instance();

        if ($userId = $session->get('userid'))
        {
            $comment_id = $this->request->param('commentid');

            $comment = ORM::factory('Comments', $comment_id);
            $comment->approved = '1';
            $comment->update();

            $this->redirect('moderate');
        }
        else
        {
            $this->redirect('login');
        }
    }

    public function action_unapprove()
    {
        // Users must be logged in to moderate comments
        $session = Session::instance();

        if ($userId = $session->get('userid'))
        {
            $comment_id = $this->request->param('commentid');

            $comment = ORM::factory('Comments', $comment_id);
            $comment->approved = '0';
            $comment->update();

            $this->redirect('moderate');
        }
        else
        {
            $this->redirect('login');
        }
    }

    public function action_update()
    {
        // Users must be logged in to moderate comments
        $session = Session::instance();

        if ($userId = $session->get('userid'))
        {
            // Get the input from the form
            $name = $this->request->post('name');
            $email = $this->request->post('email');
            $commentText = $this->request->post('comment');
            $commentid = $this->request->post('commentid');

            if (isset($name))
            {
                $name = trim($name);
            }

            if (isset($email))
            {
                $email = trim($email);
            }

            if (isset($commentText))
            {
                $commentText = trim($commentText);
            }

            if (!empty($name) && !empty($email) && !empty($commentText))
            {
                // Check whether the comment exists
                $comment = ORM::factory('Comments', $commentid);

                if (isset($comment->comment_id))
                {
                    // Filter user input to prevent XSS
                    $purifier = HTMLPurifier::instance();

                    $comment->name = $purifier->purify($name);
                    $comment->email = $purifier->purify($email);
                    $comment->comment_text = $purifier->purify($commentText);
                    $comment->update();

                    $response = array('result' => 1);
                }
                else
                {
                    $response = array('result' => 0, 'message' => 'Comment not found');
                }
            }
            else
            {
                $response = array('result' => 0, 'message' => 'Validation failed');
            }
        }
        else
        {
            $response = array('result' => 0, 'message' => 'Session expired');
        }

        // Return the response to the browser
        $this->response->body(json_encode($response));
    }

}
