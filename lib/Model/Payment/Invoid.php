<?php
class Model_Payment_Invoid extends Model_Table{
    public $table = 'invoid';
    function init() {
        parent::init();
        $this->addField('name');
        $this->addField('invoid_code');
        $this->addField('created');
        $this->addField('expire');
    }
}