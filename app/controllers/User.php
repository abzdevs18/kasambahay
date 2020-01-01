<?php
/**
 * Pages
 */
class User extends Controller
{
	private $salt = SECURE_SALT;
	
	function __construct()
	{

		$this->userModel = $this->model('UserModel');
		$this->adminModel = $this->model('AdminControl');
	}

	public function index(){
		if (isLoggedIn() && $_SESSION['is_admin'] == 1) {
			redirect("Admin");
		}else if(isLoggedIn() && $_SESSION['user_type'] == 2){		
			$approve = $this->adminModel->getUsersSession($_SESSION['uId']);
			$account = $this->adminModel->getAccount($_SESSION['uId']);
			$userAccount = $this->adminModel->getUsersId($_SESSION['uId']);
			$data = [
				'title' => 'Admin',
				'worker' => $approve,
				'account' => $account,
				'data' => $userAccount
			];
			$this->view("user/index", $data);
		}else {
			redirect("Pages/login");
		}

	}
	

	public function appendheader(){
		$head = $this->adminModel->latestMsgUser(trim($_POST['id']));
		$data = [
			"header" => $head
		];
		$this->view("user/appendHeader", $data);

	}
	
	public function messenger(){
		$worker = trim($_POST['id']);
		$listMsgUser = $this->adminModel->getUserMsg($_SESSION['uId']);
		$iL = $this->adminModel->getLatestSender($_SESSION['uId']);
		if($iL){
			$head = $this->adminModel->latestMsgUser($worker);
			$latest = $this->adminModel->getLatestMessages($_SESSION['uId'],$worker);
			$data = [
				"users" => $listMsgUser,
				"latestM" => $latest,
				"header" => $head,
				"usr" => $worker
			];
		}else{
			$data = [

			];
		}
		$this->view("user/messenger", $data);

    }

	public function chat(){
		$listMsgUser = $this->adminModel->getMessagesForCurrentUser($_SESSION['uId']);
		
		// $listMsgUser = $this->adminModel->getUserMsg($_SESSION['uId']);
		$iL = $this->adminModel->getLatestSender($_SESSION['uId']);
		if($iL){
			$head = $this->adminModel->latestMsgUser($iL[0]->rId);
			$latest = $this->adminModel->getLatestMessages($_SESSION['uId'],$iL[0]->rId);
			$data = [
				"users" => $listMsgUser,
				"latestM" => $latest,
				"header" => $head,
				"usr" => $iL[0]->rId
			];
		}else{
			$data = [

			];
		}
		$this->view("user/chat", $data);

    }

	public function append(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$user = $this->adminModel->getAppendUser(trim($_POST['id']));


			$data = [
				'title' => 'Admin',
				'user' => $user
			];
			$this->view("user/appendUser", $data);
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
				"sender" => trim($_POST['sessionId']),
				"receiver" => trim($_POST['clientId']),
				"message" => trim($_POST['msgContent']),
				"sendDate" => $date,
				"sendTime" => $time
			];
			if($this->adminModel->sendMessage($data)){
				$data["status"] = 1;
				echo json_encode($data);
			}
		}
	}

	public function signin(){
		$emptyObject = (object) array();

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$pas = SECURE_SALT . trim($_POST['uPassword']);
			$data = [
				//user user type later to add certain data if a user is employeer
				"status" => "",
				"uNameEmail" => trim($_POST['uNameEmail']),
				"uPassword" => trim($_POST['uPassword']),
				"uNameEmail_err" => "",
				"uPassword_err" => ""
			];

			if (empty($data['uNameEmail_err']) && empty($data['uPassword_err'])) {
				$data['uPassword'] = $pas;

				$loggedIn = $this->adminModel->login($data['uNameEmail'], $data['uPassword']);
				if ($loggedIn) {
					$data['status'] = 1;
					$this->createUserSession($loggedIn);
					// var_dump($loggedIn);
					$arr = [
						"data" => $data,
						"row" => $loggedIn
					];
						// $arr = array('status' => 1);
					echo json_encode($arr);
				}else{
					$data['status'] = 2;

					$arr = [
						"data" => $data,
						"row" => $emptyObject
					];
					
					echo json_encode($arr);
				}

			} else {
				$data['status'] = 0;
				$arr = [
					"data" => $data,
					"row" => $emptyObject
				];
				echo json_encode($arr);
			}

		} else {
			$data = [
				"status" => "",
				"userName_err" => "",
				"password_err" => "",
				"cpassword_err" => ""
			];
			$this->view("users/signin", $data);
		}
	}

	// public function login(){
	// 	if (isLoggedIn() && $_SESSION['is_admin'] == 1) {
	// 		$this->view('admin/index');
	// 	}else if(isLoggedIn() && $_SESSION['user_type'] == 1){
	// 		redirect("dashboard/index");
	// 	}else{
	// 	$this->view('admin/login');
	// 	}
	// }

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
		unset($_SESSION['is_admin']);
		session_destroy();

		redirect('/');
	}

	public function home(){
		$approve = $this->adminModel->getUsersSession($_SESSION['uId']);
		$data = [
			'title' => 'Admin',
			'worker' => $approve
		];
		$this->view("user/home", $data);

    }

	public function preview(){
		if(isLoggedIn()){
			$user = $this->adminModel->getUsersId(trim($_POST['id']));
	
			$data = [
				'title' => 'Admin',
				'info' => $user
			];
			$this->view("user/profile", $data);
		}else{
			echo "log";
		}
    }
}