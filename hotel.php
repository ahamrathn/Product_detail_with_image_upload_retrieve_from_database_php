<?php
if(count($_FILES) > 0) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
	
	
include 'config.php';


$imgData = fopen($_FILES['userImage']['tmp_name'],'rb');

$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);

$hotel_name=$_POST['hotel_name'];

$hotel_facility=$_POST['hotel_facility'];
$hotel_city=$_POST['hotel_city'];
$hotel_address=$_POST['hotel_address'];
$hotel_rating=$_POST['hotel_rating'];
$hotel_location=$_POST['hotel_location'];

$type=$imageProperties['mime'];

try {
	
  $dbh = new PDO("mysql:host=localhost;dbname=joker", 'root', '');
  
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
 
  
$query=$dbh->prepare("INSERT INTO hotel ( hotel_image_type, image , hotel_name, hotel_facility , hotel_city, hotel_address , hotel_rating, hotel_location) VALUES(?,?,?,?,?,?,?,?)");

$query->bindParam(1,$type);
$query->bindParam(2,$imgData,PDO::PARAM_LOB);
$query->bindParam(3,$hotel_name);
$query->bindParam(4,$hotel_facility);
$query->bindParam(5,$hotel_city);
$query->bindParam(6,$hotel_address);
$query->bindParam(7,$hotel_rating);
$query->bindParam(8,$hotel_location);

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
			<tr><td> Hotel Name</td><td><input type="text" name="hotel_name" /></td></tr>
			<tr><td>Hotel Facility</td><td><input type="text" name="hotel_facility" /></td></tr>
			<tr><td>Hotel City </td><td><input type="text" name="hotel_city" /></td></tr>
			<tr><td>hotel address</td><td><input type="textarea" cols="40" rows="5" name="hotel_address" /></td></tr>
			<tr><td>Hotel rating</td><td><input type="text" name="hotel_rating" /></td></tr>
			<tr><td>Hotel location</td><td><input type="text" name="hotel_location" /></td></tr>
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
	 


	$sql ="SELECT hotel_id, image, hotel_name, hotel_facility , hotel_city, hotel_address, hotel_rating , hotel_location , hotel_image_type FROM hotel ";
	 
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
            <p><a href="hotel_spec.php?id='.$array['hotel_id'].'">
            <img src="large_image.php?id='.$array['hotel_id'].'" alt="'.$array['hotel_name'].' /" style="max-width:80%;">

           <p>'.$array['hotel_name'].'</p></a></p></div>';
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