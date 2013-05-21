<?php

class Model_User extends Model_Table {

    public $table = 'user';

    function init() {
        parent::init();
        //$this->addField('name');
        $this->addField('first_name')->mandatory('Enter your first name.')->caption('First name');
        $this->addField('last_name')->caption('Last name');
        $this->addField('email')->mandatory(true);//->type('email');
        //$this->addField('detail')->type('text');        
        $this->addField('password')->type('password')->mandatory('Enter the password.'); //->display('password')
        $this->addField('display_name')->caption('Display name');
        $this->addField('birth_date')->type('date');
        $this->addField('created')->type('datetime')->defaultValue(date('Y-m-d H:i:s')); //0000-00-00 00:00:00
        $this->addField('status')->enum(array('active', 'ban', 'disable'))->mandatory('Please select user status.')->defaultValue('active'); //->display(array('form'=>'Radio'));
        $this->addField('is_admin')->type('boolean')->caption('Admin');
        $this->addField('is_editor')->type('boolean')->caption('Editor');
        $this->addField('is_blogger')->type('boolean')->caption('Blogger');
        $this->addField('is_member')->type('boolean')->defaultValue(1)->caption('Member');
        $this->addField('last_log')->type('datetime')->defaultValue(date('Y-m-d H:i:s'));
        $this->addField('identifier')->defaultValue(md5(time() . ($_SERVER['HTTP_X_FORWARDED_FOR'] ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'])));
        $this->addField('website');
        $this->addField('score')->type('number')->mandatory(TRUE)->caption('Scores')->defaultValue(0);
//
        $this->addHook('beforeSave', function($m) {
            $m['email'] = trim(strtolower($m['email']));
        });
    }

}
