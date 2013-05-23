<?php

class Model_Board_Topic extends Model_Table {

    public $table = 'topic';

    function init() {
        parent::init();
        $this->addField('topic')->mandatory(true);
        $this->addField('detail')->type('text')->mandatory(true);
        $this->addField('created')->type('datetime')->defaultValue(date('Y-m-d H:i:s'));
        $this->addField('allow_comment')->datatype('list')
                ->listData(array(
                    'public' => 'Public',
                    'member' => 'Member',
                    'disabled' => 'Disabled',
                ))
                ->mandatory(true)->defaultValue('public');
        $this->addField('edit_time')->type('datetime');
        $this->addField('keywords');
        $this->addField('allow_see')->datatype('list')
                ->listData(array(
                    'public' => 'Public',
                    'member' => 'Member',
                    'disabled' => 'Disabled',
                ))
                ->mandatory(true)->defaultValue('public');
        $this->addField('is_major')->type('boolean');
        $this->addField('board_id')->refModel('Board_Board')->mandatory(true)->caption('Forum');
        //$this->addField('user_id')->defaultValue($this->api->auth->get('id'))->mandatory(true);
        $this->addField('views');
        if ($this->api->auth->isLoggedIn())
            $this->hasOne('User', 'user_id', 'display_name')->defaultValue($this->api->auth->get('id'))->mandatory(true);
        else
            $this->hasOne('User', 'user_id', 'display_name');
    }

}
