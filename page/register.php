<?php
class page_register extends Page{
    function init() {
        parent::init();
        $model_user = $this->add('Model_User');
        $form = $this->add('Form');
        $form->setModel($model_user, array('first_name','last_name','email','display_name'));
        $form->addField('password','password_1','Password');//->mandatory('Enter password!');
        $form->addField('password','password_2','Password confirm');
        $form->addField('line','website');
        $form->addSubmit('Register');
        if($form->isSubmitted()){
            if($form->get('password_1') <> "" && $form->get('password_2') <> ""){
                if($form->get('password_1') != $form->get('password_2')){
                    $form->displayError('password_2','Password does not match.');
                }else{
                    $model_user->set('password',$form->get('password_1'));
                    $model_user->set('website',$form->get('website'));
                    
                    $form->update();
                    $form->js()->univ()->successMessage('We have send you confirmation email.')->execute();
                }
            }else{
                $form->displayError('password_2','Please enter password.');
            }
        }
    }
}