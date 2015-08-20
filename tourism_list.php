<?php

$host="localhost";
$user="root";
$pwd="";
$db="joker";


$con = mysqli_connect($host, $user, $pwd, $db);

if(mysqli_connect_errno($con))
{
	die("Failed to connect to mysql connection".mysqli_connect_error());
}
	
$sql="SELECT tourism_id, tourism_name, tourism_city, tourism_category, tourism_address, tourism_location, tourism_image_type,  tourism_image_url from tourism ORDER by tourism_id";

$result=mysqli_query($con, $sql);

$rows=array();
while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
{
	
	$rows[]=$row;
	
}



mysqli_close($con);

echo json_encode($rows);

?>