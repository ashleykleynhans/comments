<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Logout extends Controller
{

	public function action_index()
	{
        $session = Session::instance();
        $session->destroy();
        $this->redirect('login');
	}

}
