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
        $sql = "SELECT restaurant_image, restaurant_image_type FROM restaurant WHERE restaurant_id=$id";

        /*** prepare the sql ***/
        $stmt = $dbh->prepare($sql);

        /*** exceute the query ***/
        $stmt->execute(); 

        /*** set the fetch mode to associative array ***/
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        /*** set the header for the image ***/
        $array = $stmt->fetch();

        
            /*** set the headers and display the image ***/
            header("Content-type: ".$array['restaurant_image_type']);

            /*** output the image ***/
            echo $array['restaurant_image'];
            
            
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