<?php
class Model_Advertise_Option extends Model_Table{
    public $table = 'ads_option';
    function init() {
        parent::init();
        $this->addField('name')->mandatory(true);
        //$this->addField('image');
        $this->addField('price')->mandatory(true)->type('int'); 
        $this->hasOne('filestore\Model_File','image','filename');
    }
}
