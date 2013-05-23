<?php

class page_blog_index extends Page {

    function init() {
        parent::init();
        $lister = $this->add('MyBlog', null, 'Posts', 'Posts');
        $lister->setModel('Blog_Blog');
        $paginator = $lister->add('Paginator', NULL, 'Paginator');
        $paginator->ipp(10);
        $this->api->template->set('page_title', 'Blogs');
        $this->add('View_Menublog', null, 'Menublog');
    }

    function defaultTemplate() {
        return array('page/blog/index');
    }

}

class MyBlog extends CompleteLister {

    function formatRow() {
        //$this->trySet('page_title',$this->current_row['title']);
        $this->current_row['intro'] = mb_substr(strip_tags($this->current_row['detail']), 0, 300);
        $this->current_row['title'] = mb_substr(strip_tags($this->current_row['title']), 0, 300);
        $this->current_row['link'] = $this->api->getDestinationURL('blog/read', array('id' => $this->current_row['id']));
    }

}
