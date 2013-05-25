<?php

class page_blog extends Page {

    function init() {
        parent::init();
        $filter = $this->add('Form');
        $filter->addField('DatePicker', 'from_date', 'From date')->set($this->recall('from_date', NULL));
        $filter->addField('DatePicker', 'to_date', 'To date')->set($this->recall('to_date', NULL) ? $this->recall('to_date', NULL) : date('d/m/Y'));
        $filter->addSubmit('Aplly filter');
        $filter->js(true)->hide();
        $clear = $filter->addSubmit('Clear');

        $tabs = $this->add('Tabs');
        $tab = $tabs->addTab('Blog');

        $crud_blog = $tab->add('CRUD');
        $model_blog = $this->add('Model_Blog_Blog');
        $show = array('title', 'detail', 'detail', 'status', 'created', 'blog_category_id', 'allow_comment', 'views', 'user');
        $form = array('title', 'detail', 'keywords', 'status', 'blog_category_id', 'allow_comment', 'views');
        $crud_blog->setModel($model_blog, $form, $show);
        if($crud_blog->form){
            $crud_blog->form->getElement('detail')
                ->js(true)
                ->elrte();
        }
        if ($filter->isSubmitted()) {
            if ($filter->isClicked($clear)) {
                $this->forget();
                //$filter->js(true)->hide();
                $this->js()->reload();
            } else {
                $this->memorize('from_date', $filter->get('from_date'));
                $this->memorize('to_date', $filter->get('to_date'));
            }
            $crud_blog->grid->js()->reload()->execute();
        }

        if ($crud_blog->grid) {
            $crud_blog->grid->addButton('Filter')->js('click',$filter->js()->dialog());
            
            $from = $this->recall('from_date', NULL);
            $to = $this->recall('to_date', NULL);
            if ($from)
                $crud_blog->grid->model->addCondition('created', '>=', $from);
            if ($to)
                $crud_blog->grid->model->addCondition('created', '<=', $to);
            //$crud_blog->grid->getElement('allow_comment')->display('radio');
            $crud_blog->grid->setSource('Blog_Blog');
            foreach ($show as $value) {
                $crud_blog->grid->getColumn($value)->makeSortable();
            }
            $crud_blog->grid->getColumn('allow_comment')->makeSortable();
            $show[] = 'id';
            $crud_blog->grid->addQuickSearch($show);
            $crud_blog->grid->addPaginator(10);
        }
//$model_blog->debug();

        $tab = $tabs->addTab('Category');
        $crud_cate = $tab->add('CRUD');
        $cate_field = array('name', 'description', 'keywords');
        $cate_show = array('id', 'name', 'description', 'keywords', 'created');
        $crud_cate->setModel('Blog_Category', $cate_field, $cate_show);
        if ($crud_cate->grid) {
            $crud_cate->grid->setSource('Blog_Category');
            foreach ($cate_show as $value) {
                $crud_cate->grid->getColumn($value)->makeSortable();
            }
            $crud_cate->grid->addQuickSearch($cate_show);
            $crud_cate->grid->addPaginator(10);
        }
        
        $tab = $tabs->addTab('New blog');
        $tab->add('h2')->set('Create new blog');
        $form = $tab->add('Form'); 
        $form->setModel($model_blog);
        $form->addSubmit('Create');
        $cancel = $form->addButton('Cancel');
        $cancel->js('click',$form->js()->reload());       
                //$lister->js()->reload()->execute();
        
        
        
        $this->api->jui->addStaticInclude('elrte/js/elrte.min');
        $form->getElement('detail')
                ->js(true)
                ->elrte(array(
                    'cssClass' =>'el-rte',
				// lang     : 'ru',
				'height'=> 450,
				'toolbar'=>'complete'
				//'cssfiles' => ['css/elrte-inner.css']
                ));
        //$('#editor').elrte(opts);
    }

}