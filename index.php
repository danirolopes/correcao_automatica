<?php

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set("America/Sao_Paulo");

// ENVIRONMENT = TRUE  -> SERVER ENVIRONMENT
// ENVIRONMENT = FALSE -> LOCAL ENVIRONMENT
define('ENVIRONMENT', 0);

if(ENVIRONMENT){
	error_reporting(0);
}else{
	error_reporting(E_ALL);
}

require_once 'libs/Controller.php';
require_once 'libs/Model.php';
require_once 'libs/View.php';
require_once 'libs/Database.php';
require_once 'libs/Session.php';


require_once 'config/paths.php';
require_once 'config/database.php';
require_once 'config/constants.php';

require_once 'controllers/main_controller.php';

$start = new Main_Controller();
$start->handleRequest();


?>