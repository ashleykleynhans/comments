<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Product extends Controller
{

	public function action_index()
	{
        $product_code = $this->request->param('code');

        // Load the particular product from the database
        $product = ORM::factory('Product')
                    ->where('product_code', '=', $product_code)
                    ->find();

        // Load the commments from the database
        $comments = ORM::factory('Comment')
                    ->where('product_id', '=', $product->product_id)
                    ->and_where('approved', '=', 1)
                    ->find_all();

        // Instantiate the view and assign the product and comments to the view
        $view = new View('product');
        $view->set('product', $product);
        $view->set('comments', $comments);

        $session = Session::instance();
        $session->set('product_id', $product->product_id);

        // Display the view including the product information and comments
		$this->response->body($view);
	}

}
