<?php

if(ENVIRONMENT)
{
	define('URL', '');
}

if(!ENVIRONMENT)
{
	define('URL', 'http://127.0.0.1/hum61-1/');
}

	define('INDEX_LINK', URL.'index');
	define('LOGIN_LINK', URL.'login');
	define('TURMA_LINK', URL.'turma');
	define('TAREFA_LINK', URL.'tarefa');
	define('RESPOSTA_LINK', URL.'resposta');
	define('SIGNUP_LINK', URL.'signup');

?>