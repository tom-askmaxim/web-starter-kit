<?php

class page_blog_read extends Page {

    function init() {
        //session_start();
        parent::init();        
        if ($_GET['id']) {
            $data = $this->api->db->dsql()->table('blog')
                    ->field('*')
                    ->where('id', $_GET['id'])
                    ->do_getHash();
            if (!$data)
                throw $this->exception('No such blog post');
            $view = $this->add('View', null, 'Post', 'Post');
            $data['title'] = strip_tags($data['title']);            
            $view->template->setHTML($data);
            $this->api->template->trySet('page_title', strip_tags($data['title']));
            $this->api->template->trySet('page_description', mb_substr(strip_tags($data['detail']), 0, 300));

            // Comment List

            $_SESSION['sess1'] = rand(1, 10);
            $_SESSION['sess2'] = rand(1, 10);
        }
        $this->add('H3')->set('Allow comments');
        $model = $this->add('Model_Blog_Comment');
        $form = $this->add('Form')->addClass('atk-row');
        $form->setModel($model, array('user_comment'));
        $form->addField('hidden', 'id')->set($_GET['id'] ? $_GET['id'] : $form->get('id'));
        $form->addField('hidden', 'getans')->set($_SESSION['sess1'] + $_SESSION['sess2']);
        $form->addField('text', 'comment')->addClass('span12');
        $form->addSubmit('Save your comment');


        
        $data = $this->api->db->dsql()->table('blog_comment')
                ->field('*')
                ->where('blog_id', $_GET['id'] ? $_GET['id'] : $form->get('id'))
                ->do_getAllHash();
        if ($data) {
            $lister = $this->add('ListComment', null, 'ListComment', 'ListComment');
            $lister->setSource($data);
            foreach ($data as $row) {
                $row['link'] = $this->api->getDestinationURL('blog/read', array('id' => $row['id']));
                $this->api->template->set($row);
            }
        }

        //$this->api->jui->addStaticInclude('ckeditor/ckeditor');        
        $sec_image_field = $form->addField('line', 'sec_image', 'Security code')->addClass('span3')
                ->validateNotNull(); // ->setNoSave()
        if (isset($_SESSION['sess1'])) {
            $txt_code = '( ' . $_SESSION['sess1'] . ' + ' . $_SESSION['sess2'] . ' ) = ';
            $sec_image_field->template->set('before_field', $txt_code);
        }
        
        // Blog Menu widget
        $this->add('View_Menublog', null, 'Menublog');

        if ($form->isSubmitted()) {
            $getans = $form->get('getans');
            if ($form->get('sec_image') != $getans) {
                return $sec_image_field->displayFieldError('Security code not match.');
            }
            // 'blog_id','member_comment','user_comment'         
            $model->set('comment', $form->get('comment'));
            $model->set('blog_id', $form->get('id'));
            $form->update();
            $form->js()->reload()->execute();
            $form->js()->univ()->successMessage('Comment are saved.')->execute();
            
        }
    }

    function defaultTemplate() {
        return array('page/blog/read');
    }

}

class ListComment extends CompleteLister {

    function formatRow() {
        $this->current_row['image'] = '<img src="#">' . $this->current_row['keywords'];
        $this->current_row['menutitle'] = strip_tags($this->current_row['description']);
        //$this->trySet('page_title',$this->current_row['title']);
        $this->current_row['intro'] = mb_substr($this->current_row['description'], 0, 300);
        $this->current_row['title'] = $this->current_row['comment'];
        $this->current_row['link'] = $this->api->getDestinationURL('blog/read', array('id' => $this->current_row['id']));
    }

}