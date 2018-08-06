<?php

$config=[]; //dirname(__FILE__).'/config/main.php';

require_once(dirname(__FILE__).'/framework/VI.php');

$vi = VI::createWebApp($config);
$vi->run();