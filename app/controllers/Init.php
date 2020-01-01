<?php

define("ROOT", "");
/**
 * 
 */
class Init extends Controller
{
	private $salt = SECURE_SALT;
	
	function __construct(){
		$this->userModel = $this->model('UserModel');	
	}

	public function adminLogin(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			$data = [
				'status'=> '',
				'adminUserName'=>trim($_POST['adminUserName']),
				'adminUserPass'=>trim($_POST['adminUserPass']),
				'adminUserName_err'=>'',
				'adminUserPass_err'=>''
			];


			// adminUserPass validation
			if (empty($data['adminUserPass'])) {
				$data['adminUserPass_err'] = 'Please enter your password';
			}else{
				$data['adminUserPass'] = SECURE_SALT . trim($_POST['adminUserPass']);
			}

			// siteName validation
			if (empty($data['adminUserName'])) {
				$data['adminUserName_err'] = 'Please enter Admin userName';
			}else{
				//First check if email is use to sign in
				if (filter_var($data['adminUserName'], FILTER_VALIDATE_EMAIL)) {
					if ($this->userModel->findUserEmail($data['adminUserName']) == false) {
						// $data['status'] = 0;
						$data['adminUserName_err'] = "Email/username doesn't exist!";
					}
				}else {
					if (!$this->userModel->findUserName($data['adminUserName'])) {
						$data['adminUserName_err'] = "Email/username doesn't exist!";
					}
				}
			}

			if (empty($data['adminUserName_err']) && empty($data['adminUserPass_err'])) {

				$loggedIn = $this->userModel->login($data['adminUserName'], $data['adminUserPass']);
				
				if ($loggedIn) {
					$data['status'] = 1;
					$this->createUserSession($loggedIn);
					// var_dump($loggedIn);
					$arr = [
						"data" => $data,
						"row" => $loggedIn
					];
					echo json_encode($arr);
				}else{
					$data['status'] = 2;

					$arr = [
						"data" => $data,
						"row" => ""
					];
					
					echo json_encode($arr);
				}

			} else {
				$data['status'] = 0;
				$arr = [
					"data" => $data,
					"row" => ""
				];
				echo json_encode($arr);
			}
		}	
	}

	public function createUserSession($user) {
		
		$_SESSION['uId'] = $user->usr_id;
		$_SESSION['userName'] = $user->usrName;
		$_SESSION['email'] = $user->usrEmail;
		$_SESSION['user_type'] = $user->uType;
		$_SESSION['is_admin'] = $user->is_admin;
	}

	public function signout() {
		unset($_SESSION['uId']);
		unset($_SESSION['userName']);
		unset($_SESSION['email']);
		unset($_SESSION['user_type']);
		session_destroy();

		redirect('users/signin');
	}

}