<?php

error_reporting(-1);
ini_set('display_errors', 'On');

if(!isset($_SESSION))
{
    session_start();
}


class User
{

	function __construct($conn)
	{
		$this->conn = $conn;
		$this->error = "";
		// $this->users = $this->conn->users;
		// $this->login_details = $this->conn->login_details;
	}

  private function findUser($email, $password)
  {
    $users = array(
      array("name" => "Harshit Kudeshiya",
        "email" => "kudeshiyah@gmail.com",
        "phone" => "9509415782",
        "address" => "abcd",
        "password" => "1234567",
        "type" => "super admin",
        "city" => "all"
      ),
      array("name" => "Ashu Singh",
        "email" => "ashusingh@gmail.com",
        "phone" => "9509415782",
        "address" => "abcd",
        "password" => "1234567",
        "type" => "city admin",
        "city" => "city2"
      )
    );
    if($email == $users[0]["email"] && $password == $users[0]["password"]){
      return $users[0];
    }
    elseif($email == $users[1]["email"] && $password == $users[1]["password"]){
      return $users[1];
    }
    else {
      return false;
    }
  }

	public function adminLogin($post)
	{
		$email = $post['username'];
		$pass = $post['password'];

		if($this->checkEmail($email)){
      	$arr = array('email' => $email, 'password' => $pass);
			if(	$this->findUser($email, $pass)){
				// getting user details
				$user = $this->findUser($email, $pass);

				// setting login details
				$_SESSION['login'] = true;
				$_SESSION['userType'] = $user['type'];
				$_SESSION['canAccess'] = $user['city'];
				DbConnection::set_city($user['city']);

				// Make sure we have a canary set
				if (!isset($_SESSION['canary'])) {
				    session_regenerate_id(true);
				    $_SESSION['canary'] = [
				        'birth' => time(),
				        'IP' => $_SERVER['REMOTE_ADDR']
				    ];
				}
				if ($_SESSION['canary']['IP'] !== $_SERVER['REMOTE_ADDR']) {
				    session_regenerate_id(true);
				    // Delete everything:
				    foreach (array_keys($_SESSION) as $key) {
				        unset($_SESSION[$key]);
				    }
				    $_SESSION['canary'] = [
				        'birth' => time(),
				        'IP' => $_SERVER['REMOTE_ADDR']
				    ];
				}
				// Regenerate session ID every five minutes:
				if ($_SESSION['canary']['birth'] < time() - 300) {
				    session_regenerate_id(true);
				    $_SESSION['canary']['birth'] = time();
				}

				if ($user['type'] != "super admin") {
					// $login = $this->get_date_time();
					// $login['email'] = $user['email'];
					// $this->login_details->insert($login);
				}

				echo json_encode(array('valid'=>true));
			}
			else{
				echo json_encode(array('valid'=>false, 'error' => 'Email and Password does not match'));
			}
		}
		else{
			echo json_encode(array('valid'=>false, 'error' => $this->error));
		}
	}

	public function get_login_details()
	{
		$documents = [];
  		$cursor = $this->login_details->find();
  		foreach ($cursor as $doc) {
  			array_push($documents, $doc);
  		}
  		echo json_encode($documents);
	}

	public function get_user_details()
	{
		echo json_encode(array("type"=>$_SESSION['userType'], "city"=>DbConnection::get_city()));
	}

	private function get_date_time()
	{
		date_default_timezone_set("Asia/Kolkata");
		$t=time();
		return(
			array(
				'date' => date("d-m-Y",$t),
				'time'=> date("h:i:s a",$t)
				)
			);
	}

	public function logout()
	{
		session_destroy();
	}

  public function signup($name, $email, $phone, $addr, $pass, $repass)
  {
    if( $this->validate($pass, $repass, $email, $phone) )
    {
      $this->users->insert(array(
        'name' =>  htmlspecialchars(trim($name)),
        'email' =>  htmlspecialchars(trim($email)),
        'phone' =>  htmlspecialchars(trim(strval($phone))),
        'address' =>  htmlspecialchars(trim($addr)),
        'password' =>  htmlspecialchars(trim($pass))
        ));
    }
    else{
      echo json_encode(array('error' => $this->error));
    }
  }

	private function validate($pass, $repass, $email, $phone)
	{
		return
			($this->checkPassword($pass, $repass) &&
			$this->checkPhoneNumber(strval($phone)) &&
			$this->checkEmail($email) &&
			$this->emailNotExist($email));
	}

	private function checkPassword($pass, $repass)
	{
		if($pass !== $repass){
			$this->error = "Both Password should be same";
			return false;
		}
		if(strlen($pass) <= 6){
			$this->error = "Password length should be greater then 6";
			return false;
		}

		return true;
	}

	private function checkPhoneNumber($number)
	{
		if (!preg_match('/^\d{10}$/', $number)) {
		 	$this->error = "phone number must be a number and length should be 10.";
		 	return false;
		}
		if ($this->exist(array('phone' => $number))) {
			$this->error = "phone number already exist.";
		 	return false;
		}
		return true;
	}

	private function checkEmail($email)
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $this->error = 'Please enter a valid email.';
		  return false;
		}

		return true;
	}

	private function emailNotExist($email)
	{
		if ($this->exist(array( 'email' => $email))) {
			$this->error = "email already exist.";
		 	return false;
		}

		return true;
	}

	private function exist($a){
		return($this->users->count($a));
  	}
}
?>
