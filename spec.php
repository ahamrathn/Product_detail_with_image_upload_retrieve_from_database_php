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
        $sql = "SELECT tourism_id, tourism_name, tourism_category, tourism_city, tourism_address, tourism_location , tourism_image, tourism_image_type FROM tourism WHERE tourism_id=$id";

        /*** prepare the sql ***/
        $stmt = $dbh->prepare($sql);

        /*** exceute the query ***/
        $stmt->execute(); 

        /*** set the fetch mode to associative array ***/
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach($stmt->fetchAll() as $array)
	{
		echo '<div class="thumb" align="center">
         
            <img src="tourism_image.php?id='.$array['tourism_id'].'" alt="'.$array['tourism_name'].' /" style="max-width:5	0%;">

           <p>'.$array['tourism_name'].'</p></a></p>
           <p> Category '.$array['tourism_category'].' </p>
           <p> City		'.$array['tourism_city'].'</p>
           <p>tourism_ Address '.$array['tourism_address'].'</p>
           <p> tourism_ location '.$array['tourism_location'].'</p>
           							 				
            		
            		
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