<?php
/**
 * Pages
 */
class Admin extends Controller
{
	
	function __construct()
	{

		$this->adminModel = $this->model('AdminControl');
	}

	public function index(){
		if (isLoggedIn() && $_SESSION['is_admin'] == 1) {
			$pendingUser = $this->adminModel->getPendingApplication();
			$users = $this->adminModel->adminUserNum();
	
			$data = [
				'title' => 'Admin',
				'user' => $pendingUser,
				'userCount' => $users
			];
			$this->view("admin/index", $data);
		}else if(isLoggedIn() && $_SESSION['user_type'] == 2){
			redirect("User");
		}else {
			redirect('Pages/login');
		}
    }

	public function user(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$application = $this->adminModel->getUserPendingApplication(trim($_POST['id']));

			$data = [
				'user' => $application,
				'id' => trim($_POST['id'])
			];
			$this->view("admin/user", $data);
		}

    }

	public function approve(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$approve = $this->adminModel->approveApplication(trim($_POST['id']));
			$data = [
				"status" => 0
			];
			if($approve){
				$data['status'] = 1;
				echo json_encode($data);
			}
		}

    }

	public function tables(){
		$list = $this->adminModel->getUsers();

		$data = [
			'title' => 'Admin',
			'user' => $list,
		];
		$this->view("admin/tables", $data);

    }

	public function setMessage()
	{
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		

			//timezone is set to manila
			date_default_timezone_set('Asia/Manila');
  			// echo date("h:i a");
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$time = date("D, M d, h:i A");
			$date = date("M. d, Y");
			// $time = date("h:i a");

			$data = [
				"status" => "",
				"sender" => trim($_POST['sessionId']),
				"receiver" => trim($_POST['clientId']),
				"message" => trim($_POST['msgContent']),
				"sendDate" => $time,
				"sendTime" => $time
			];
			if($this->adminModel->sendMessage($data)){
				$data["status"] = 1;
				echo json_encode($data);
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