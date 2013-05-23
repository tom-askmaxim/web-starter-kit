<?php

class page_user extends Page {

    function init() {
        parent::init();

        $model_user = $this->add('Model_User');
        $show = array('id', 'full_name', 'email', 'display_name', 'status', 'is_admin', 'is_editor', 'is_blogger', 'is_member', 'score');
        $form_set = array('first_name', 'last_name', 'email', 'password', 'display_name', 'birth_date', 'status', 'is_admin', 'is_editor', 'is_blogger', 'is_member', 'website', 'score');

        $model_user->addExpression('full_name')->set('concat(first_name," ",last_name)')->caption('Full name');
        $crud = $this->add('CRUD');
        //$crud->add('Icon');
        //$crud->add_button->set("Add New Scholar");
        $crud->setModel($model_user, $form_set, $show);

        if ($crud->grid) {
            $crud->grid->addClass('zebra bordered');
            $crud->grid->setSource('User');
            $crud->grid->addQuickSearch($show, 'QuickSearch', array('show_cancel' => true));
            foreach ($show as $value) {
                $crud->grid->getColumn($value)->makeSortable();
            }
            $crud->grid->addPaginator(4);
        }
    }

}