<?php

class View_Menublog extends AbstractView {

    public function init() {
        parent::init();

        $data = $this->api->db->dsql()->table('blog')
                ->field('*')
                ->do_getAllHash();
        $lister = $this->add('MenuBlog', null, 'Posts', 'Posts');
        $lister->setSource('blog_category');
        $lister->dq->order('created', true);
        foreach ($data as $row) {
            // We need to customize data slightly by properly formatting URL
            $row['link'] = $this->api->getDestinationURL('blog/category', array('id' => $row['id']));
            //$row['detail'] = $row['detail'];
            $this->api->template->set($row);
        }
    }

    function defaultTemplate() {
        return array('view/menublog', 'Menublog');
    }

}

class MenuBlog extends CompleteLister {

    function formatRow() {
        $this->current_row['image'] = '<img src="#">' . $this->current_row['keywords'];
        $this->current_row['menutitle'] = $this->current_row['description'];
        //$this->trySet('page_title',$this->current_row['title']);
        $this->current_row['intro'] = mb_substr($this->current_row['description'], 0, 300);
        $this->current_row['title'] = mb_substr($this->current_row['name'], 0, 300);
        $this->current_row['link'] = $this->api->getDestinationURL('blog/read', array('id' => $this->current_row['id']));
    }

}
