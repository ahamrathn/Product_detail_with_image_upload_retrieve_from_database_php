<?php

include('config.php');

$user_name=$_POST['user_name'];
$pass_word=$_POST['pass_word'];

$result=mysqli_query($con, "select password from login where username ='$user_name'");

$row=mysqli_fetch_array($result);

$data=$row[0];

if($data==$pass_word)
{
	header('location:welcome.php');
}
else {
	header('location:index.php');
}


?>