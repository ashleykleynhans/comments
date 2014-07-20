<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Comments extends ORM {

    protected $_table_name = 'comments';

    protected $_table_columns = array(
        'comment_id'   => NULL,
        'parent_id'    => NULL,
        'product_id'   => NULL,
        'name'         => NULL,
        'email'        => NULL,
        'comment_text' => NULL,
        'approved'     => NULL,
        'created'      => NULL,
        'updated'      => NULL
    );

    protected $_primary_key = 'comment_id';

    public function getModerationComments()
    {
        return DB::select('*')
            ->from('comments')
            ->join('products', 'left')
            ->on('products.product_id', '=', 'comments.product_id')
            ->join('categories', 'left')
            ->on('categories.category_id', '=', 'products.category_id')
            ->execute();
    }
     
}
