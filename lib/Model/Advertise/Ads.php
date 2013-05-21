<?php
class Model_Advertise_Ads extends Model_Table{
    public $table = 'advertise';
    function init() {
        parent::init();
        $this->addField('title')->mandatory(true);
        $this->addField('url')->type('string');
        $this->addField('image');
        $this->addField('created')->type('datetime')->defaultValue(date('Y-m-d H:i:s'));
        $this->addField('start_date')->type('date');
        $this->addField('end_date')->type('date');
        $this->addField('status')
                ->datatype('list')
                ->listData(array(
                    'enabled' => 'Enabled',
                    'disabled' => 'Disabled',
                    'expired'=> 'Expired'
                ))
                ->mandatory(true)->defaultValue('public');
        //$this->addField('user_id')->defaultValue($this->api->auth->get('id'));
        $this->addField('ads_option_id')->refModel('Model_Advertise_Option')->mandatory(true);
        //$this->hasOne('Model_Advertise_Option', 'ads_option_id', 'name');
        $this->hasOne('User', 'user_id', 'display_name')->defaultValue($this->api->auth->get('id'));
    }
}
