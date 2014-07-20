<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Controller
{

	public function action_index()
	{
        $session = Session::instance();
        $view = new View('login');

        if ($msg = $session->get_once('msg'))
        {
            $view->set('msg', $msg);
        }

        if ($username = $session->get_once('username'))
        {
            $view->set('username', $username);
        }

        if ($password = $session->get_once('password'))
        {
            $view->set('password', $password);
        }

        $this->response->body($view);
	}

    public function action_process()
    {
        $session = Session::instance();
        $username = $this->request->post('username');
        $password = $this->request->post('password');

        $msg = '';

        if ($username && $password) {
            $user = ORM::factory('User')
                ->where('username', '=', $username)
                ->find();

            if ($user && isset($user->password) && password_verify($password, $user->password))
            {
                $session->set('userid', $user->user_id);
                $this->redirect('moderate');

                return;
            } else {
                $msg = 'Invalid username/password combination';
            }
        } else {
            $msg = 'Please enter your username and password';
        }

        if ($msg != '') {
            $session->set('msg', $msg);

            if ($username) {
                $session->set('username', $username);
            }

            if ($password) {
                $session->set('password', $password);
            }

            $this->redirect('login');
            return;
        }
    }

}
