<?php

class Controller_Bloglist extends AbstractController {

    public function init() {
        parent::init();
        $this->add('Bloglist',null, 'Posts', 'Posts');
    }

}

class Bloglist extends CompleteLister {

    function formatRow() {
        //$this->current_row['img'] = 'xxx';
        $this->current_row['views'] = $this->current_row['views'] ? number_format($this->current_row['views']) : 0;
        $this->current_row['created'] = date("Y-m-d", strtotime($this->current_row['created']));
        $this->current_row['intro'] = (mb_strlen(strip_tags($this->current_row['detail'])) > 250) ? mb_substr(strip_tags($this->current_row['detail']), 0, 250) : strip_tags($this->current_row['detail']);
        $this->current_row['title'] = (mb_strlen(strip_tags($this->current_row['title'])) > 250) ? mb_substr(strip_tags($this->current_row['title']), 0, 250) : strip_tags($this->current_row['title']);
        $this->current_row['link'] = $this->api->getDestinationURL('blog/read', array('id' => $this->current_row['id']));
    }

}