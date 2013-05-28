<?php

class page_user extends Page{
    public function init() {
        parent::init();
        $this->add('h2')->set($_GET['iden']);
    }
}