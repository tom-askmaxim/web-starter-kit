<?php
class Model_Board_Board extends Model_Table{
    public $table = 'board';
    function init() {
        parent::init();
        $this->addField('name')->mandatory(true);
        $this->addField('description')->type('text');
        $this->addField('keywords');
        $this->addField('created')->type('datetime')->defaultValue(date('Y-m-d H:i:s'));
        $this->addField('status')
                ->datatype('list')
                ->listData(array(
                    'public' => 'Public',
                    'member' => 'Member',
                    'disabled' => 'Disabled',
                ))
                ->mandatory(true)->defaultValue('public');
    }
}