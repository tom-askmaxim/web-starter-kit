<?php

//icon Title User Update Ryply View
class page_forum_index extends Page {

    public function init() {
        parent::init();

        $model_forum = $this->add('Model_Board_Topic');
        $model_forum->setOrder('created', 'desc');
        $model_forum->addExpression('reply_count')->set(function($model, $select){
            return $model->refSQL('Board_Reply')->count();
        });
        $lister = $this->add('Forum', null, 'Posts', 'Posts');
        $lister->setModel($model_forum);
        $paginator = $lister->add('Paginator', NULL, 'Paginator');
        $paginator->ipp(10);
        //$model_forum->debug();
        $this->api->template->set('page_title', 'Forums');
        $this->add('View_Menuforum', null, 'Menuforum');
    }

    function defaultTemplate() {
        return array('page/forum/index');
    }

}

     

class Forum extends CompleteLister {
function formatRow() {
//$this->trySet('page_title',$this->current_row['title']);
$this->current_row['created'] = date("d-m-Y",  strtotime($this->current_row['created']));
$this->current_row['views'] = number_format($this->current_row['views']);
$this->current_row['intro'] = mb_substr(strip_tags($this->current_row['detail']), 0, 300);
$this->current_row['title'] = mb_substr(strip_tags($this->current_row['topic']), 0, 300);
$this->current_row['link'] = $this->api->getDestinationURL('forum/read', array('id' => $this->current_row['id']));
}

}