<?php

class Model_Blog_Category extends Model_Table{
    public $table = 'blog_category';
    function init() {
        parent::init();
        $this->addField('name');
        $this->addField('description')->type('text');
        $this->addField('keywords');
        $this->addField('created')->type('datetime')->defaultValue(date('Y-m-d H:i:s'));
    }
}