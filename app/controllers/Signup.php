<?php
/**
 * Pages
 */
class Signup extends Controller
{
	private $salt = SECURE_SALT;
	
	function __construct()
	{

		$this->userModel = $this->model('UserModel');
	}

	public function signup(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$salted_pass = $this->salt . trim($_POST['password']);
			
			$data = [
				//user user type later to add certain data if a user is employeer
				"status" => "",
				"firstN" => trim($_POST['firstN']),
				"lastN" => trim($_POST['lastN']),
				"emailAdd" => trim($_POST['emailAdd']),
				"phoneNum" => trim($_POST['phoneNum']),
				"age" => trim($_POST['age']),
				"gender" => trim($_POST['gender']),
				"address" => trim($_POST['address']),
				"city" => trim($_POST['city']),
				"zipCode" => trim($_POST['zipCode']),
				"work_offer" => trim($_POST['work_offer']),
				"username" => trim($_POST['username']),
				"password" => password_hash($salted_pass, PASSWORD_DEFAULT),
				"user_type" => 2,
				"bio" => trim($_POST['bio'])
			];

			if( trim($_POST['work_offer']) == "Home Owner"){
				$data['user_type'] = 3;
			}

			if($this->userModel->signup($data)){
				$data['status'] = 1;
				echo json_encode($data);
			}else{
				$data['status'] = 0;
				echo json_encode($data);
			}
		}
    }

	public function update(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			$data = [
				//user user type later to add certain data if a user is employeer
				"status" => "",
				'profImage' => "",
				"firstN" => trim($_POST['firstname']),
				"lastN" => trim($_POST['lastname']),
				"phoneNum" => trim($_POST['phone']),
				"address" => trim($_POST['address']),
				"id" => trim($_POST['id']),
				"city" => trim($_POST['city']),
			];
			if($_FILES['profilePhoto']['name']){
				$data["profImage"] = $_FILES['profilePhoto']['name'];
			}

			if(empty($data['profImage'])){
				if($this->userModel->update($data)){
					$data['status'] = 1;
					echo json_encode($data);
				}else{
					$data['status'] = 0;
					echo json_encode($data);
				}
			}else{
				$target = $_SERVER['DOCUMENT_ROOT'] . "public/img/profile/" . basename($_FILES['profilePhoto']['name']);
				if (move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $target)) {
					if($this->userModel->update($data)){
						$data['status'] = 1;
						echo json_encode($data);
					}else{
						$data['status'] = 0;
						echo json_encode($data);
					}
				}
			}
		}
    }
}