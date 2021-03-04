<?php 
session_start();
require_once"config.php";
class main{
	private $host=host;
	private $db_name=db_name;
	private $user=user_name;
	private $password=password;
	public $conne;
	public $stmt;

	
	function __construct(){
	    $this->connect();
	}
    private function connect(){
		 $this->conne = new mysqli($this->host,$this->user,$this->password,$this->db_name);
		// echo $this->db_name;
		 if ($this->conne) {
		 	echo "connection successfull";
		 }else{  
		 	echo "connection failed";
		 }
	}
	public function signup($fname,$lname,$email,$password,$phone,$picture){
		$pass=md5($password);
		$this->stmt = $this->conne->prepare("INSERT INTO class_table (FirstName,LastName,Email,password,phoneNo,picture)VALUES (?,?,?,?,?,?)");
		$this->stmt->bind_param("ssssss", $fname,$lname,$email,$pass,$phone,$picture);
		if($this->stmt->execute()){
			echo "done";
		} else {
			echo "failed";
		}
	}
		
	 public function getUsers($locations,$category){
	    $this->stmt=$this->conne->prepare("SELECT * FROM class_table WHERE locations = ? AND category = ?" );
	    if ($this->stmt->execute()) {
              $result=$this->stmt->get_result();
              return $row=$result->fetch_all(MYSQLI_ASSOC);
	    }
	}
	 public function OneUser($email){
	    $this->stmt=$this->conne->prepare("SELECT * FROM class_table where email=?");
	    $this->stmt->bind_param("s",$email);
	    $this->stmt->execute();
	    return  $this->stmt->get_result(); 	    
	    
	}
	public function login($email,$password){
	    $this->stmt=$this->conne->prepare("SELECT * FROM class_table where email=? and password=?");
	    $this->stmt->bind_param("ss",$email,$password);
	    if ($this->stmt->execute()) {
			  $res= $this->stmt->get_result();
			if($res->num_rows==1) {
				$row=$res->fetch_array();
				$_SESSION["succes"] = true;
				$_SESSION["fname"] = $row['FirstName'];
				$_SESSION['lname'] = $row['LastName'];
				$_SESSION['email'] = $row['Email'];
				$_SESSION['picture'] = $row['picture'];
			   	header("location:darshbord1.php");
			}
	        else{
				$_SESSION["invalid"]=true;
				header("location:login 1.php");
	        }
		}
	}
}
 


?>