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
	
$sql="SELECT restaurant_id, restaurant_name, restaurant_address, restaurant_city, restaurant_food_item, restaurant_location, restaurant_image_type, restaurant_rating , restaurent_image_url from restaurant ORDER by restaurant_id";

$result=mysqli_query($con, $sql);

$rows=array();
while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
{
	
	$rows[]=$row;
	
}



mysqli_close($con);

echo json_encode($rows);

?>