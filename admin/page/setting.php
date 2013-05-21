<?php

class page_setting extends Page {

    public function init() {
        parent::init();

        $tabs = $this->add('Tabs');
        $tab = $tabs->addTab('Profile');

        $cols = $tab->add('Columns');
        $left_col = $cols->addColumn(6);
        $form = $left_col->add('Form');
        //$form->addClass('stacked');
        $left_f = array('first_name', 'last_name', 'display_name', 'status', 'is_editor', 'is_blogger', 'is_member');
        $form->setModel($this->api->auth->model, $left_f);
        $form->addField('line', 'website')->set($this->api->auth->get('website'));
        $form->addField('DatePicker', 'birth_date', 'Birth date')->set($this->api->auth->get('birth_date'));
        $form->addField('line', 'email')->validateNotNull()->validateField('filter_var($this->get(), FILTER_VALIDATE_EMAIL)')->set($this->api->auth->get('email'))->disable();
        $form->addField('line', 'created')->set($this->api->auth->get('created'))->disable();
        $form->addField('line', 'last_log')->set($this->api->auth->get('last_log'))->disable();
        $form->addField('line', 'score')->set($this->api->auth->get('score'))->disable();
        $form->addField('line', 'identifier')->set($this->api->auth->get('identifier'))->disable();

        $form->addSubmit('Save and change');

        if ($form->isSubmitted()) {            
            //$this->api->auth->model->set('email',$form->get('email'));
            $this->api->auth->model->set('website', $form->get('website'));
            $this->api->auth->model->set('birth_date', $form->get('birth_date'));
            $form->update();
            $form->js()->univ()->successMessage('Save profile complete')->execute();
        }
        //----------------
        $rigth_col = $cols->addColumn(6);
        $form = $rigth_col->add('Form');
        $form->addClass('stacked');
        $form->setModel($this->api->auth->model, array('password'));
        $form->getElement('password')->add('StrengthChecker', null, 'after_field');

        $form->addField('password', 'comfirm_password');
        $form->addSubmit('Change password');

        if ($form->isSubmitted()) {
            if ($form->get('password') <> "" && $form->get('comfirm_password') <> "") {
                if ($form->get('password') != $form->get('comfirm_password')) {
                    $form->displayError('password', 'Password should match.');
                } else {
                    $form->update();
                    $form->js()->univ()->successMessage('Password is changed')->execute();
                }
            } else {
                $form->displayError('password', 'Enter password.');
            }
        }

        $tab = $tabs->addTab('Template');
    }

}
