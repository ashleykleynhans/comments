<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Product extends ORM {

    protected $_table_name = 'products';

    protected $_table_columns = array(
        'product_id'    => NULL,
        'category_id'   => NULL,
        'product_code'  => NULL,
        'product_name'  => NULL,
        'product_price' => NULL,
        'product_stock' => NULL,
        'created'       => NULL,
        'updated'       => NULL
    );
     
}
