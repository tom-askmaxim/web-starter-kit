<?php

class Model_News extends Model_Table {

    public $table = 'news';

    function init() {
        parent::init();
        $this->addField('title')->mandatory('Please insert the title');
        $this->addField('description')->type('text')->mandatory(TRUE);
        $this->addField('created')->type('datetime')->defaultValue(date('Y-m-d H:i:s')); //0000-00-00 00:00:00
        $this->addField('status')->datatype('list')
                ->listData(array(
                    'public' => 'Public',
                    'member' => 'Member',
                    'disabled' => 'Disabled',
                ))
                ->mandatory(true)->defaultValue('public');
        //$this->addField('user_id')->refModel('User')->defaultValue($this->api->auth->get('id'));
        $this->hasOne('User', 'user_id', 'display_name')->defaultValue($this->api->auth->get('id'));
        //$this->addField('user_id')->defaultValue($this->api->auth->get('id'));
    }

}