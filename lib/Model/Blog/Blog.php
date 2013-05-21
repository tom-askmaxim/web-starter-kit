<?php

class Model_Blog_Blog extends Model_Table {

    public $table = 'blog';

    function init() {
        parent::init();
        $this->addField('title');
        $this->addField('detail')->type('text');
        $this->addField('keywords');
        $this->addField('status')->datatype('list')
                ->listData(array(
                    'public' => 'Public',
                    'member' => 'Member',
                    'disabled' => 'Disabled',
                ))
                ->mandatory(true)->defaultValue('public');
        $this->addField('created')->type('datetime')->defaultValue(date('Y-m-d H:i:s'));
        $this->addField('blog_category_id')->refModel('Blog_Category')->mandatory(true);
        //$this->addField('user_id')->refModel('User','first_name')->mandatory(true);
        $this->addField('allow_comment')//->enum(array('public', 'member', 'disabled'))
                ->datatype('list')
                ->listData(array(
                    'public' => 'Public',
                    'member' => 'Member',
                    'disabled' => 'Disabled',
                ))
                ->mandatory(true)->defaultValue('public');
        $this->addField('edit_time');
        $this->addField('views')->defaultValue(0);
        $this->hasOne('User', 'user_id', 'display_name')->defaultValue($this->api->auth->get('id'));
    }

}