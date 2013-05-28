<?php

class page_forum_read extends Page {
    function init() {
        parent::init();
        if ($_GET['id']) {
            $view = $this->add('View', null, 'Post', 'Post');
            $topic = $this->add('Model_Board_Topic');
            $topic->load($_GET['id']);
            $data['detail'] = $topic->data['detail'];
            $data['title_topic'] = strip_tags($topic->data['topic']);
            $data['board'] = $topic->data['board'];
            $user_link = '#';
            $user_title = 'Guest';
            if ($topic->data['user_id']) {
                $user = $this->api->add('Model_User');
                $data_user = $user->getBy('id', $topic->data['user_id']);
                $url = '../../user/?iden=' . $data_user['identifier'];
                $user_link = $url;
                $user_title = 'See ' . $data_user['display_name'];
            }
            if ($topic->data['user'])
                $view->template->setHTML('owner', '<b><a href="' . $user_link . '">' . $topic->data['user'] . '</a></b>');
            else
                $view->template->setHTML('owner', '<b>' . $topic->data['user_comment'] . '</b> (Guest)');
            
            $data['created'] = date("m/d/Y (H:i:s)",  strtotime($topic->data['created']));
            $data['user_link'] = $user_link;
            $data['user_title'] = $user_title;
            $view->template->setHTML($data);
            //$data = $view->setModel('Board_Topic')->load($_GET['id']);
            $this->api->template->trySet('page_title', $data['title_topic']);
            $this->api->template->trySet('page_description', mb_substr(strip_tags($data['detail']), 0, 300));

            $this->api->db->dsql()->table('topic')->set('views', $data['views'] + 1)->where('id', $_GET['id'])->update();
            $this->memorize('topicid', $_GET['id']);
            $_SESSION['sstopic1'] = rand(1, 10);
            $_SESSION['sstopic2'] = rand(1, 10);
        }
        $this->add('H3')->set('Allow comments');
        $p = $this->add('Button')->set('Register')->setIcon('ui-icon-person');
        $p->js('click')->univ()->frameURL('Register new member', $this->api->url('../../register'), array('width' => '550px'));

        $model_comment = $this->add('Model_Board_Reply');

        $form = $this->add('Form'); //->addClass('atk-row');        
        $form->setModel($model_comment, false);
        if (!$this->api->auth->isLoggedIn())
            $form->addField('line', 'user_comment', 'Guest name')->validateNotNull('Please enter name');

        $form->addField('hidden', 'tid')->set($this->recall('topicid', $_GET['id']));
        $form->addField('hidden', 'getans')->set($_SESSION['sstopic1'] + $_SESSION['sstopic2']);
        $form->addField('text', 'comment')->addClass('span12');
        $form->addSubmit('Save your comment');

        $lister = $this->add('ListReplay', null, 'ListReplay', 'ListReplay');
        $lister->setModel($model_comment)->addCondition('topic_id', $this->recall('topicid', $_GET['id']));
        $paginator = $lister->add('Paginator', NULL, 'Paginator');
        $paginator->ipp(2);
        //$model_comment->debug();

        $sec_image_field = $form->addField('line', 'sec_image', 'Security code')->addClass('span3')
                ->validateNotNull(); // ->setNoSave()
        if (isset($_SESSION['sstopic1'])) {
            $txt_code = '( ' . $_SESSION['sstopic1'] . ' + ' . $_SESSION['sstopic2'] . ' ) = ';
            $sec_image_field->template->set('before_field', $txt_code);
        }

        if ($form->isSubmitted()) {
            if (!$this->api->auth->isLoggedIn()) {
                $model_comment->set('user_comment', $form->get('user_comment'));
            }
            $getans = $form->get('getans');
            if ($form->get('sec_image') != $getans) {
                return $sec_image_field->displayFieldError('Security code not match.');
            }     
            $model_comment->set('comment', $form->get('comment'));
            $model_comment->set('topic_id', $form->get('tid'));
            $form->update();
            $lister->js(null, $form->js(null, $form->js()->reload())->univ()->successMessage('Save data completed'))->reload()->execute();
        }
        $this->api->jui->addStaticInclude('ckeditor/ckeditor');
        $this->api->jui->addStaticInclude('ckfinder/ckfinder');
        $this->api->jui->addStaticInclude('ckeditor/adapter/jquery');
        $form->getElement('comment')
                ->js(true)
                ->ckeditor(array(
                    'skin' => 'moonocolor',
                    'toolbar' => 'forum'
        ));

        $this->add('View_Menuforum', null, 'Menuforum');
    }

    function defaultTemplate() {
        return array('page/forum/read');
    }

}

class ListReplay extends CompleteLister {

    function formatRow() {
        $user_link = '#';
        $user_title = 'Guest';
        if ($this->current_row['member_comment']) {
            $user = $this->api->add('Model_User');
            $data = $user->getBy('id', $this->current_row['member_comment']);
            $url = '../../user/?iden=' . $data['identifier'];
            $user_link = $url;
            $user_title = 'See ' . $data['display_name'];
        }
        $this->current_row_html['display_name'] = $this->current_row['member_comment'] ? '<a href="' . $url . '">' . $data['display_name'] . '</a>' : $this->current_row['user_comment'];
        $this->current_row['user_link'] = $user_link;
        $this->current_row['user_title'] = $user_title;

        if ($this->current_row['member_comment'])
            $this->current_row_html['owner'] = '<b><a href="' . $user_link . '">' . $this->current_row['member_comment_2'] . '</a></b>';
        else
            $this->current_row_html['owner'] = $this->current_row['user_comment'] ? '<b>' . $this->current_row['user_comment'] . '</b> (Guest)' : 'Guest';

        $this->current_row_html['comment'] = $this->current_row['comment'];
        $this->current_row['created'] = date("d/m/Y (H:i:s)", strtotime($this->current_row['created']));
    }

}