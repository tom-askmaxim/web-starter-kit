<?php

class page_preference extends Page {

    public function init() {
        parent::init();
        if (!$this->api->auth->isLoggedIn()) {
            $this->api->auth->check();
        }
        $is_active = $this->api->auth->model['status'];
        if ($is_active != 'active') {
            $this->add('H2')->set('User is disabled');
        } else {
            $tabs = $this->add('Tabs');
            $tab_1 = $tabs->addTab('Account');
            $cols = $tab_1->add('Columns');
            $left_col = $cols->addColumn(5);
            $edit_btn = $left_col->add('button')->set('Edit account');
            $setting_btn = $left_col->add('button')->set('Setting');
            $reload_btn = $left_col->add('button')->set('Reload');
            $show_f = $left_col->add('p');
            $show_f->add('HTML')->set($this->gen_html());

            $right_col = $cols->addColumn(7);
            //$main_elm = $right_col->add('p');//->addClass('atk-box ui-state-default ui-corner-all');
            $user_form = $right_col->add('Form')->addClass('atk-box ui-state-default ui-corner-all');
            $user_form->add('h3')->addClass('atk-box ui-state-hover ui-corner-all')->set('Edit profile');
            $user_form->setModel('User');
            $user_form->js(true)->hide();

            if ($edit_btn->isClicked()) {
                //$user_form->js()->show()->reload()->execute();
                $user_form->js(TRUE)->toggle()->execute();
            }
            if ($reload_btn->isClicked()) {
                $this->js()->reload()->execute();
            }
            //-----------------

            $blog_model = $this->add('Model_Blog_Blog');
            $topic_model = $this->add('Model_Board_Topic');

            $tab_2 = $tabs->addTab('Web board');
            $crud_topic = $tab_2->add('GRID');
            $crud_topic->setModel($topic_model)->addCondition('user_id', $this->api->auth->model['id']);

            $tab_3 = $tabs->addTab('Blogs');
            $crud_blog = $tab_3->add('GRID');
            $crud_blog->setModel($blog_model)->addCondition('user_id', $this->api->auth->model['id']);

            $tab_4 = $tabs->addTab('Messages');
        }
    }

    function gen_html() {
        //$this->api->auth->get('xxxxxx')
        $html = '<hr/><dl>';
        $html .= '<dt>Name</dt>';
        $html .= '<dd>' . $this->api->auth->get('first_name') . ' ' . $this->api->auth->get('last_name') . '</dd>';
        $html .= '<dt>Email</dt>';
        $html .= '<dd>' . $this->api->auth->get('email') . '</dd>';
        $html .= '<dt>display_name</dt>';
        $html .= '<dd>' . $this->api->auth->get('display_name') . '</dd>';
        $html .= '<dt>birth_date</dt>';
        $html .= '<dd>' . $this->api->auth->get('birth_date') . '</dd>';
        $html .= '<dt>created</dt>';
        $html .= '<dd>' . $this->api->auth->get('created') . '</dd>';
        $html .= '<dt>status</dt>';
        $html .= '<dd>' . $this->api->auth->get('status') . '</dd>';
        $html .= '<dt>User type</dt>';
        $html .= '<dd>' . $this->api->auth->get('is_member') . '</dd>'; // is_admin is_editor is_blogger
        $html .= '<dt>last_log</dt>';
        $html .= '<dd>' . $this->api->auth->get('last_log') . '</dd>';
        $html .= '<dt>identifier</dt>';
        $html .= '<dd>' . $this->api->auth->get('identifier') . '</dd>';
        $html .= '<dt>website</dt>';
        $html .= '<dd>' . $this->api->auth->get('website') . '</dd>';
        $html .= '<dt>score</dt>';
        $html .= '<dd>' . $this->api->auth->get('score') . '</dd>';

        $html .= '</dl>';
        return $html;
    }

}
