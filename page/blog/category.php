<?php

class page_blog_category extends Page{
        function init() {
        parent::init();
        $cate_id = $_GET['id'];
        $this->memorize('cate_id', $cate_id);
        $blog_cate = $this->api->add('Model_Blog_Category');
        $category = $blog_cate->getBy('id', $cate_id);
        $this->template->setHTML('blog_cate_name','<div class="atk-box span-header span-header-blog ui-state-default ui-corner-all"><a href="./../" style="font-size:18px;">Blog</a> / '.$category['name'].'</div>');
        
        $lister = $this->add('CateBlog', null, 'Posts', 'Posts');
        $lister->setModel('Blog_Blog')->addCondition('blog_category_id',  $this->recall('cate_id'));
        $paginator = $lister->add('Paginator', NULL, 'Paginator');
        $paginator->ipp(5);
        $this->api->template->set('page_title', 'Blogs');
        
        //var_dump($lister);
        
        $this->add('View_Menublog', null, 'Menublog');
    }

    function defaultTemplate() {
        return array('page/blog/index');
    }
}

class CateBlog extends CompleteLister {

    function formatRow() {
        //$this->current_row['img'] = 'xxx';
        //var_dump($this->current_row);
        
        $this->current_row['views'] = $this->current_row['views'] ? number_format($this->current_row['views']) : 0;
        $this->current_row['created'] = date("Y-m-d", strtotime($this->current_row['created']));
        $this->current_row['intro'] = (mb_strlen(strip_tags($this->current_row['detail'])) > 250) ? mb_substr(strip_tags($this->current_row['detail']), 0, 250) : strip_tags($this->current_row['detail']);
        $this->current_row['title'] = (mb_strlen(strip_tags($this->current_row['title'])) > 250) ? mb_substr(strip_tags($this->current_row['title']), 0, 250) : strip_tags($this->current_row['title']);
        $this->current_row['link'] = $this->api->getDestinationURL('blog/read', array('id' => $this->current_row['id']));
    }
}