<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller
{

	public function action_index()
	{
        $view = new View('home');

		$this->response->body($view);
	}

}
