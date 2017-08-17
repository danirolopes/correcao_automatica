<?php

/**
* 
*/
abstract class Model
{
	
	function __construct()
	{
		$this->db = new Database();
	}

	protected function redirect($location) {
        header('Location: '.$location);
    }
}

?>