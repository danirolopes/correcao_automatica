<?php

class Main_Controller
{
	
	function __construct()
	{
	}

	public function handleRequest()
	{
		$this->urlDismember();

		$this->handleUrl();	
	}

	function urlDismember()
	{
		if (!(isset($_GET['url'])))
		{
			$this->url[0] = 'index';
		}
		else
		{
			$this->url = $_GET['url'];
			$this->url = rtrim($this->url, '/');
			$this->url = explode('/', $this->url);
		}
	}

	function handleUrl()
	{
		$file =  'controllers/'.$this->url[0].'.php';
		if (!file_exists($file))
		{
			$this->error();
		}
		else
		{
			require_once $file;
			$controller = new $this->url[0];
			$controller->loadModel($this->url[0]);

			// calling methods
			if (isset($this->url[2])) {
				if (method_exists($controller, $this->url[1])) {
					$controller->{$this->url[1]}($this->url[2]);
				} else {
					$this->error();
				}
			}
			else 
			{
				if (isset($this->url[1])) 
				{
					if (method_exists($controller, $this->url[1])) 
					{
						$controller->{$this->url[1]}();
					}
					else 
					{
					$this->error();
					}
				}
				else 
				{
				$controller->index();
				}
			}
		}
	}

	function error()
	{
		require_once 'controllers/error.php';
		$controller = new Error();
		$controller->index();
		return false;
	}

}

?>