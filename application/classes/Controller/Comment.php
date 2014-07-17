<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Comment extends Controller
{

	public function action_save()
	{
        $session = Session::instance();
        $product_id = $session->get('product_id');

        // Can't continue if we don't know the product
        if (!isset($product_id))
        {
            $response = array('result' => 0, 'message' => 'Session expired');
            $this->response->body(json_encode($response));
            return;
        }

        // Process the user input
        $name = $this->request->post('name');
        $email = $this->request->post('email');
        $comment = $this->request->post('comment');
        $parentId = $this->request->post('parentid');
        $user_id = 112233;

        if (isset($name))
        {
            $name = trim($name);
        }

        if (isset($email))
        {
            $email = trim($email);
        }

        if (isset($comment))
        {
            $email = trim($comment);
        }

        if (!empty($name) && !empty($email) && !empty($comment))
        {
            $commentData = array('parent_id'    => $parentId,
                                 'product_id'   => $product_id,
                                 'user_id'      => $user_id,
                                 'comment_text' => $comment,
                                 'created'      => date('Y-m-d H:i:s'));

            $comment = new Model_Comment();
            $comment->values($commentData);

            try {
                $comment->save();
            }
            catch (ORM_Validation_Exception $e)
            {
                $response = array('result' => 0, 'message' => $e->errors(''));
            }
        }
        else
        {
            $response = array('result' => 0, 'Validation failed');
        }

        if (!isset($response))
        {
            $response = array('result' => 1);
        }

        // Display the view including the product information and comments
		$this->response->body(json_encode($response));
	}

}
