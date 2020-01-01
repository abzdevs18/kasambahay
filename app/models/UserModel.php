<?php

/**
 * 
 */
class UserModel
{
	private $db;
	
	public function __construct()
	{
		$this->db = Database::getInstance();
	}

	public function signup($data){
		/*We begin using transaction  because out note is dependent to the chemical. We do not want our note to be submitted to the DB if we fail to store the Chemical itself*/
		try {
            $this->db->beginTransaction();
            
            $this->db->query("INSERT INTO `user`(`username`, `firstname`, `lastname`, `age`, `gender`, `bio`, `work_cat`, `user_pass`, `user_type`) VALUES (:uName, :fName, :lName, :age, :gender, :bio, :work_cat, :user_pass, :user_type)");
            $this->db->bind(":uName",$data['username']);
            $this->db->bind(":fName",$data['firstN']);
            $this->db->bind(":lName",$data['lastN']);
            $this->db->bind(":age",$data['age']);
            $this->db->bind(":gender",$data['gender']);
            $this->db->bind(":bio",$data['bio']);
            $this->db->bind(":work_cat",$data['work_offer']);
            $this->db->bind(":user_pass",$data['password']);
            $this->db->bind(":user_type",$data['user_type']);

            $this->db->execute();

            $userId = $this->db->lastInsert();
            
            // User Email
            $this->db->query("INSERT INTO `user_email`( `user_id`, `email`, `status`) VALUES (:userId, :email, 1)");
            $this->db->bind(":userId",$userId);
            $this->db->bind(":email",$data['emailAdd']);

            $this->db->execute();

            // User Location
            $this->db->query("INSERT INTO `user_location`(`user_id`, `address`, `city`, `zip`) VALUES (:userId, :userAdd, :city, :zip)");
            $this->db->bind(":userId",$userId);
            $this->db->bind(":userAdd",$data['address']);
            $this->db->bind(":city",$data['city']);
            $this->db->bind(":zip",$data['zipCode']);

            $this->db->execute();

            // User Contact Number
            $this->db->query("INSERT INTO `user_phone`( `user_id`, `phone_number`) VALUES (:userId, :phone_number)");
            $this->db->bind(":userId",$userId);
            $this->db->bind(":phone_number",$data['phoneNum']);

            $this->db->execute();

            if($data['work_offer'] != "Home Owner"){
                // Add User to Pending Application
                $this->db->query("INSERT INTO `pending_application`( `user_id`) VALUES (:userId)");
                $this->db->bind(":userId",$userId);
    
                $this->db->execute();
            }

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
	}

	public function login($email, $password) {
		$this->db->query("SELECT user_email.user_id AS fId, user_email.email AS usrEmail, user.id AS usr_id, user.user_pass AS usrPass, user.is_admin AS is_admin, user.username AS usrName, user.user_type AS uType FROM user_email LEFT JOIN user ON user.id = user_email.user_id WHERE user.username = :email OR user_email.email = :email");

			$this->db->bind(':email', $email);
			$row = $this->db->single();


		// if ($row->id == $user_id->user_id) {
			$hashed_pass = $row->usrPass;
			if (password_verify($password,$row->usrPass)) {
				return $row;
				// return true;

			}else{
				return false;
			}
		// }

	}

	public function update($data){
		/*We begin using transaction  because out note is dependent to the chemical. We do not want our note to be submitted to the DB if we fail to store the Chemical itself*/
		try {
            $this->db->beginTransaction();
            
            $this->db->query("UPDATE `user` SET `firstname`= :fName, `lastname`=:lName WHERE user.id = :uId");
            $this->db->bind(":fName",$data['firstN']);
            $this->db->bind(":lName",$data['lastN']);
            $this->db->bind(":uId",$data['id']);

            $this->db->execute();

            // User Email
            
            $this->db->query("UPDATE `user_phone` SET `phone_number`= :phoneNum WHERE `user_id` = :uId");
            $this->db->bind(":phoneNum",$data['phoneNum']);
            $this->db->bind(":uId",$data['id']);
            $this->db->execute();

            // User Location
            $this->db->query("UPDATE `user_location` SET `address`= :userAdd, `city`= :city WHERE `user_id` = :uId");
            $this->db->bind(":uId",$data['id']);
            $this->db->bind(":userAdd",$data['address']);
            $this->db->bind(":city",$data['city']);

            $this->db->execute();

            // User Contact Number
            if($data['profImage']){
                $this->db->query("UPDATE `user_profile` SET `profile_status`= 0 WHERE `user_id` = :uId");
                $this->db->bind(":uId",$data['id']);
    
                $this->db->execute();
    
                $this->db->query("INSERT INTO `user_profile`( `user_id`, `img_path`, `profile_status`) VALUES (:userId, :img_path, 1)");
                $this->db->bind(":userId",$data['id']);
                $this->db->bind(":img_path",$data['profImage']);
    
                $this->db->execute();
            }

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
	}

	public function findUserEmail($email){
		$this->db->query("SELECT * FROM user_email WHERE email = :email_add");
		$this->db->bind(':email_add', $email);

		$row = $this->db->single();

		if ($this->db->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function findUserName($userName){
		$this->db->query("SELECT * FROM user WHERE username = :userName");
		$this->db->bind(':userName', $userName);

		$row = $this->db->single();

		if ($this->db->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}
}