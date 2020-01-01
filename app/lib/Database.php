<?php

/**
 * PDO DB class
 */

class Database
{
	private static $_instance = null;
	private static $_error = null;
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $db_name = DB_NAME;

	private $dbh;
	private $stmt;

	public function __construct(){
		//set DSN
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

		$options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);

		try {
			// echo "string";
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
		} catch (PDOException $e) {
			self::$_error = $e->getMessage();
		}
	}

	public static function conError(){
		if (self::$_error || empty(DB_HOST)) {
			return true;
		}else{
			return false;
		}
	}
	//dont know the right term, but i Think this is what they called singleton where we only get single instance in communication the DB :-)

	public static function getInstance(){
		if (!isset(self::$_instance)) {
			self::$_instance = new Database();
		}
		return self::$_instance;
	}

	public function query($sql) {
		$this->stmt = $this->dbh->prepare($sql);
	}

	public function bind($param, $value, $type = null ){
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;

				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}

		$this->stmt->bindValue($param, $value, $type);
	}

	//Execute the prepared statement
	public function execute(){
		return $this->stmt->execute();
	}

	//Get result set as array of objects
	public function resultSet(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}

	//Get single record as object
	public function single(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_OBJ);
	}

	//Get row count
	public function rowCount(){
		return $this->stmt->rowCount();
	}

	//Get the last inserted ID in table row
	public function lastInsert(){
		return $this->dbh->lastInsertId();
	}
	
	public function beginTransaction(){
		return $this->dbh->beginTransaction();
	}
	
	public function commit(){
		return $this->dbh->commit();
	}
	
	public function rollBack(){
		return $this->dbh->rollBack();
	}
	
}