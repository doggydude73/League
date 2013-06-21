<?php
    
    /* 
        Function accepts a query statement and a value to which the statement is looking for.

        Arugment: query - Query Statement
                  field - Field to be queried in each row
                  value - Value user is looking for in the table
                  db    - Database being queried

        Return    1     - A match was found
                  0     - No match found
    */
    function tableQuery($query, $field, $value, $db){
        $sql = mysql_query($query, $db);
        
        while($row = mysql_fetch_array($sql))
        {
            if ($row[$field] == $value){ return 1; }
        }
        return 0;
    }
    /*
        Function escapes any characters the user might put in as an attempt to hack the SQL server
    */
    function verify($word){
        $word = mysql_real_escape_string($word);
        return $word;
    }

    /*
        Function attempts to login a user based upon the passed in username and password.

        Argument: query    - Query Statement containing the "WHERE" clause against the passed in username
                  password - Password passed into to be matched with the username
                  db       - Database to be searched
    */
    function attemptLogin($query, $password, $db){
        $sql = mysql_query($query, $db);

        while($row = mysql_fetch_array($sql))
        {
            if ($row['Password'] == $password){ return $row['Role']; }
        }
        return 0;
    }

    /*
        Function gets the user's card ID to apply to the Hockey and Broomball DBs
   */
    function getEmail ($db, $user){
        
        mysql_select_db("League",$db);
		$user = verify($user);
        $query = "SELECT * FROM userprofile WHERE LoginId = '$user'";
        $sql = mysql_query($query, $db);
		$id = NULL;
        while($row = mysql_fetch_array($sql))
        {
            $id = $row['Email'];
        }
        return $id;
    }

    function getName ($query, $db){
        mysql_select_db("League", $db);
        $sql = mysql_query($query,$db);
        $name = "";
        while($row = mysql_fetch_array($sql))
        {
            $name = $row['Summoner'];
        }
        return $name;

    }

    /*
        Function determines what role the user is and returns it as a number to make processing easier
    */
    function inRole(){
		if (!isset($_SESSION['role']) or $_SESSION['role'] == null ) { return 0; }
        else if ($_SESSION['role'] == "New"){ return 1;}
        else if ($_SESSION['role'] == "User"){ return 2; }
        else if ($_SESSION['role'] == "EBoard") {return 4;}
        else if ($_SESSION['role'] == "SuperAdministrator"){return 5;}
        else { return 0; }
    }

    /*
        Same as function above but accepts a role as an input
    */
    function getRole($role){
        if ($role == "New"){ return 1;}
        else if ($role == "User"){ return 2; }
        else if ($role == "EBoard") {return 4;}
        else { return 0; }
    }

	/*
		Function adds the win or loss to the team sent into the system

		Input: team   - The team to be updated
			   status - Whether the team won or lost
			   db	  - The database searched and executed from

		Output: None

	*/
	function updateRecord($team, $status, $db){
		$team = verify($team);
		$query = "SELECT * FROM teamalignment WHERE TeamName = '$team'";
		$sql = mysql_query($query, $db);
		
		while ($row = mysql_fetch_array($sql)){
			$summ0 = $row['Captain'];
			$summ1 = $row['Summoner2'];
			$summ2 = $row['Summoner3'];
			$summ3 = $row['Summoner4'];
			$summ4 = $row['Summoner5'];

			executeRecordUpdate ($summ0, $status, $db);
			executeRecordUpdate ($summ1, $status, $db);
			executeRecordUpdate ($summ2, $status, $db);
			executeRecordUpdate ($summ3, $status, $db);
			executeRecordUpdate ($summ4, $status, $db);
		}
	}
	
	/*
		Function completes the brute force of updating the winning/losing record overall of a given player

		Input: player - The player to be updated
			   status - Whether the player won or lost
			   db	  - The database searched and executed from

		Output: None 
	*/
	function executeRecordUpdate($player, $status, $db){
		
		if ($status == "Win"){
			$currWinsSummX = 0;
				
			/* Summoner X */
			$player = verify($player);
			$query = "SELECT * FROM permarecord WHERE Summoner = '$player'";
			$sql = mysql_query($query,$db);
			while($row = mysql_fetch_array($sql)){
				$currWinsSummX = $row['win'];
			}

			// Up the win number by 1
			$currWinsSummX ++;

			// Update the number of wins back into permarecord
			$query = "UPDATE permarecord SET win = '$currWinsSummX' WHERE Summoner = '$player'";
			mysql_query($query,$db);
		}
		else{
			$currLossSummX = 0;
				
			/* Summoner X */
			$player = verify($player);
			$query = "SELECT * FROM permarecord WHERE Summoner = '$player'";
			$sql = mysql_query($query,$db);
			while($row = mysql_fetch_array($sql)){
				$currLossSummX = $row['loss'];
			}

			// Up the loss number by 1
			$currLossSummX ++;

			// Update the number of wins back into permarecord
			$query = "UPDATE permarecord SET loss = '$currLossSummX' WHERE Summoner = '$player'";
			mysql_query($query,$db);
		}
	} 
?>