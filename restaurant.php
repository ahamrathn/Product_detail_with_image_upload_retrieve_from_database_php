<?php
if(count($_FILES) > 0) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
	
	
include 'config.php';


$imgData = fopen($_FILES['userImage']['tmp_name'],'rb');

$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);

$restaurant_name=$_POST['restaurant_name'];

$restaurant_food_item=$_POST['restaurant_food_item'];
$restaurant_city=$_POST['restaurant_city'];
$restaurant_address=$_POST['restaurant_address'];
$restaurant_rating=$_POST['restaurant_rating'];
$restaurant_location=$_POST['restaurant_location'];

$type=$imageProperties['mime'];

try {
	
  $dbh = new PDO("mysql:host=localhost;dbname=joker", 'root', '');
  
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
 
  
$query=$dbh->prepare("INSERT INTO restaurant ( restaurant_image_type, restaurant_image , restaurant_name, restaurant_food_item , restaurant_city, restaurant_address , restaurant_rating, restaurant_location) VALUES(?,?,?,?,?,?,?,?)");

$query->bindParam(1,$type);
$query->bindParam(2,$imgData,PDO::PARAM_LOB);
$query->bindParam(3,$restaurant_name);
$query->bindParam(4,$restaurant_food_item);
$query->bindParam(5,$restaurant_city);
$query->bindParam(6,$restaurant_address);
$query->bindParam(7,$restaurant_rating);
$query->bindParam(8,$restaurant_location);

$query->execute();

}
catch(Exception $e)
{
	echo $e->getMessage();
}
}}
?>
<HTML>
<head>
	<title>Joker Admin</title>

	<style type="text/css">
	
	.category
	{
	
	padding:10px;
	border:3px solid grey;
	text-decoration:none;
	
	}
	.details
	{
	border:3px solid gold;
	padding:10px;
	
	}
	
	.thumb
	{
	float:left;
	width:10%;
	height:200px;
	margin:10px;
	border-radius:4px;
	padding:5px;
	border:2px solid grey; 
		
	
	}
	
	</style>
	
</head>
<BODY>

<div class="category" >
	
	<a href="hotel.php" target="_blank">Hotel</a>
	<a href="restaurant.php" targer="_blank">Restaurant</a>
	<a href="tourism.php" target="_blank">Tourism</a>
	</div>
<div class="details" align="center">

<form name="frmImage" enctype="multipart/form-data" action="" method="post" class="frmImageUpload">

	<table>
			<tr><td>	<label>Add Hotel dETAILS</label><br/>
			</td><td></td>
			</tr>
			<tr> <td> image </td><td> <input name="userImage" type="file" class="inputFile" /></td></tr>
			<tr><td> restaurant Name</td><td><input type="text" name="restaurant_name" /></td></tr>
			<tr><td>restaurant Facility</td><td><input type="text" name="restaurant_food_item" /></td></tr>
			<tr><td>restaurant City </td><td><input type="text" name="restaurant_city" /></td></tr>
			<tr><td>restaurant address</td><td><input type="textarea" cols="40" rows="5" name="restaurant_address" /></td></tr>
			<tr><td>restaurant rating</td><td><input type="text" name="restaurant_rating" /></td></tr>
			<tr><td>restaurant location</td><td><input type="text" name="restaurant_location" /></td></tr>
<tr><td></td><td>			
<input type="submit" value="Submit" class="btnSubmit" />
</td></tr>
</table>
</form>
</div>

<div>
<?php 



try    {

	/*** connect to the database ***/

	$dbh = new PDO("mysql:host=localhost;dbname=joker", 'root', '');


	/*** set the PDO error mode to exception ***/
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	/*** The sql statement ***/
	 


	$sql ="SELECT restaurant_id, restaurant_image, restaurant_name, restaurant_food_item , restaurant_city, restaurant_address, restaurant_rating , restaurant_location , restaurant_image_type FROM restaurant ";
	 
	/*** prepare the sql ***/
	$stmt = $dbh->prepare($sql);

	/*** exceute the query ***/
	$stmt->execute();

	/*** set the fetch mode to associative array ***/
	$stmt->setFetchMode(PDO::FETCH_ASSOC);

	/*** set the header for the image ***/
	foreach($stmt->fetchAll() as $array)
	{
		
		echo '<div class="thumb">
            <p><a href="restaurent_spec.php?id='.$array['restaurant_id'].'">
            <img src="restaurant_image.php?id='.$array['restaurant_id'].'" alt="'.$array['restaurant_name'].' /" style="max-width:80%;">

           <p>'.$array['restaurant_name'].'</p></a></p></div>';
	}
}
catch(PDOException $e)
{
	echo "invalid search";


}

?>


</div>


</BODY>
</HTML>