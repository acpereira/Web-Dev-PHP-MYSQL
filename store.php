<html>
<head>
	<title>Video Store</title>
</head>
<body>

<?php
ini_set('display_errors', 'On');
include 'storedInfo.php';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pereiraa-db",$myPassword,"pereiraa-db");
if(!$mysqli || $mysqli->connect_errno) {
	echo "Connection error " .$mysqli->connect_errno." ".$mysqli->connect_error;
}


$video = $_POST['videoName'];
$cat = $_POST['videoCat'];
$len = $_POST['videoLength'];

if(!get_magic_quotes_gpc()) {
	$video = addslashes($video);
	$cat = addslashes($cat);
	$len = addslashes($len);
}
//echo $video;
//echo $cat;
//echo $len;

if(isset($_POST['videoName'])&&!empty($_POST['videoName'])){
	if(!$mysqli->query("INSERT INTO Videos(name, category, length) VALUES ('".$video."', '".$cat."', '".$len."')")) {
		echo "Insert failed: (".$mysqli->errno.")".$mysqli->error;
	}
}
else 
	echo "You didn't enter a Movie Name. This is required. Please go back and try again";

$query = "SELECT * FROM Videos";
$result = $mysqli->query($query);
$num_results = $result->num_rows;
echo "Number of videos found: ".$num_results."</p>";

echo "<table border = '1'><br />";
echo "<tr>";
echo "<td>Name</td>";
echo "<td>Category</td>";
echo "<td>Length</td>";
echo "<td>Checked Out</td>";

for($i=0; $i<$num_results; $i++) {
	echo "<tr>";
	$row = $result->fetch_assoc();
	echo "<td>";
	echo $row["name"];
	echo "</td><td>";
	echo $row['category'];
	echo "</td><td>";
	echo $row['length'];
	echo "</td><td>";
	echo $row['rented'];
	echo "</td><td>";
	echo '<input type ="submit" value = "Delete"></td></tr>';
	

}
echo "</table>";

//while ($row = $result->fetch_assoc()) {
  //      printf ("%s %s %d %d\n", $row["name"], $row["category"], $row["length"], $row["rented"]);
    //}
/*
if(!($stmt = $mysqli->prepare("SELECT name, category, length, rented FROM Videos"))) {
	echo "Prepare failed: (" .$mysqli->erno. ")" .$mysqli->error;
}

if(!($stmt->executer()) {
	echo "Ececute failed: (" .$mysqli->erno. ")" .$mysqli->error;
}


$out_name = NULL;
$out_category = NULL;
$out_length = NULL;
$out_rented;

if(!$stmt->bind_result($out_name, $out_category, $out_length, $out_rented)) {
	echo "Binding output paremeters failed:(" .$mysqli->erno. ")" .$mysqli->error;
}

while($stmt->fetch()) {
	printf("name = %s, category = %s, length = %d, available = %d</br>",$out_name, $out_category, $out_length, $out_rented));
	echo "working";
}
*/
?>
</body>