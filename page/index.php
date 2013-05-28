<?php

class page_index extends Page {

    function init() {
        parent::init();
        //$form = $this->add('Form', null, 'LoginForm');
        if (!$this->api->auth->isLoggedIn()) {
            $form = $this->add('Form');
            $form->add('HTML')->set('<h3 class="login-hrd">Login system</h3>');
            $form->add('HTML')->set('<span class="txt-msg">Check your emai and password, be careful to use impersonation.</span>');

            $form->setFormClass('vertical');
            $form->addField('line', 'email')->validateNotNull('Please enter email')->validateField('filter_var($this->get(), FILTER_VALIDATE_EMAIL)', 'Email invalid');
            $form->addfield('password', 'password')->validateNotNull('Please enter password');
            //->setFieldHint('Click "Register" to create new member');
            $form->addSubmit('Login')->setIcon('ui-icon-person');
            $this->api->template->set($form);
            $form->addClass('atk-box ui-state-default ui-corner-all');
            /*
              $reg_form = $this->add('Form');
              $reg_field = array('first_name', 'last_name');
              $reg_form->addClass('stacked');
              $reg_form->setModel('User', $reg_field);
              $reg_form->addField('line', 'display_name')->setFieldHint('People can see your display name.');
              $reg_form->addField('line', 'email')->validateNotNull('Please enter email')->validateField('filter_var($this->get(), FILTER_VALIDATE_EMAIL)', 'Email invalid');
              $reg_form->addField('password', 'password');
              $reg_form->addField('password', 'password2');
              $reg_form->addSubmit('Register');
              $reg_form->addButton('Cancel');
              $reg_form->js(true)->hide();
             */
            $forgot_frm = $this->add('Form');
            $forgot_frm->addComment('Please check your email after submited.');
            $forgot_frm->addField('line', 'email', 'Email address :')->validateNotNull('Please enter email')->validateField('filter_var($this->get(), FILTER_VALIDATE_EMAIL)', 'Email invalid');
            $forgot_frm->addClass('stacked');
            $forgot_frm->addSubmit('Sent email');
            $forgot_frm->js(true)->hide();

            $p_reg = $this->add('p');
            //$p_reg->add('p')->addClass('reg-class')->set('Register')->js('click', $reg_form->js()->dialog());
            $p_reg->add('p')->addClass('reg-class')->set('Register')->js('click')->univ()->frameURL('Register new member', $this->api->url('./register'), array('width' => '550px'));
            $p_pass = $this->add('p');
            $p_pass->add('p')->addClass('forget-pass')->set('Forget password')->js('click', $forgot_frm->js()->dialog());

            if ($form->isSubmitted()) {
                $auth = $this->api->auth;
                $l = $form->get('email');
                $p = $form->get('password');
                //$enc_p = $auth->encryptPassword($p, $l);
                if ($auth->verifyCredentials($l, $p)) {
                    $auth->login($l);
                    $form->js()->univ()->redirect('/')->execute();
                }
                $form->getElement('password')->displayFieldError('Incorrect login');
            }
        } else {
            $this->add('HTML')->set('<h2>Logedin</h2>');
        }
        $blog_lister = $this->add('ListBlog', null, 'Listblog', 'Listblog');
        $blog_lister->setModel('Blog_Blog');
        $blog_lister->dq->order('created', true)->limit(5);
        //------------------------------------------------------- Board
        $topic_lister = $this->add('ListBoard', null, 'Listboard', 'Listboard');
        $topic_lister->setModel('Board_Topic');
        $topic_lister->dq->order('created', true)->limit(5);
    }

    function defaultTemplate() {
        return array('index');
    }

}

class ListBoard extends CompleteLister {

    function formatRow() {
        $this->current_row['detail'] = mb_substr($this->current_row['detail'], 0, 300);
        $this->current_row['topic'] = mb_substr($this->current_row['topic'], 0, 300);
        $this->current_row['link'] = $this->api->getDestinationURL('forum/read', array('id' => $this->current_row['id']));
    }

}

class ListBlog extends CompleteLister {

    function formatRow() {
        //$this->trySet('page_title',$this->current_row['title']);
        $this->current_row['intro'] = mb_substr($this->current_row['detail'], 0, 300);
        $this->current_row['title'] = mb_substr($this->current_row['title'], 0, 300);
        $this->current_row['link'] = $this->api->getDestinationURL('blog/read', array('id' => $this->current_row['id']));
    }

}
