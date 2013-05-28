<?php

class page_forum_create extends Page {

    public function init() {
        parent::init();
        $this->add('H1')->set('New Topic');
        $model_topic = $this->add('Model_Board_Topic');

        $form = $this->add('Form');

        $form->setModel($model_topic, array('board_id'));
        $form->addField('line', 'topic'); //->validateNotNull();
        $form->addField('Text', 'detail');
        if ($this->api->auth->isLoggedIn()) {
            $form->addField('radio', 'allow_comment', 'Allow reply')->setValueList(array(
                'public' => 'Public',
                'member' => 'Member'
                    //'disabled' => 'Disabled',
            ))->set('public');
        } else {
            $form->addField('line', 'user_comment', 'Topic by'); //->validateNotNull();
        }
        $form->addSubmit()->set('Register')->setIcon('ui-icon-ok');

        if ($form->isSubmitted()) {
            if (mb_strlen($form->get('topic')) < 35) {
                $form->displayError('topic', 'Topic name is required (more than 35 characters)');
            }
            if(mb_strlen($form->get('detail')) < 50){
                $form->displayError('detail', 'Detail is required (more than 50 characters)');
            }
            if (!$this->api->auth->isLoggedIn())
            if (strlen($form->get('user_comment')) < 5) {
                $form->displayError('user_comment', 'Name is required many (more than 5 characters)');
            }
            if($form->get('allow_comment')){
                $model_topic->set('allow_comment', $form->get('allow_comment'));
            }
            $model_topic->set('topic', $form->get('topic'));
            $model_topic->set('detail', $form->get('detail'));
            $form->update();
             $this->api->redirect('..');

        }
//->elrte($this->api->getConfig('editor/elrte/basic'));

        $this->api->jui->addStaticInclude('ckeditor/ckeditor');
        $this->api->jui->addStaticInclude('ckfinder/ckfinder');
        $this->api->jui->addStaticInclude('ckeditor/adapter/jquery');

        $form->getElement('detail')
                ->js(true)
                ->ckeditor(array(
                    'skin' => 'moonocolor',
                    'toolbar' => 'forum'
        ));


        $this->add('View_Menuforum', null, 'Menuforum');
    }

    function defaultTemplate() {
        return array('page/forum/create');
    }

}