<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Moderate extends Controller
{

	public function action_index()
	{
        $session = Session::instance();

        if ($userId = $session->get('userid'))
        {
            // Load all comments from the database
            $comments = ORM::factory('Comment')->find_all();

            // Instantiate the view and assign the comments to the view
            $view = new View('moderate');
            $view->set('comments', $comments);

            // Display the view including all comments
		    $this->response->body($view);
        }
        else
        {
            HTTP::redirect('login', 302);
        }
	}

}
