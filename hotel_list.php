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
	
$sql="SELECT hotel_id, hotel_name, hotel_address, hotel_location, hotel_image_type,hotel_image_url, hotel_rating from hotel ORDER by hotel_id";

$result=mysqli_query($con, $sql);

$rows=array();
while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
{
	
	$rows[]=$row;
	
}



mysqli_close($con);

echo json_encode($rows);

?>