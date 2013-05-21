<?php

class page_advertise extends Page {

    public function init() {
        parent::init();

        $tabs = $this->add('Tabs');

        $tab_1 = $tabs->addTab('Advertise');
        $crud_ads = $tab_1->add('CRUD');
        $model_ads = $this->add('Model_Advertise_Ads');

        $show = array('title', 'created', 'status', 'start_date', 'end_date', 'user', 'ads_option_id');
        $field = array('title', 'url','status', 'start_date', 'end_date', 'user_id', 'ads_option_id');
        $crud_ads->setModel($model_ads, $field, $show);
        if ($crud_ads->grid) {       
            foreach ($show as $value) {
                $crud_ads->grid->getColumn($value)->makeSortable();
            }
            $crud_ads->grid->addQuickSearch($show);
            $crud_ads->grid->addPaginator(4);
        }
//        if ($crud_ads->form) {
//            if ($crud_ads->form->isSubmitted()) {
//                if ($crud_ads->form->get('start_date') > $crud_ads->form->get('end_date')) {
//                    $crud_ads->form->displayError('start_date', 'Start date should befor end date.');
//                    die();
//                }
//                // echo $crud_ads->form->get('start_date');
//                // set invoid here
//                //echo $model_ads->get('id');
//            }
//        }
        $tab_2 = $tabs->addTab('Options');
        $model_opt = $this->add('Model_Advertise_Option');
        $crud_option = $tab_2->add('CRUD');
        //$model_opt->addField('image')->display('upload');
        $arr = array('id', 'name', 'price', 'image');
        $arr_f = array('name', 'price', 'image');
        $crud_option->setModel($model_opt, $arr_f, $arr);
        if ($crud_option->grid) {
            $crud_option->grid->addQuickSearch($arr);
            foreach ($arr as $value) {
                $crud_option->grid->getColumn($value)->makeSortable();
            }
            $crud_option->grid->addPaginator(4);
        }
//        if ($crud_option->form) {
//            $f = $crud_option->form;
//            $upload = $f->addField('filename', 'Add Photos')->setModel('filestore\Model_Image');
//            //$f->add($upload->loadAny('filename'))->setModel($model_opt);
//             $model_opt->set('image',$crud_option->form->get('upload'));
//        }
    }

}
