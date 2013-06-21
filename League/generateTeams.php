<?php
	include '../Layout.php';
    include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("League", $db);

	$numberEntrants = 0;

	// Clear the old team list
	$query = "DELETE FROM teamalignment";
	mysql_query($query,$db);

	// Calculate total number of entrants
	$query = "SELECT * FROM signup ORDER BY EntryTime ASC";
	$sql = mysql_query($query,$db);

	while($row = mysql_fetch_array($sql)){
		$numberEntrants ++;
	}

	// Extra people beyond the teams of 5
	$leftOver = $numberEntrants % 5;

	// Figure out how many to get from the signup list
	$numNeeded = $numberEntrants - $leftOver;

    // Get all those who have signed up and order by those who registered first
    $query = "SELECT * FROM signup ORDER BY EntryTime ASC LIMIT ".$numNeeded;
    $sql = mysql_query($query,$db);

	// Get all the contestants into a single array
	$contestants = array();
	$count = 0;
	while($row = mysql_fetch_array($sql))
    {
        $contestants[$count] = array();
		$contestants[$count][0] = $row['Summoner'];
		$contestants[$count][1] = $row['TeamName'];
		$contestants[$count][2] = $row['Password'];
        $count ++;
    }

	// Randomly splice the contestants array into teams
    $capt = "";
    $summ2 = "";
    $summ3 = "";
    $summ4 = "";
    $summ5 = "";
    $teamName = "";
	$password = "";
	$id = 4;

    for ($i = 0; $i < $numNeeded; $i++){

		// Splicing: Select a number from the array, get the info and insert it into the next available slot
		$rand = ceil(rand(0, $count));
        $selectedCompetitor = array_splice($contestants, $rand-1, 1)[0];
		$count --;

        if ($capt == ""){
            // Captain is unfilled
            $capt = $selectedCompetitor[0];
            $teamName = $selectedCompetitor[1];
			$password = $selectedCompetitor[2];
        }elseif($summ2 == ""){
            // Summoner 2 is unfilled
            $summ2 = $selectedCompetitor[0];
        }elseif($summ3 == ""){
            // Summoner 3 is unfilled
            $summ3 = $selectedCompetitor[0];
        }elseif($summ4 == ""){
            // Summoner 4 is unfilled
            $summ4 = $selectedCompetitor[0];
        }elseif($summ5 == ""){
            // Summoner 5 is unfilled
            $summ5 = $selectedCompetitor[0];

			// Check for injection
			$teamName = verify($teamName);
			$capt = verify($capt);
			$summ2 = verify($summ2);
			$summ3 = verify($summ3);
			$summ4 = verify($summ4);
			$summ5 = verify($summ5);

            // All of the required summoner positions have been filled. Add the team into the total team database
			mysql_select_db("League", $db);
            $query = "INSERT INTO teamalignment VALUES ('".$teamName."', '".$capt."', '".$summ2."', '".$summ3."', '".$summ4."', '".$summ5."')";
			mysql_query($query,$db);

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

            // Empty out all the positions so the if waterfall will continue to work
            $capt = "";
            $summ2 = "";
            $summ3 = "";
            $summ4 = "";
            $summ5 = "";
			$password = "";
        }
    }

	// CHECK FOR OVERFLOW
	if ($leftOver != 0){
		$query = "SELECT * FROM signup ORDER BY EntryTime DESC LIMIT ".$leftOver;
		$sql = mysql_query($query,$db);

		// Get all the left overs into a single array
		$contestants = array();
		$count = 0;
		while($row = mysql_fetch_array($sql))
		{
			$contestants[$count] = array();
			$contestants[$count][0] = $row['Summoner'];
			$contestants[$count][1] = $row['TeamName'];
			$contestants[$count][2] = $row['Password'];
			$count ++;
		}

		for ($i = 0; $i < $leftOver; $i++){
			// Splicing: Select a number from the array, get the info and insert it into the next available slot
			$rand = ceil(rand(0, $count));
			$selectedCompetitor = array_splice($contestants, $rand-1, 1)[0];
			$count --;

			if ($capt == ""){
				// Captain is unfilled
				$capt = $selectedCompetitor[0];
				$teamName = "Standby/Substitute";
				$password = $selectedCompetitor[2];
			}elseif($summ2 == ""){
				// Summoner 2 is unfilled
				$summ2 = $selectedCompetitor[0];
			}elseif($summ3 == ""){
				// Summoner 3 is unfilled
				$summ3 = $selectedCompetitor[0];
			}elseif($summ4 == ""){
				// Summoner 4 is unfilled
				$summ4 = $selectedCompetitor[0];
			}
		}

		// Turn extras into an Empty Spot
		for ($i = $leftOver; $i < 5; $i++){

			if($summ2 == ""){
				// Summoner 2 is unfilled
				$summ2 = "Empty";
			}elseif($summ3 == ""){
				// Summoner 3 is unfilled
				$summ3 = "Empty";
			}elseif($summ4 == ""){
				// Summoner 4 is unfilled
				$summ4 = "Empty";
			}elseif($summ5 == ""){
            // Summoner 5 is unfilled
            $summ5 = "Empty";

			// Check for injection
			$teamName = verify($teamName);
			$capt = verify($capt);
			$summ2 = verify($summ2);
			$summ3 = verify($summ3);
			$summ4 = verify($summ4);
			$summ5 = verify($summ5);

            // All of the required summoner positions have been filled. Add the team into the total team database
			mysql_select_db("League", $db);
            $query = "INSERT INTO teamalignment VALUES ('".$teamName."', '".$capt."', '".$summ2."', '".$summ3."', '".$summ4."', '".$summ5."')";
			mysql_query($query,$db);

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

            // Empty out all the positions so the if waterfall will continue to work
            $capt = "";
            $summ2 = "";
            $summ3 = "";
            $summ4 = "";
            $summ5 = "";
			}
		}
	}

    header("Location: createBracket.php");
?>
