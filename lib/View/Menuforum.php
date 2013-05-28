<?php

class View_Menuforum extends AbstractView {

    public function init() {
        parent::init();

        $data = $this->api->db->dsql()->table('board')
                ->field('*')
                ->do_getAllHash();
        $lister = $this->add('MenuForum', null, 'Posts', 'Posts');
        $lister->setSource('board');
        $lister->dq->order('created', true);
    }

    function defaultTemplate() {
        return array('view/menuforum', 'Menuforum');
    }

}

class MenuForum extends CompleteLister {

    function formatRow() {
        $this->current_row['image'] = '<img src="#">' . $this->current_row['keywords'];
        $this->current_row['menutitle'] = $this->current_row['description'];
        $this->current_row['intro'] = mb_substr($this->current_row['description'], 0, 300);
        $this->current_row['title'] = mb_substr($this->current_row['name'], 0, 300);
        $this->current_row['link'] = $this->api->getDestinationURL('blog/read', array('id' => $this->current_row['id']));
    }

}
