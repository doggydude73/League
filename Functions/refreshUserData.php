<?php
	include '../Layout.php';
	include '../Functions/EntryLogin.php';
	include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    if (!$db){die('Could not connect to database');}
    mysql_select_db("League", $db);

	$summoner = $_SESSION['summoner'];

	// Call aram and team store to see if the user currently belongs to any registered teams
	aramStore($db, $summoner);
	teamStore($db, $summoner);
	// Call the record store functions to get the current status of the user (Bans, overall, and current season)
	banStore($summoner, $db);
	overallStore($summoner, $db);
	lcsStore($summoner, $db);

	header("Location: ../Account/Users.php");
?>
