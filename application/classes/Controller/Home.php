<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller
{

	public function action_index()
	{
		//$this->response->body('hello, world!');
        $this->content = new View_Page_Home;
	}

}
