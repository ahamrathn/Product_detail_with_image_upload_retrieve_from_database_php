<html>
	<head>
		<title>
		
		Joker Hotel SPecification
		</title>
	</head>
	<body>
		<div align="center" >
		
		
		<?php 
		
		

/*** some basic sanity checks ***/
if(filter_has_var(INPUT_GET, "id") !== false && filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) !== false)
    {
    /*** assign the image id ***/
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    


try    {
        /*** connect to the database ***/
        $dbh = new PDO("mysql:host=localhost;dbname=joker", 'root', '');

        /*** set the PDO error mode to exception ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** The sql statement ***/
        $sql = "SELECT hotel_id, hotel_name, hotel_facility, hotel_city, hotel_address, hotel_rating , hotel_location , image, hotel_image_type FROM hotel WHERE hotel_id=$id";

        /*** prepare the sql ***/
        $stmt = $dbh->prepare($sql);

        /*** exceute the query ***/
        $stmt->execute(); 

        /*** set the fetch mode to associative array ***/
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach($stmt->fetchAll() as $array)
	{
		echo '<div class="thumb" align="center">
         
            <img src="large_image.php?id='.$array['hotel_id'].'" alt="'.$array['hotel_name'].' /" style="max-width:50%;">

           <p>'.$array['hotel_name'].'</p></a></p>
           <p> Facility '.$array['hotel_facility'].' </p>
           <p> City		'.$array['hotel_city'].'</p>
           <p>Hotel Address '.$array['hotel_address'].'</p>
           	<p> hotel rating '.$array['hotel_rating'].'</p>
           <p> Hotel location '.$array['hotel_location'].'</p>
           							 				
            		
            		
            		</div>';
	}
            
        }
    catch(PDOException $e)
        {
        echo $e->getMessage();
        }
    catch(Exception $e)
        {
        echo $e->getMessage();
        }
    }
else
    {
    echo 'Please use a real id number';
    }
?>
		
		</div>
	
	</body>


</html>