<?php

class page_index extends Page {

    function init() {
        parent::init();
        $test = array(
            'display_name'=>$this->api->auth->get('display_name'),
            'col1' => '123456',
            'col2' => 'test'
        );
        $this->template->set($test);
    }

    function defaultTemplate() {
        return array('dashboard');
    }

}
