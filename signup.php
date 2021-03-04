<?php 
require_once('handler.php');

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$password=$_POST['Password'];
$phone=$_POST['phone'];
$image=$_FILES['image']['tmp_name'];
$size=$_FILES['image']['size'];
$type = strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION));
$target_dir ='uploads/';
$image_name = $_FILES['image']['name'];
$target_file = $target_dir .$fname . '.' . $type;
$object=new main;
if(move_uploaded_file($image, $target_file) && $fname!="" && $lname!="" && $password!="" && $email!="" && $phone!="" && $target_file!=""){
    $object->signup($fname,$lname,$email,$password,$phone,$target_file);
}
 ?>