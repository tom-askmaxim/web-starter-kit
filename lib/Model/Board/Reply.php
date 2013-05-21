<?php
class Model_Board_Reply extends Model_Table{
    public $table = 'reply';
    function init() {
        parent::init();
        //$this->addField('reply');
        $this->addField('comment')->type('text');
        $this->addField('created')->type('datetime')->defaultValue(date('Y-m-d H:i:s'));
        $this->addField('user_comment')->caption('Geust');
        //$this->addField('topic_id');$this->get_client_ip()
        $this->addField('best_reply')->type('boolean');
        $this->hasOne('Board_Topic', 'topic_id', 'topic')->mandatory(true);
        $this->hasOne('User', 'member_comment', 'display_name')->caption('Member');
        $this->addField('ip_address')->defaultValue($this->getClientIP());
    }
        // Function to get the client ip address
    function getClientIP() {
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if ($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if ($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }
}
