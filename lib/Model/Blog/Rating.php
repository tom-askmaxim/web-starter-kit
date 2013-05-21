<?php

class Model_Blog_Rating extends Model_Table{
    public $table = 'blog_rating';
    function init() {
        parent::init();
        $this->addField('score');
        $this->addField('blog_id');
        $this->addField('user_id');
    }
}