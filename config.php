<?php

$config['atk']['base_path'] = '/echo_analize/atk4/';
$config['dsn'] = 'mysql://root:1234@localhost/echo_analize_db';

// System config
//$config['url_postfix']='';
//$config['url_prefix']='?page=';
$config['logger']['web_output'] = TRUE;
$config['url_postfix'] = '/';
$config['url_prefix'] = '';
$config['auth']['key'] = 'analize-secret';
$config["frontend"]["token"] = 'secret-token';
$config['site_url'] = 'echo_analize';

// Text Editor config
$config['editor']['jwysiwyg']['basic'] = array();
$config['editor']['jwysiwyg']['advance'] = array();
$config['editor']['jwysiwyg']['manager'] = array();
$config['editor']['elrte']['basic'] = [
    'cssClass' => 'el-rte',
    // lang     : 'ru',
    'height' => 450,
    'toolbar' => 'web2pyToolbar',
    'allowSource' => false
        //'cssfiles' => ['../../templates/js/elrte/css/elrte-inner.css']
];
$config['editor']['elrte']['advance'] = array();
$config['editor']['elrte']['manager'] = array();


# Docs : http://www.atk4.com/doc/config

