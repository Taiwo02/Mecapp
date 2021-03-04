<?php 
include_once "handler.php";
$location=$_POST["location"];
$category=$_POST["gategory"];
  $object=new main();
  $list=$object->getUsers($location,$category);
  $ye=mysqli_fetch_array($list);
 ?>