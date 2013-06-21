<?php
	include '../databaseConnection.php';	
	include 'sql.php';

    // Start up
    session_start();
    date_default_timezone_set("America/Detroit");
    $time = date("Y/m/d H:i:s");
    

	$db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("League", $db);

    // Prepare announcement
    $announcement = $_POST['announcement'];
    $announcement = verify($announcement);
    $privacy = $_POST['privacy'];
    $creator = $_SESSION['summoner'];
    $creator = verify($creator);

    // Add the announcement to the database
    // User is either an admin or posting privately
    $query = "INSERT INTO announce VALUES ('".$announcement."','".$time."','".$creator."','Public','Yes')";
    mysql_query($query,$db);
   

    // Redirect to the main page
    header("Location: ../mainPage.php");
?>