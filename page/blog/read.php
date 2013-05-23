<?php

class page_blog_read extends Page {

    function init() {
        //session_start();
        parent::init();
        if ($_GET['id']) {
//            $data = $this->api->db->dsql()->table('blog')
//                    ->field('*')
//                    ->where('id', $_GET['id'])
//                    ->do_getHash();
//            if (!$data)
//                throw $this->exception('No such blog post');
            $view = $this->add('View', null, 'Post', 'Post');
            //$model_blog = $this->add('Model_Blog_Blog');
            //$item->load($_GET['item_id']);
            $data = $view->setModel('Blog_Blog')->load($_GET['id']);
            $data['title'] = strip_tags($data['title']);
            $view->template->setHTML($data);
            $this->api->template->trySet('page_title', strip_tags($data['title']));
            $this->api->template->trySet('page_description', mb_substr(strip_tags($data['detail']), 0, 300));


            // Comment List
            $this->memorize('blogid', $_GET['id']);
            $_SESSION['sess1'] = rand(1, 10);
            $_SESSION['sess2'] = rand(1, 10);
        }
        $this->add('H3')->set('Allow comments');
        $model_comment = $this->add('Model_Blog_Comment');

        $form = $this->add('Form'); //->addClass('atk-row');
        $form->setModel($model_comment, array('user_comment'));
        $form->addField('hidden', 'bid')->set($this->recall('blogid', $_GET['id']));
        $form->addField('hidden', 'getans')->set($_SESSION['sess1'] + $_SESSION['sess2']);
        $form->addField('text', 'comment')->addClass('span12');
        $form->addSubmit('Save your comment');

        $lister = $this->add('ListComment', null, 'ListComment', 'ListComment');
        $lister->setModel($model_comment)->addCondition('blog_id', $this->recall('blogid', $_GET['id'])); //$_GET['id'] ? $_GET['id'] : $form->get('bid')
        $paginator = $lister->add('Paginator', NULL, 'Paginator');
        $paginator->ipp(2);


        $sec_image_field = $form->addField('line', 'sec_image', 'Security code')->addClass('span3')
                ->validateNotNull(); // ->setNoSave()
        if (isset($_SESSION['sess1'])) {
            $txt_code = '( ' . $_SESSION['sess1'] . ' + ' . $_SESSION['sess2'] . ' ) = ';
            $sec_image_field->template->set('before_field', $txt_code);
        }

        if ($form->isSubmitted()) {
            $getans = $form->get('getans');
            if ($form->get('sec_image') != $getans) {
                return $sec_image_field->displayFieldError('Security code not match.');
            }
            // 'blog_id','member_comment','user_comment'         
            $model_comment->set('comment', $form->get('comment'));
            $model_comment->set('blog_id', $form->get('bid'));
            $form->update();
            $lister->js(null,$form->js(null,$form->js()->reload())->univ()->successMessage('Save data completed'))->reload()->execute();
            //$form->js(true)->univ()->successMessage('OK')->execute();
        }

        //$paginator = $lister->add('Paginator', NULL, 'Paginator');
        //$paginator->ipp(2);
        //$this->api->jui->addStaticInclude('ckeditor/ckeditor');    

        $this->add('View_Menublog', null, 'Menublog');
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