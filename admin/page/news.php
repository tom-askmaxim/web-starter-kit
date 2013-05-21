<?php

class Page_news extends Page {

    public function init() {
        parent::init();

        $model_news = $this->add('Model_News');
        $model_news->getElement('status')->display(array('form' => 'Radio'));
        $crud = $this->add('CRUD');
        $show_list = array('id', 'title', 'description', 'status', 'created', 'user');
        $show_from = array('title', 'description', 'status');
        $crud->setModel($model_news, $show_from, $show_list);
        

        if ($crud->grid) {
            $crud->grid->setSource('News');
            foreach ($show_list as $value) {
                $crud->grid->getColumn($value)->makeSortable();
            }
            $crud->grid->addQuickSearch($show_list);
            $crud->grid->addPaginator(4);
        }
    }

}
