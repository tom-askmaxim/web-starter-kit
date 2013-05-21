<?php
/**
  * Page displaying our blog index
  */
class page_blog extends Page {
    function init(){
        parent::init();

        // We have moved functionality of blog list into a different view. It's
        // defined down  below, because we don't really use it on any other page.
        $lister = $this->add('MyBlog',null,'Posts','Posts');

        // Lister can fetch all the data from the table
        $lister->setSource('blog');
        $lister->dq->order('created',true);//->limit(5);  // Show only last 5 posts
        $this->add('View_Archive',null,'Archive');
        $this->api->template->trySet('page_title','Blogs');
        //$this->addPaginator(4);
    }
    function defaultTemplate(){
        return array('page/blog');
    }
}
class MyBlog extends CompleteLister {
    function formatRow(){
        //$this->trySet('page_title',$this->current_row['title']);
        $this->current_row['intro'] = mb_substr($this->current_row['detail'],0,300);
        $this->current_row['title']= mb_substr($this->current_row['title'],0,300);
        $this->current_row['link']=$this->api->getDestinationURL('read',array('id'=>$this->current_row['id']));
    }
}
