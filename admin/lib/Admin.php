<?php

class Admin extends ApiFrontend {

    //public $is_admin=true;

    function init() {
        parent::init();
        $this->dbConnect();

        $this->addLocation('..', array(
            'php' => array(
                'lib',
            )
        ))->setParent($this->pathfinder->base_location);

        $this->addLocation('../atk4-addons', array(
            'php' => array(
                'mvc',
                'misc/lib',
                'forum'
            )
        ))->setParent($this->pathfinder->atk_location);
//->setParent($this->pathfinder->atk_location);
        $this->addLocation('./', array('addons' => 'ambient-addons')
        );
        //$this->add("cms/Controller_Cms");
        $this->add('jUI');
        $this->js()
                ->_load('atk4_univ')
                ->_load('ui.atk4_notify');

//        $url = $this->api->locateURL('js', 'wymeditor/jquery.wymeditor.js');
//        $this->api->template->append('js_include', '<script type="text/javascript" src="' .
//                $url . '"></script>' . "\n");
        // Allow user: "admin", with password: "demo" to use this application
        //$this->add('Auth')->setModel('User');
        $this->add('Auth')->usePasswordEncryption('sha256/salt')->setModel('User');
        if ($this->auth->isLoggedIn()) {
            $is_admin = $this->auth->model['is_admin'];
            $is_active = $this->auth->model['status'];
            if (!$is_admin || $is_active != 'active')
                $this->api->redirect('/logout');
            
            $this->api->db->dsql()->table('user')->where('id', $this->api->auth->get('id'))->set('last_log', date("Y-d-m H:i:s"))->do_update();

            $menu = $this->add('Menu', null, 'Menu');
            $menu->addMenuItem('index', 'Dashboard')
                    ->addMenuItem('user', 'Users')
                    ->addMenuItem('blog', 'Blogs')
                    ->addMenuItem('board', 'Webboard')
                    //->addMenuItem('product', 'Product & Service')
                    ->addMenuItem('news')
                    ->addMenuItem('advertise', 'Advertising')
                    ->addMenuItem('payment')
                    ->addMenuItem('fileadmin', 'Files manage')
                    ->addMenuItem('setting')
                    ->addMenuItem('report')
                    ->addMenuItem('logout');
            //$this->add('H1', null, 'logo')->set('Admin Control panel');
        }
        $this->auth->check();
    }

}
