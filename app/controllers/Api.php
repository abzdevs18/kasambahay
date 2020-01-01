<?php
/**
 * Pages
 */
class Api extends Controller
{
	private $salt = SECURE_SALT;
	
	function __construct()
	{

		$this->mobile = $this->model('Mobile');
		$this->userModel = $this->model('UserModel');	

		$this->adminModel = $this->model('AdminControl');
	}
	public function index(){
		echo "J";
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

	public function login(){
		$emptyObject = (object) array();

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$pas = SECURE_SALT . trim($_POST['password']);
			$response = array();
			$data = [
				//user user type later to add certain data if a user is employeer
				"success_login" => "",
				"p_k" => "",
				"uNameEmail" => trim($_POST['email']),
				"uPassword" => trim($_POST['password']),
				"uNameEmail_err" => "",
				"uPassword_err" => ""
			];

			if (empty($data['uNameEmail_err']) && empty($data['uPassword_err'])) {
				$data['uPassword'] = $pas;

				$loggedIn = $this->adminModel->login($data['uNameEmail'], $data['uPassword']);
				if ($loggedIn) {
					array_push($response, array("success_login"=>1,"email"=>$loggedIn->usrEmail,"p_k"=>$loggedIn->fId));
					// $data['success_login'] = 1;
					// $data['p_k'] = $loggedIn->fId;

					echo json_encode($response);
				}else{
					array_push($response, array("success_login"=>0));
					// $data['success_login'] = 2;
					// echo json_encode($data);

					echo json_encode($response);
				}

			} else {
				array_push($response, array("success_login"=>0));
				// $data['success_login'] = 2;
				// echo json_encode($data);

				echo json_encode($response);
			}

		}
    }

	public function accountDetails(){

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$response = array();

			$data = [
				"status" => "",
				"userId" => trim($_POST['p_k'])
			];
			$account = $this->mobile->accountDetails($data);
			array_push($response,array("p_k"=>$account[0]->p_k,"username"=>$account[0]->username,"lastname"=>$account[0]->lastname,"email"=>$account[0]->email,"image"=>$account[0]->image));
			echo json_encode($response);
		}
    }

	public function messages(){

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$messages = $this->mobile->getMessagesForCurrentUser(trim($_POST['userId']));

			echo json_encode($messages);
		}
    }

	public function getCurrentUserMessages(){

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$latest = $this->adminModel->getLatestMessages(trim($_POST['reciever']),trim($_POST['sender']));

			echo json_encode($latest);
		}
    }

	public function getAcount()
	{
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$userAccount = $this->adminModel->getUsersId(trim($_POST['userId']));

			echo json_encode($userAccount);
		}
	}

	public function setMessage()
	{
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		

			//timezone is set to manila
			date_default_timezone_set('Asia/Manila');
  			// echo date("h:i a");
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			// $time = date("D, M d, g:i A");
			$date = date("M. d, Y");
			$time = date("h:i a");

			$data = [
				"status" => "",
				"sender" => trim($_POST['sender']),
				"receiver" => trim($_POST['receiver']),
				"message" => trim($_POST['message']),
				"sendDate" => $date,
				"sendTime" => $time
			];
			if($this->adminModel->sendMessage($data)){
				$data["status"] = 1;
				echo json_encode($data);
			}
		}
	}
}