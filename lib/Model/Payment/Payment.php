<?php
class Model_Payment_Payment extends Model_Table{
    public $table = 'payment';
    function init() {
        parent::init();
        $this->addField('name');
        $this->addField('created');
        $this->addField('total');
        $this->addField('status');
        $this->addField('invoid_id');
    }
}