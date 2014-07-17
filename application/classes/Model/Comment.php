<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Comment extends ORM {

    protected $_table_name = 'comments';

    protected $_table_columns = array(
        'comment_id'    => NULL,
        'product_id'    => NULL,
        'user_id'       => NULL,
        'comment_text'  => NULL,
        'approved'      => NULL,
        'created'       => NULL,
        'updated'       => NULL
    );
     
}
