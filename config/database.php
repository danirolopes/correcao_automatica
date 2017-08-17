<?php

//ENVIRONMENT TRUE -> SERVER FALSE->LOCAL

if(ENVIRONMENT)
{
define('DB_HOST','');
define('DB_USER','');
define('DB_PWD','');
define('DB_NAME','');
}

if(!ENVIRONMENT)
{
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', '');
define('DB_NAME', 'hum61');
}

?>