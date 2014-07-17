<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_User extends ORM {

    protected $_table_name = 'users';

    protected $_table_columns = array(
        'user_id'  => NULL,
        'username' => NULL,
        'password' => NULL,
        'fullname' => NULL,
        'admin'    => NULL,
        'created'  => NULL,
        'updated'  => NULL
    );
     
}
