<?php
class Model_Board_Rating extends Model_Table{
    public $table = 'reply_rating';
    function init() {
        parent::init();
        $this->addField('score');
        $this->addField('reply_id');
        $this->addField('user_id');      
    }
}
