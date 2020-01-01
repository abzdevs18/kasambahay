<?php

/**
 * 
 */
class AdminControl
{
	private $db;
	
	public function __construct()
	{
		$this->db = Database::getInstance();
    }
    
	public function getPendingApplication() {
		$this->db->query("SELECT id, firstname, lastname, work_cat FROM user WHERE EXISTS(SELECT * FROM pending_application WHERE pending_application.user_id = user.id)");
		$row = $this->db->resultSet();
		return $row;
	}
    
	public function emailInfo($id) {
		$this->db->query("SELECT user.username AS username, user.firstname AS firstname, user.lastname AS lastname, user_email.email AS email FROM user LEFT JOIN user_email ON user_email.user_id = user.id WHERE user.id = $id");
        $row = $this->db->resultSet();
		return $row;
	}
    
	public function getUserPendingApplication($id) {
		$this->db->query("SELECT user.id AS user_id, user.*,user_email.*,user_location.*,user_phone.*, user_profile.img_path AS img_path  FROM user LEFT JOIN user_profile ON user_profile.user_id = user.id AND user_profile.profile_status = 1 LEFT JOIN user_email ON user_email.user_id = user.id LEFT JOIN user_location ON user_location.user_id = user.id LEFT JOIN user_phone ON user_phone.user_id = user.id WHERE user.id = $id");
        $row = $this->db->resultSet();
		return $row;
	}
    
	public function getUsers() {

		$this->db->query("SELECT user.id AS user_id, user.*,user_email.*,user_location.*,user_phone.*, user_profile.img_path AS img_path FROM user LEFT JOIN user_profile ON user_profile.user_id = user.id AND user_profile.profile_status = 1 LEFT JOIN user_email ON user_email.user_id = user.id LEFT JOIN user_location ON user_location.user_id = user.id LEFT JOIN user_phone ON user_phone.user_id = user.id WHERE NOT EXISTS (SELECT * FROM pending_application WHERE pending_application.user_id = user.id) AND user.user_type != 3");
        $row = $this->db->resultSet();
		return $row;
	}
    
	public function getUsersSession($id) {

		$this->db->query("SELECT user.id AS user_id, user.*,user_email.*,user_location.*,user_phone.*, user_profile.img_path AS img_path FROM user LEFT JOIN user_profile ON user_profile.user_id = user.id LEFT JOIN user_email ON user_email.user_id = user.id LEFT JOIN user_location ON user_location.user_id = user.id LEFT JOIN user_phone ON user_phone.user_id = user.id WHERE NOT EXISTS (SELECT * FROM pending_application WHERE pending_application.user_id = user.id) AND (user.user_type != 3 AND user.id != $id)");
        $row = $this->db->resultSet();
		return $row;
	}
    
	public function getUsersId($id) {
		$this->db->query("SELECT user.id AS user_id, user.*,user_email.*,user_location.*,user_phone.*, user_profile.img_path AS img_path FROM user LEFT JOIN user_profile ON user_profile.user_id = user.id AND user_profile.profile_status = 1 LEFT JOIN user_email ON user_email.user_id = user.id LEFT JOIN user_location ON user_location.user_id = user.id LEFT JOIN user_phone ON user_phone.user_id = user.id WHERE NOT EXISTS (SELECT * FROM pending_application WHERE pending_application.user_id = user.id) AND user.id = $id");
        $row = $this->db->resultSet();
		return $row;
	}
        
	public function approveApplication($id) {
		$this->db->query("DELETE FROM `pending_application` WHERE user_id = $id");
		if($this->db->execute()){
			return true;
		}
	}

	public function getAppendUser($id)
	{
		$this->db->query("SELECT user.id AS id, user.firstname AS firstname, user.lastname AS lastname, user.user_availability AS visibility, user_profile.img_path AS img_path FROM user LEFT JOIN user_profile ON user_profile.user_id = user.id WHERE user.id = $id");
		$row = $this->db->resultSet();
	   if ($row) {
		   return $row;
	   } else {
		   return false;
	   }
	}

	public function getLatestMessages($receiverId, $senderId){
		$this->db->query("SELECT messages.user_receiver_id AS userId, user.firstname AS firstN, user.lastname AS lastN, messages.user_receiver_id AS receiverId, messages.user_sender_id AS senderId, messages.msg_content as msgContent, messages.msg_date AS msgDate, user_profile.img_path AS sendIconImage FROM messages LEFT JOIN user ON user.id = messages.user_sender_id LEFT JOIN user_profile ON user_profile.user_id = messages.user_sender_id AND user_profile.profile_status = 1 WHERE (messages.user_receiver_id = :userReceiverId AND messages.user_sender_id = :userSenderId) OR (messages.user_receiver_id = :userSenderId AND messages.user_sender_id = :userReceiverId) ORDER BY messages.timestamp DESC");
		$this->db->bind(":userReceiverId", $receiverId);
		$this->db->bind(":userSenderId", $senderId);
		$row = $this->db->resultSet();
	   if ($row) {
		   return $row;
	   } else {
		   return false;
	   }
	}

	/*Best way to show the messages for the current USER*/
	/*Inser Message*/
	public function getMessagesForCurrentUser($userSessionId){
		$this->db->query("SELECT DISTINCT user.username AS name, user.work_cat AS work_cat, user.firstname AS fname, user.lastname AS lname, user_profile.img_path AS img_path, user.id AS id, 
(SELECT messages.msg_date FROM messages WHERE (messages.user_sender_id = user.id AND messages.user_receiver_id = :currentSessionUserId) OR (messages.user_sender_id = :currentSessionUserId AND messages.user_receiver_id = user.id) ORDER BY messages.timestamp DESC LIMIT 1) AS dateM,
(SELECT messages.msg_content FROM messages WHERE (messages.user_sender_id = user.id AND messages.user_receiver_id = :currentSessionUserId) OR (messages.user_sender_id = :currentSessionUserId AND messages.user_receiver_id = user.id) ORDER BY messages.timestamp DESC LIMIT 1) AS latestM
FROM user LEFT JOIN user_profile ON user.id = user_profile.user_id AND user_profile.profile_status = 1 LEFT JOIN messages on (messages.user_receiver_id = :currentSessionUserId AND messages.user_sender_id = user.id) OR (messages.user_receiver_id = user.id AND messages.user_sender_id = :currentSessionUserId) WHERE EXISTS(SELECT * FROM messages WHERE (messages.user_receiver_id = :currentSessionUserId AND messages.user_sender_id = user.id) OR (messages.user_receiver_id = user.id AND messages.user_sender_id = :currentSessionUserId)) ORDER BY latestM DESC");
		$this->db->bind(":currentSessionUserId", $userSessionId);
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}

	public function getLatestSender($id)
	{
		$this->db->query("SELECT messages.user_sender_id AS rId FROM messages WHERE messages.user_sender_id != $id AND messages.user_receiver_id = $id ORDER BY messages.timestamp DESC LIMIT 1");
		$row = $this->db->resultSet();
	   if ($row) {
		   return $row;
	   } else {
		   return false;
	   }
	}
	
	public function getAccount($id){
		$this->db->query("SELECT user.firstname AS firstname, user_profile.img_path AS img_path FROM user LEFT JOIN user_profile ON user_profile.user_id = user.id WHERE user.id = $id");
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}
	
	public function getUserMsg($id){
		$this->db->query("SELECT DISTINCT user.id AS userId,user.firstname AS firstN, user.lastname AS lastN, user.user_availability AS uStatus,(SELECT messages.msg_date FROM messages WHERE messages.user_sender_id = user.id ORDER BY messages.timestamp DESC LIMIT 1) AS dateM,(SELECT messages.msg_content FROM messages WHERE messages.user_sender_id = user.id ORDER BY messages.timestamp DESC LIMIT 1) AS latestM,(SELECT messages.timestamp FROM messages WHERE messages.user_sender_id = user.id ORDER BY messages.timestamp DESC LIMIT 1) AS mStamp, user_profile.img_path AS imagePath FROM messages LEFT JOIN user ON user.id = messages.user_sender_id LEFT JOIN user_profile ON user_profile.user_id = user.id WHERE user.id != 1 AND messages.user_receiver_id = $id ORDER BY messages.timestamp DESC");
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}
	
	public function adminUserNum(){
		$this->db->query("SELECT DISTINCT (SELECT COUNT(id) FROM user WHERE user.is_admin != 1) AS userNum,(SELECT COUNT(id) FROM user WHERE user.user_type = 2 AND NOT EXISTS(SELECT * FROM pending_application WHERE pending_application.user_id = user.id)) AS workerNum,(SELECT COUNT(id) FROM user WHERE user.user_type = 3) AS houseNum,(SELECT COUNT(id) FROM pending_application) AS pendingNum FROM user");
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}


	
	function latestMsgUser($id)
	{
		$this->db->query("SELECT user.id AS userId, user.work_cat AS work_cat, user.firstname AS firstN, user.lastname AS lastN, user_profile.img_path AS imagePath, user.user_availability AS uStatus FROM user LEFT JOIN user_profile ON user_profile.user_id = user.id AND user_profile.profile_status = 1 WHERE user.id = $id");
		$row = $this->db->resultSet();
	   if ($row) {
		   return $row;
	   } else {
		   return false;
	   }
	}

	/*Inser Message*/
	public function sendMessage($data){
		$this->db->query("INSERT INTO `messages`(`user_receiver_id`, `user_sender_id`, `msg_content`,`msg_date`) VALUES (:receiver,:sender,:message, :sendDate)");
		$this->db->bind(":receiver", $data['receiver']);
		$this->db->bind(":sender", $data['sender']);
		$this->db->bind(":message", $data['message']);
		$this->db->bind(":sendDate", $data['sendDate']);

		if ($this->db->execute()) {
			return true;
		}else{
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
				// return array('row' => $row);
				// return true;

			}else{
				return false;
			}
		// }

	}
}