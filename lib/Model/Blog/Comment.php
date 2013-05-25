<?php

class Model_Blog_Comment extends Model_Table{
    public $table = 'blog_comment';
    function init() {
        parent::init();
        $this->addField('comment')->type('text');
        $this->addField('created')->type('datetime')->defaultValue(date('Y-m-d H:i:s'));
        $this->addField('blog_id')->refModel('Blog_Blog');
        //$this->addField('member_comment');
        $this->addField('user_comment')->caption('Name');
        if ($this->api->auth->isLoggedIn())
            $this->hasOne('User', 'member_comment', 'display_name')->defaultValue($this->api->auth->get('id'))->mandatory(true);
        else
            $this->hasOne('User', 'member_comment', 'display_name')->caption('Member');
        //$this->hasOne('User', 'member_comment','display_name');
    }
}