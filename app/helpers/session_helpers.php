<?php

session_start();

function isLoggedIn(){
	if (isset($_SESSION['uId'])) {
		return true;
	}else{
		return false;
	}
}

function isClient(){
	if ($_SESSION['user_type']) {
		return true;
	}else{
		return false;
	}
}

// function flash($message = '', $class = )