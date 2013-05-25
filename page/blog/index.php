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
        //$this->current_row['img'] = 'xxx';
        $this->current_row['views'] = $this->current_row['views'] ? number_format($this->current_row['views']) : 0;
        $this->current_row['created'] = date("Y-m-d", strtotime($this->current_row['created']));
        $this->current_row['intro'] = (mb_strlen(strip_tags($this->current_row['detail'])) > 250) ? mb_substr(strip_tags($this->current_row['detail']), 0, 250) : strip_tags($this->current_row['detail']);
        $this->current_row['title'] = (mb_strlen(strip_tags($this->current_row['title'])) > 250) ? mb_substr(strip_tags($this->current_row['title']), 0, 250) : strip_tags($this->current_row['title']);
        $this->current_row['link'] = $this->api->getDestinationURL('blog/read', array('id' => $this->current_row['id']));
    }

}
