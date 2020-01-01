<?php

/**
 * Base controller
 * Load the models and views
 */
class Controller
{
	
	public function model($model) {
		require_once '../app/models/' . $model . '.php';

		return new $model();
	}

	public function view($view, $data = ["title" => "welcome"]) {
		if (file_exists('../app/views/' . $view . '.php')) {
			require_once '../app/views/' . $view . '.php';
		} else {
			die('Seems doesnt exists');
		}
	}
}