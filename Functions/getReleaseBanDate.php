<?php	
	// Open the database
	include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("League", $db);

	// Get the summoner sent
	$summoner = $_GET['summoner'];
	$release = "";

	// Query the database for the lift date for the given summoner
	$query = "SELECT lift FROM permarecord WHERE summoner = '$summoner'";
	$sql = mysql_query($query, $db);

	// Extract the data
	while ($row = mysql_fetch_array($sql)){
		$release = $row['lift'];
	}

	// Convert the date to a more meaningful information source
	$release = strtotime($release);
	$release = date("F dS Y", $release);

	echo $release;
	
?>