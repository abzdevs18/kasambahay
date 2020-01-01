<?php

/**
 * 
 */
class Mobile
{
	private $db;
	
	public function __construct()
	{
		$this->db = new Database;
	}

	public function accountDetails($data){    
        $this->db->query("SELECT user.id AS p_k, user.username AS username, user.work_cat AS work_cat, user.lastname AS lastname, user_email.email AS email, user_profile.img_path AS image FROM user LEFT JOIN user_email ON user_email.user_id = user.id LEFT JOIN user_profile ON user_profile.user_id = user.id AND user_profile.profile_status = 1 WHERE user.id = :userId ");
		$this->db->bind(":userId",$data['userId']);
		$row = $this->db->resultSet();
        return $row;
	}

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

	// public function accountDsetails($p_k){    
    //     $this->db->query("SELECT user.id AS p_k, user.username AS username, user.lastname AS lastname, user_email.email AS email, user_profile.img_path AS image FROM user LEFT JOIN user_email ON user_email.user_id = user.id LEFT JOIN user_profile ON user_profile.user_id = user.id AND user_profile.profile_status = 1 WHERE user.id = '$p_k'");
    //     $row = $this->db->resultSet();
    //     return $row;
	// }
}