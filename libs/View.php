<?php

class View
{
	
	function __construct()
	{
	}
	public function render($name, $noInclude = false)
	{
		if($noInclude == true)
		{
			require_once 'views/head.php';
			require_once 'views/'.$name.'.php';
			require_once 'views/footer.php';
		}
		else
		{
			require_once 'views/head.php';
			require_once 'views/header.php';
			require_once 'views/'.$name.'.php';
			require_once 'views/footer.php';
		}
	}

	public function isInRole($role)
    {
    	if($role == PROFESSOR)
    	{
	    	if(Session::get('role') == PROFESSOR)
	    	{
	    		if(Session::get('confirmed') == true)
	    		{
	    			return true;
	    		}
	    		return false;
	    	}
    	}
    	
        if(Session::get('role') == $role)
        {
            return true;
        }
        return false;
    }				
}

?>