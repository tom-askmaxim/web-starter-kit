<?php

class page_report extends Page{
    public function init() {
        parent::init();
        $this->add('H5')->set('Test')->addClass('aaa');
    }
}