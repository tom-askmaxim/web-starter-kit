<?php
class Model_Advertise_Order extends Model_Table{
    public $table = 'ads_order';
    function init() {
        parent::init();
        $this->addField('created');
        $this->addField('price');
        $this->addField('advertise_id');
        $this->addField('invoid_id');
        
    }
}
