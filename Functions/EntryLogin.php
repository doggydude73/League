<?php
	/* 
		Function parses the aram database for a summoner name and password that match the input
		
		Input:	username - Summoner name attempting login
				password - Password registered with
				db		 - Database of information

		Output: 1 - Success
				0 - Failure
				Session[entry] - {ARAM, Summoner Name, Team Name}
	*/
	function aramLogin($db, $username, $password){
		$username = verify($username);
		$query = "SELECT * FROM signup WHERE Summoner = '$username'";
		$sql = mysql_query($query,$db);

		// For each row from the query
		while($row = mysql_fetch_array($sql)){
			// If the row's password matches 
			if ($password == $row['Password']){
				// Prepare the type, summoner, and team name
				$entryArray = array();
				$entryArray[0] = "ARAM";
				$entryArray[1] = $row['Summoner'];
				$entryArray[2] = $row['TeamName'];
				// Set to the session
				$_SESSION['entry'] = $entryArray;
				// Return 1 for success
				return 1;
			}
		}
		// Return 0 for failure
		return 0;
	}

	/*
		Function parses the team database for a team name and password that match the registered input

		Input:	team	 - The team name registered
				password - Team password
				db		 - Database of information

		Output: 1 - Success
				0 - Failure
				Session[entry] - {Premade, Team Name, Captain, Summ 2-5, Paid}
	*/
	function teamLogin($db, $team, $password){
		$team = verify($team);
		$query = "SELECT * FROM premade WHERE TeamName = '$team'";
		$sql = mysql_query($query,$db);

		// For each row from the query
		while($row = mysql_fetch_array($sql)){
			// If the row's password matches 
			if ($password == $row['Password']){
				// Prepare the type, team name, summoners, and paid status
				$entryArray = array();
				$entryArray[0] = "Premade";
				$entryArray[1] = $row['TeamName'];
				$entryArray[2] = $row['Summoner1'];
				$entryArray[3] = $row['Summoner2'];
				$entryArray[4] = $row['Summoner3'];
				$entryArray[5] = $row['Summoner4'];
				$entryArray[6] = $row['Summoner5'];
				$entryArray[7] = $row['Paid'];
				// Set to the session
				$_SESSION['entry'] = $entryArray;
				// Return 1 for success
				return 1;
			}
		}
		// Return 0 for failure
		return 0;
	}

	/* 
		Function parses the aram database for a summoner name and password that match the input
		*NOTE* Same as it's friend aramLogin except it is storing it in the solo location for the session variable because this is used for those who own an account within the website and aren't temporary. As such, no password is needed.
		
		Input:	username - Summoner name attempting login
				db		 - Database of information

		Output: 1 - Success
				0 - Failure
				Session[solo] - {ARAM, Summoner Name, Team Name}
	*/
	function aramStore($db, $username){
		$username = verify($username);
		$query = "SELECT * FROM signup WHERE Summoner = '$username'";
		$sql = mysql_query($query,$db);

		// For each row from the query
		while($row = mysql_fetch_array($sql)){
			// If the row's password matches 
			$entryArray = array();
			$entryArray[0] = "ARAM";
			$entryArray[1] = $row['Summoner'];
			$entryArray[2] = $row['TeamName'];
			// Set to the session
			$_SESSION['solo'] = $entryArray;
			// Return 1 for success
			return 1;
		}
		// Return 0 for failure
		$_SESSION['solo'] = array();
		$_SESSION['solo'][0] = "None";
		return 0;
	}

	/*
		Function parses the team database for a summoner name and password that match the registered input
		*NOTE* Same as it's friend teamLogin except it is storing it in the team location for the session variable because this is used for those who own an account within the website and aren't temporary

		Input:	summoner - The summoner logged in
				db		 - Database of information

		Output: 1 - Success
				0 - Failure
				Session[team] - {Premade, Team Name, Captain, Summ 2-5, Paid}
	*/
	function teamStore($db, $summoner, $password){
		$query = "SELECT * FROM premade";
		$sql = mysql_query($query,$db);

		// For each row from the query
		while($row = mysql_fetch_array($sql)){
			// If the row contains the summoner in it's list of team members 
			if ($summoner == $row['Summoner1'] || $summoner == $row['Summoner2'] || $summoner == $row['Summoner3'] || $summoner == $row['Summoner4'] || $summoner == $row['Summoner5']){
				// Prepare the type, team name, summoners, and paid status
				$entryArray = array();
				$entryArray[0] = "Premade";
				$entryArray[1] = $row['TeamName'];
				$entryArray[2] = $row['Summoner1'];
				$entryArray[3] = $row['Summoner2'];
				$entryArray[4] = $row['Summoner3'];
				$entryArray[5] = $row['Summoner4'];
				$entryArray[6] = $row['Summoner5'];
				$entryArray[7] = $row['Paid'];
				// Set to the session
				$_SESSION['team'] = $entryArray;
				// Return 1 for success
				return 1;
			}
		}
		// Return 0 for failure
		$_SESSION['team'] = array();
		$_SESSION['team'][0] = "None";
		return 0;
	}

	/*
		Function pulls the information about the user that includes whether the user is banned

		Input:	summoner - The summoner being logged in
				db		 - Database of information

		Output: 1 - Success
				0 - Failure (Not Found)
				Session[ban] - {Currently Banned, Reason, Date Lifted, Person Who Issued Ban, Date Issued}
	*/
	function banStore($summoner, $db){
		$summoner = verify($summoner);
		$query = "SELECT * FROM permarecord WHERE Summoner = '$summoner'";
		$sql = mysql_query($query, $db);

		while ($row = mysql_fetch_array($sql)){
			// Get the entry array of information
			$entryArray = array();
			$entryArray[0] = $row['banned'];
			$entryArray[1] = $row['reason'];
			$entryArray[2] = $row['lift'];
			$entryArray[3] = $row['banner'];
			$entryArray[4] = $row['applied'];
			// Set the ban location in the session variable to the entry array
			$_SESSION['ban'] = $entryArray;
			// Return a 1 for success
			return 1;
		}
		// Return 0 for failure
		$_SESSION['ban'] = array();
		$_SESSION['ban'][0] = "Error: Summoner not found!";
		return 0;
	}


	/*
		Function pulls information about the user and their overall record with the club

		Input:	summoner - The summoner being logged in
				db		 - Database of information

		Output: 1 - Success
				0 - Failure (Not Found)
				Session[overall] - {Wins, Losses, Forfeits}
	*/
	function overallStore($summoner, $db){
		$summoner = verify($summoner);
		$query = "SELECT * FROM permarecord WHERE Summoner = '$summoner'";
		$sql = mysql_query($query, $db);

		while ($row = mysql_fetch_array($sql)){
			// Get the entry array of information
			$entryArray = array();
			$entryArray[0] = $row['win'];
			$entryArray[1] = $row['loss'];
			$entryArray[2] = $row['forfeit'];
			// Set the ban location in the session variable to the entry array
			$_SESSION['overall'] = $entryArray;
			// Return a 1 for success
			return 1;
		}
		// Return 0 for failure
		$_SESSION['overall'] = array();
		$_SESSION['overall'][0] = "Error: Summoner not found!";
		return 0;
	}

	/*
		Function pulls the information about the user in his current LCS season record
		
		Input:	summoner - The summoner being logged in
				db		 - Database of information

		Output: 1 - Success
				0 - Failure (Not Found)
				Session[lcs] - {Team, Wins, Losses, Forfeits}
	*/
	function lcsStore($summoner, $db){
		$summoner = verify($summoner);
		$query = "SELECT * FROM mtulcs WHERE Summoner = '$summoner'";
		$sql = mysql_query($query, $db);

		while ($row = mysql_fetch_array($sql)){
			// Get the entry array of information
			$entryArray = array();
			$entryArray[0] = $row['team'];
			$entryArray[1] = $row['win'];
			$entryArray[2] = $row['loss'];
			$entryArray[3] = $row['forfeit'];
			// Set the ban location in the session variable to the entry array
			$_SESSION['lcs'] = $entryArray;
			// Return a 1 for success
			return 1;
		}
		// Return 0 for failure
		$_SESSION['lcs'] = array();
		$_SESSION['lcs'][0] = "Error: Summoner not found!";
		return 0;
	}

?>
