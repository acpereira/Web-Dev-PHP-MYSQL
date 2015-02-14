<?php
ini_set('display_errors', 'On');
require('connect.php');

if(isset($_POST['indexKey'])){
    $id = $_POST['indexKey'];  
    $query = "DELETE FROM Videos WHERE id=$id"; 
    $result = $mysqli->query($query);

}

if(isset($_POST['rent'])){
    $id = $_POST['rent'];  
    $query = "SELECT rented FROM Videos WHERE id=$id;"; 
    $result = $mysqli->query($query);
    $status = $result->fetch_assoc();
    //echo $status['rented'];
    if($status['rented']==0) {
    	$query = "UPDATE Videos SET rented = 1 WHERE id = $id"; 
    	$result = $mysqli->query($query);
    }
    else {
    	$query = "UPDATE Videos SET rented = 0 WHERE id = $id"; 
    	$result = $mysqli->query($query);
    }


}

if(isset($_POST['Clear'])){ 
    $query = "DELETE FROM Videos"; 
    $result = $mysqli->query($query);

}

header('Location:http://web.engr.oregonstate.edu/~pereiraa/store.php');

?>