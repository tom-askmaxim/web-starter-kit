<?php

$config['atk']['base_path'] = '/echo_analize/atk4/';
$config['dsn'] = 'mysql://root:1234@localhost/echo_analize_db';

//$config['url_postfix']='';
//$config['url_prefix']='?page=';
$config['logger']['web_output'] = TRUE;
$config['url_postfix'] = '/';
$config['url_prefix'] = '';
$config['auth']['key'] = 'analize-secret';
$config["frontend"]["token"] = 'secret-token';
$config['site_name'] = 'echoanalize.com';
#
#  http://www.atk4.com/doc/config

