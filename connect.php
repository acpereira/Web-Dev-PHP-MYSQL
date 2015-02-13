<?php
ini_set('display_errors', 'On');
include 'storedInfo.php';



$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pereiraa-db",$myPassword,"pereiraa-db");
if(!$mysqli || $mysqli->connect_errno) {
	echo "Connection error " .$mysqli->connect_errno." ".$mysqli->connect_error;
}
?>