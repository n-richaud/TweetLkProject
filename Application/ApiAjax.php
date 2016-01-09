<?php
//nom de l'application
$nameApp = "ApiTest";

//action par défaut
$action = "index";

if(key_exists("action", $_REQUEST))
$action =  $_REQUEST['action'];

require_once 'lib/core.php';
require_once $nameApp.'/controller/mainController.php';
session_start();

$context = context::getInstance();
$context->init($nameApp);

$json=$context->executeAction($action, $_REQUEST);


if($json===false)
{
	
}
else
{
	echo $json
}



?>
