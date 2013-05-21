<?php

class Page_board extends Page {

    function init() {
        parent::init();
        
        $tabs = $this->add('Tabs');
        $tab = $tabs->addTab('Topic');
        $crud_topic = $tab->add('CRUD');
        $f = array('topic', 'detail', 'allow_comment', 'keywords', 'allow_see', 'is_major', 'board_id');
        $g = array('id', 'topic', 'detail', 'allow_comment', 'keywords', 'allow_see', 'is_major', 'board_id', 'user');
        $crud_topic->setModel('Board_Topic', $f, $g);
        if ($crud_topic->grid) {
            $crud_topic->grid->setSource('Board_Topic');
            foreach ($g as $value) {
                $crud_topic->grid->getColumn($value)->makeSortable();
            }
            $crud_topic->grid->addQuickSearch($g);
            $crud_topic->grid->addPaginator(10);
            //$crud_topic->grid->getElement('allow_comment')->display('radio');
        }
        $tab = $tabs->addTab('Reply');
        $crud_reply = $tab->add('CRUD');
        $f = array('comment', 'member_comment', 'user_comment', 'best_reply', 'topic_id');
        $g = array('id', 'comment', 'created', 'member_comment', 'user_comment', 'best_reply', 'topic','ip_address');
        $crud_reply->setModel('Board_Reply', $f, $g);
        //$crud_reply->debug();
        if ($crud_reply->grid) {
            $crud_reply->grid->setSource('Board_Reply');
            foreach ($g as $value) {
                $crud_reply->grid->getColumn($value)->makeSortable();
            }
            $crud_reply->grid->addQuickSearch($g);
            $crud_reply->grid->addPaginator(10);
        }

        $tab = $tabs->addTab('Board');
        $crud_board = $tab->add('CRUD');
        $f = array('name','description','keywords','status');
        $g = array('name','description','keywords','created','status');
        $crud_board->setModel('Board_Board',$f,$g);
        if ($crud_board->grid) {
            $crud_board->grid->setSource('Board_Board');
            foreach ($g as $value) {
                $crud_board->grid->getColumn($value)->makeSortable();
            }            
            $crud_board->grid->addQuickSearch(array('name'));
            $crud_board->grid->addPaginator(10);
        }
    }

}