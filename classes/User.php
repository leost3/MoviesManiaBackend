<?php 
require_once "Database.php";

class User{

	// Self access the class
	// this access the object
	private static $database;
	
	private $User_ID;
	private $First_Name;
	private $Last_Name;
	private $Email;
	private $Username;
	private $Password;
	private $Salt;
	private $Role_ID;
	
	function User($first_Name, $last_Name, $email,
	              $username, $password, $role_ID, $user_ID = NULL)
	{
		$this->First_Name = $first_Name;
		$this->Last_Name  = $last_Name;		
		$this->Email = $email;
		$this->Username = $username;
		$this->Salt = $this->Create_Salt();
		$this->Password = crypt($password, $this->Salt);
		$this->Role_ID = $role_ID;
		$this->User_ID = $user_ID;
	}
	public static function Init_Database(){
		if(!isset(self::$database)){
			self::$database = new Database();
		}
	}
	public function Insert(){
		try{
			self::Init_Database();
			$query = "INSERT INTO users (First_Name, Last_Name, Email, Username, Password, Salt, Role_ID)";
			$query .= " VALUES(?,?,?,?,?,?,?)";
		    $connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->bindParam(1, $this->First_Name);
			$statement->bindParam(2, $this->Last_Name);
			$statement->bindParam(3, $this->Email);
			$statement->bindParam(4, $this->Username);
			$statement->bindParam(5, $this->Password);
			$statement->bindParam(6, $this->Salt);
			$statement->bindParam(7, $this->Role_ID);
			$statement->execute();
			// echo "User inserted ID = ".$connection->lastInsertId();
		}catch(PDOException $e){
			echo "INSERT Query Failed : ".$e->getMessage();
		}	
	}

	public function Create_Salt() {
		$algorithms = array("2a","2x","2y");
		$index = rand(0,2);
		$string = substr(MD5($this->Last_Name),0,22);
		return "$".$algorithms[$index]."$"."05"."$".$string."$";
		//      blowfishalgorithm      number of interations    string of 22 chars
	}

	public static function Email_Exists($email){
		try{
			self::Init_Database();
			$query = "SELECT * FROM users WHERE Email = '$email'";
		
		    $connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();
			
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			//print_r($result);
			if(!empty($result['User_ID'])){
				return true;
			}
			return false;
		}catch(PDOException $e){
			echo "INSERT Query Failed : ".$e->getMessage();
		}	
	}

	public static function Username_Email_Exists($username, $email){
		try{
			self::Init_Database();
			$query = "SELECT * FROM users WHERE Username = '$username' AND Email = '$email'";
		
		    $connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();
			
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			//print_r($result);
		
			
			if(!empty($result['User_ID'])){
				return true;
			}
	
			return false;
			
		}catch(PDOException $e){
			echo "INSERT Query Failed : ".$e->getMessage();
		}	
	}
	public static function Username_Exists($username){
		try{
			self::Init_Database();
			$query = "SELECT COUNT(*) FROM users WHERE Username = '$username'";
		
		    $connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();
			
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			
			if($result['COUNT(*)'] > 0){
				return true;
			}
			return false;
			
		}catch(PDOException $e){
			echo "INSERT Query Failed : ".$e->getMessage();
		}	
	}

	public static function Login($username , $password){
		try{
			self::Init_Database();
			$query = "SELECT * FROM users WHERE Username = '$username'";
		    
		    $connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();
			
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			
			$salt = $result['Salt'];
			$encrypted_password = crypt($password, $salt);

			if($encrypted_password ==  $result["Password"]){// compares salt with password
				// return true;
				return ["isLoggedIn" => true, "username" => $result["Username"], "userId" => $result["User_ID"]];
			}
			return false;
			
		}catch(PDOException $e){
			echo "INSERT Query Failed : ".$e->getMessage();
		}	
	}
	public static function Validate($username){
		try{
			self::Init_Database();
			$query = "SELECT Username FROM users WHERE Username = '$username'";
		    
		    $connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();
			
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			
			if ($result['Username'] == $username) {
				return TRUE;
			}
			return FALSE;
						
		}catch(PDOException $e){
			echo "INSERT Query Failed : ".$e->getMessage();
		}	
	}


	public static function Update_Password($username, $password){
		try {
			$salt = self::Get_Salt($username);
			$encrypted_password = crypt($password, $salt);

			$query = "Update users SET Password = '$encrypted_password' ";
			$query .= "Where Username = '$username' ";
			self::Init_Database();
			$connection = self::$database->Get_Connection();
			$connection->exec($query); //No need to prepare the query - only to get object statement or read data using fetch
		} catch (PDOException $e) {
			echo "Update query Failed: ".$e->getMessage();
		}
	}
	public static function Get_Salt($username){
		try {
			self::Init_Database();
			$query = "SELECT * FROM users WHERE Username = '$username' ";
			// If fetching, you need to prepare the query
			$connection = self::$database->Get_Connection();
			$statement = $connection->prepare($query);
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			return $result['Salt'];
		} catch (PDOException $e) {
			echo "Update query Failed: ".$e->getMessage();
		}
	}
}
?>