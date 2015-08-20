<?php
if(count($_FILES) > 0) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
	
	
include 'config.php';


$imgData = fopen($_FILES['userImage']['tmp_name'],'rb');

$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);

$tourism_name=$_POST['tourism_name'];
$tourism_category=$_POST['tourism_category'];
$tourism_city=$_POST['tourism_city'];
$tourism_address=$_POST['tourism_address'];

$tourism_location=$_POST['tourism_location'];

$type=$imageProperties['mime'];

try {
	
  $dbh = new PDO("mysql:host=localhost;dbname=joker", 'root', '');
  
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
 
  
$query=$dbh->prepare("INSERT INTO tourism ( tourism_image_type, tourism_image , tourism_name, tourism_category, tourism_city, tourism_address ,  tourism_location) VALUES(?,?,?,?,?,?,?)");

$query->bindParam(1,$type);
$query->bindParam(2,$imgData,PDO::PARAM_LOB);
$query->bindParam(3,$tourism_name);
$query->bindParam(4,$tourism_category);
$query->bindParam(5,$tourism_city);
$query->bindParam(6,$tourism_address);

$query->bindParam(7,$tourism_location);

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
	
	<a href="hotel.php" >Hotel</a>
	<a href="restaurant.php" >Restaurant</a>
	<a href="tourism.php" >Tourism</a>
	</div>
<div class="details" align="center">

<form name="frmImage" enctype="multipart/form-data" action="" method="post" class="frmImageUpload">

	<table>
			<tr><td>	<label>Add Hotel dETAILS</label><br/>
			</td><td></td>
			</tr>
			<tr> <td> image </td><td> <input name="userImage" type="file" class="inputFile" /></td></tr>
			<tr><td> tourism Name</td><td><input type="text" name="tourism_name" /></td></tr>
			<tr><td>tourism category</td><td><input type="text" name="tourism_category" /></td></tr>
			<tr><td>tourism City </td><td><input type="text" name="tourism_city" /></td></tr>
			<tr><td>tourism address</td><td><input type="textarea" cols="40" rows="5" name="tourism_address" /></td></tr>
			
			<tr><td>tourism location</td><td><input type="text" name="tourism_location" /></td></tr>
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
	 


	$sql ="SELECT tourism_id, tourism_image, tourism_name, tourism_category , tourism_city, tourism_address, tourism_location , tourism_image_type FROM tourism ";
	 
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
            <p><a href="spec.php?id='.$array['tourism_id'].'">
            <img src="tourism_image.php?id='.$array['tourism_id'].'" alt="'.$array['tourism_name'].' /" style="max-width:80%;">

           <p>'.$array['tourism_name'].'</p></a></p></div>';
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