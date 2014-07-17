<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller
{

	public function action_index()
	{
        // Load all products from the database
        $products = ORM::factory('Product')->find_all();

        // Instantiate the view and assign the products to the view
        $view = new View('home');
        $view->set('products', $products);

        // Display the view including all products
		$this->response->body($view);
	}

}
