<?php
class Model_Pm extends Model_Table{
    public $table = 'private_message';
    function init() {
        parent::init();
        $this->addField('topic');
        $this->addField('description');
        $this->addField('created');
        $this->addField('to_user');
        $this->addField('to_group');
        $this->addField('user_id');
    }
}
