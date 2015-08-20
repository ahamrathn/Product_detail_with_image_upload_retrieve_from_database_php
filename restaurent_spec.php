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
        $sql = "SELECT restaurant_id, restaurant_name, restaurant_food_item, restaurant_city, restaurant_address, restaurant_rating , restaurant_location , restaurant_image, restaurant_image_type FROM restaurant WHERE restaurant_id=$id";

        /*** prepare the sql ***/
        $stmt = $dbh->prepare($sql);

        /*** exceute the query ***/
        $stmt->execute(); 

        /*** set the fetch mode to associative array ***/
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach($stmt->fetchAll() as $array)
	{
		echo '<div class="thumb" align="center">
         
            <img src="restaurant_image.php?id='.$array['restaurant_id'].'" alt="'.$array['restaurant_name'].' /" style="max-width:5	0%;">

           <p>'.$array['restaurant_name'].'</p></a></p>
           <p> Food Item '.$array['restaurant_food_item'].' </p>
           <p> City		'.$array['restaurant_city'].'</p>
           <p>restaurant Address '.$array['restaurant_address'].'</p>
           	<p> restaurant rating '.$array['restaurant_rating'].'</p>
           <p> restaurant location '.$array['restaurant_location'].'</p>
           							 				
            		
            		
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