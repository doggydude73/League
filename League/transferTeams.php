<?php
	include '../Layout.php';
    include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("League", $db);

	// Clear the old team list
	$query = "DELETE FROM teamalignment";
	mysql_query($query,$db);

	// Get the current entry teams
	$query = "SELECT * FROM premade";
	$sql = mysql_query($query,$db);

	// Base channel ID for team insertion
	$id = 4;

	while ($row = mysql_fetch_array($sql)){
		
		// Extract pertanent team information
		$teamName = verify($row['TeamName']);
		$captain = verify($row['Summoner1']);
		$summoner2 = verify($row['Summoner2']);
		$summoner3 = verify($row['Summoner3']);
		$summoner4 = verify($row['Summoner4']);
		$summoner5 = verify($row['Summoner5']);
		$password = verify($row['Password']);
		
		// Insert into the team alignment table
		mysql_select_db("League", $db);
		$query = "INSERT INTO teamalignment VALUES ('$teamName', '$captain', '$summoner2', '$summoner3', '$summoner4', '$summoner5')";
		mysql_query($query, $db);

		/******** Prepare the team's mumble chatroom ********/
		mysql_select_db("mumble", $db);

		// Set up the channel
		$query = "INSERT INTO channels VALUES ('1', '$id', '2', '$teamName', '1')";
		mysql_query($query, $db);

		// Insert the channel information
		$query = "INSERT INTO channel_info VALUES ('1', '$id', '1', '0')";
		mysql_query($query, $db);
		$query = "INSERT INTO channel_info VALUES ('1', '$id', '0', '')";
		mysql_query($query, $db);

		// Set up the password for the channel
		$query = "INSERT INTO acl (server_id, channel_id, priority, group_name, apply_here, apply_sub, grantpriv, revokepriv) VALUES ('1', '$id', '5', 'all', '1', '0', '0', '910')";
		mysql_query($query, $db);
		$query = "INSERT INTO acl (server_id, channel_id, priority, group_name, apply_here, apply_sub, grantpriv, revokepriv) VALUES ('1', '$id', '6', '#".$password."', '1', '0', '910', '0')";
		mysql_query($query, $db);

		/**** Increment the channel id number for the next team ****/ 
		$id ++;

	}

	header("Location: createBracket.php");

?>