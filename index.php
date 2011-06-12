<?php
include('/protected/globals/functions.php');
include('/protected/globals/shortcuts.php');

// change the following paths if necessary
$yii=dirname(__FILE__).'/../YiiFramework/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

define('SALT_LENGTH', 9);
define('SALT_GLOBAL', 'o3IY{%S^G.[xV6C%jtRsrf"[2');

require_once($yii);
Yii::createWebApplication($config)->run();
