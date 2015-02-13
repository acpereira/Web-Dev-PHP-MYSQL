<html>
<head>
	<title>Video Store</title>
</head>
<body>

<?php
ini_set('display_errors', 'On');
require('connect.php');

if($_POST){

	if(isset($_POST['videoName'])&&!empty($_POST['videoName'])){
		$video = $_POST['videoName'];
		$cat = $_POST['videoCat'];
		$len = $_POST['videoLength'];

		if (!($stmt = $mysqli->prepare("INSERT INTO Videos(name, category, length) VALUES (?,?,?)"))) {
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		if (!$stmt->bind_param("ssi", $video, $cat, $len)) {
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		if (!$stmt->execute()) {
			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		$stmt->close();
	}

	else 
		echo "You didn't enter a Movie Name. This is required. Please go back and try again  ";
}


$query = "SELECT * FROM Videos";
$result = $mysqli->query($query);
$num_results = $result->num_rows;
echo "Number of videos found: ".$num_results."</p>";

echo "Current Inventory";
echo "<table border = '1'><br />";
echo "<tr>";
echo "<td>Name</td>";
echo "<td>Category</td>";
echo "<td>Length</td>";
echo "<td>Checked Out/Available</td>";

for($i=0; $i<$num_results; $i++) {
	
	echo "<tr>";
	$row = $result->fetch_assoc();
	$uniqueId = $row['id'];
	echo "<td>";
	echo $row["name"];
	?>
	<form method = "post" action = "http://web.engr.oregonstate.edu/~pereiraa/delete.php">
    <input type = "hidden" name = "rent" value ="<?php print $uniqueId;?>">
    <input type = "submit" value = "Check In/Out">
	</form>

	<?php
	echo "</td><td>";
	echo $row['category'];
	echo "</td><td>";
	echo $row['length'];
	echo "</td><td>";
	if($row['rented']==1)
		echo "Checked out";
	else
		echo "Available";
	echo "</td><td>";
	
	?>
    <form method = "post" action = "http://web.engr.oregonstate.edu/~pereiraa/delete.php">
    <input type = "hidden" name = "indexKey" value ="<?php print $uniqueId;?>">
    <input type = "submit" value = "Delete">
	</form>
    
    <?php 

	echo "</td></tr>";
}

echo "</table>";

echo "<br>Click";
echo '<a href = "http://web.engr.oregonstate.edu/~pereiraa/Inventory.php"> here</a>';
echo  " to add more videos.<br />";

?>
<form method = "post" action = "http://web.engr.oregonstate.edu/~pereiraa/delete.php">
<input type = "hidden" name = "Clear">
<input type = "submit" value = "Delete All Videos">
</form>
    
<?php 

$newQuery = "SELECT DISTINCT category FROM Videos";
$newResult = $mysqli->query($newQuery);
$newNum_results = $newResult->num_rows;
echo "Number of Categories found: ".$newNum_results."</p>";

for($j=0; $j<$newNum_results; $j++) {

	$select = $newResult->fetch_assoc();
	echo $select['category'];
}





?>
</body>