<?php

/**
 * App core class
 * @desc creates url & loads core controller				
 */

class Core
{	
	protected $currentController = 'Pages';
	protected $currentMethod = 'index';
	protected $params = [];


	
	function __construct()
	{
		/* Store value from getUrl method into $url variable */
		$url = $this->getUrl();

		/*
		* What the array means is: index[0] = function, index[1] = method, index[2] and so on = id
		*/
		if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {

			$this->currentController = ucwords($url[0]);
			unset($url[0]);

		}

		require_once '../app/controllers/' . $this->currentController . '.php';

		$this->currentController = new $this->currentController;

		if (isset($url[1])) {
			if (method_exists($this->currentController, $url[1])) {
				$this->currentMethod = $url[1];

				unset($url[1]);
			}
		}
		// get params
		$this->params = $url ? array_values($url) : [];

		//call a callback with array of params
		call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
	}

	/**
	* what this function does if get the variable pass in our url
	*/

	public function getUrl(){
		if (isset($_GET['url'])) {
			/* with the word trim, it means removing whitespace (or other characters) from the end of a string*/
			$url = rtrim($_GET['url'], '/');
			/* remove any character that a url should not have */
			$url = filter_var($url, FILTER_SANITIZE_URL); 
			/* code below just creating an array out from the url using the the back slash / as delimiter */
			$url = explode('/', $url);

			return $url;
		}
	}
}