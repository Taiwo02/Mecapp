<?php 
include_once "handler.php";
if(isset($_POST['submit'])){
	$object=new main();
	$obj=$_POST["email"];
	$pass=$_POST["password"];
	$pass=md5($_POST["password"]);
	$list=$object->login($obj,$pass);
	 echo "$list";
}
 ?>