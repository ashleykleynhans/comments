<?php defined('SYSPATH') or die('No direct script access.');

class View_Layout 
{
    public $title = 'Comments Engine';

    public function __construct()
    {
        $this->head = Kostache::factory()->render(
            new View_Fragments_Head()
        );

        $this->footer = Kostache::factory()->render(
            new View_Fragments_Footer()
        );
    }
}
