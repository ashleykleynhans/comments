<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Users extends ORM {

    protected $_table_name = 'users';

    protected $_table_columns = array(
        'user_id'  => NULL,
        'username' => NULL,
        'password' => NULL,
        'fullname' => NULL,
        'created'  => NULL,
        'updated'  => NULL
    );

    protected $_primary_key = 'user_id';
     
}
