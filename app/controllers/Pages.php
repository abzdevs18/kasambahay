<?php
/**
 * Pages
 */
class Pages extends Controller
{
	
	function __construct()
	{
		$this->adminModel = $this->model('AdminControl');
	}

	public function index(){
		if (isLoggedIn() && $_SESSION['is_admin'] == 1) {
			redirect("Admin");
		}else if(isLoggedIn() && $_SESSION['user_type'] == 2){
			redirect("User");
		}else {
			
			$approve = $this->adminModel->getUsers();
			$data = [
				'title' => 'Welcome',
				'worker' => $approve
				// 'posts' => $posts
			];
			$this->view("Pages/index", $data);
		}
	}

	public function about(){
		$data = [
			'title' => 'Welcome to about'
		];
		$this->view("pages/about", $data);
	}

	public function signup(){
		$data = [
			'title' => 'Welcome to about'
		];
		$this->view("pages/signup", $data);
	}

	public function login(){
		$data = [
			'title' => 'Welcome to about'
		];
		$this->view("pages/login", $data);
	}

	public function previewProf(){
		$data = [
			'title' => 'Welcome to about'
		];
		$this->view("pages/preview_profile", $data);
	}
}