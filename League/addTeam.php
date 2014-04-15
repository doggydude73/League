<?php
	include '../Layout.php';	
    include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("League", $db);

	$_SESSION['error'] = "";
	date_default_timezone_set("America/Detroit");
    $time = date("Y/m/d H:i:s");
	$team = $_POST['team'];
	$password = $_POST['password'];
	$captain = $_POST['captain'];
	$captEmail = $_POST['captEmail'];
	$summoner2 = $_POST['summoner2'];
	$summ2email = $_POST['summ2email'];
	$summoner3 = $_POST['summoner3'];
	$summ3email = $_POST['summ3email'];
	$summoner4 = $_POST['summoner4'];
	$summ4email = $_POST['summ4email'];
	$summoner5 = $_POST['summoner5'];
	$summ5email = $_POST['summ5email'];
    $waiver = $_POST['waiver'];
    $errorMessage = "";

	// Check to make sure the user has agreed to the waiver
    if ($waiver != "on"){
        $errorMessage = "You have not checked the waiver. Please check the waiver in order to complete registration.";
    }

	// Check for empty entries
	if ($team == "" || $captain == "" || $captEmail == "" || $summoner2 == "" || $summ2email == "" || $summoner3 == "" || $summ3email == "" || $summoner4 == "" || $summ4email == "" || $summoner5 == "" || $summ5email == "" || $password == ""){
		$errorMessage = "Please fill in all of the blanks to proceed.";
	}

    // Check for redundancies in the database
    $query = "SELECT * FROM premade";
    $sql = mysql_query($query, $db);
    while($row = mysql_fetch_array($sql))
    {
		$teamCheck = strtolower($row['TeamName']);
		$summ1Check = strtolower($row['Summoner1']);
		$summ2Check = strtolower($row['Summoner2']);
		$summ3Check = strtolower($row['Summoner3']);
		$summ4Check = strtolower($row['Summoner4']);
		$summ5Check = strtolower($row['Summoner5']);
		$email1Check = strtolower($row['Summoner1Email']);
		$email2Check = strtolower($row['Summoner2Email']);
		$email3Check = strtolower($row['Summoner3Email']);
		$email4Check = strtolower($row['Summoner4Email']);
		$email5Check = strtolower($row['Summoner5Email']);

		// Check for a teamname redundancy
		if (strtolower($team) == $teamCheck){
			$errorMessage = $team." has already been taken. Please select a new team name.";
		}
		
		/* Check each summoner against every summoner input in the database */

		/******** Captain *******/
		if (strtolower($captain) == $summ1Check || strtolower($captain) == $summ2Check || strtolower($captain) == $summ3Check || strtolower($captain) == $summ4Check || strtolower($captain) == $summ5Check){
			$errorMessage = $captain." has already been registered. Please contact the Site Administrator if you believe this is an error.";
		}

		/******** Summoner 2 *******/
		if (strtolower($summoner2) == $summ1Check || strtolower($summoner2) == $summ2Check || strtolower($summoner2) == $summ3Check || strtolower($summoner2) == $summ4Check || strtolower($summoner2) == $summ5Check){
			$errorMessage = $summoner2." has already been registered. Please contact the Site Administrator if you believe this is an error.";
		}

		/******** Summoner 3 *******/
		if (strtolower($summoner3) == $summ1Check || strtolower($summoner3) == $summ2Check || strtolower($summoner3) == $summ3Check || strtolower($summoner3) == $summ4Check || strtolower($summoner3) == $summ5Check){
			$errorMessage = $summoner3." has already been registered. Please contact the Site Administrator if you believe this is an error.";
		}

		/******** Summoner 4 *******/
		if (strtolower($summoner4) == $summ1Check || strtolower($summoner4) == $summ2Check || strtolower($summoner4) == $summ3Check || strtolower($summoner4) == $summ4Check || strtolower($summoner4) == $summ5Check){
			$errorMessage = $summoner4." has already been registered. Please contact the Site Administrator if you believe this is an error.";
		}

		/******** Summoner 5 *******/
		if (strtolower($summoner5) == $summ1Check || strtolower($summoner5) == $summ2Check || strtolower($summoner5) == $summ3Check || strtolower($summoner5) == $summ4Check || strtolower($summoner5) == $summ5Check){
			$errorMessage = $summoner5." has already been registered. Please contact the Site Administrator if you believe this is an error.";
		}


		/* Check for email redundencies in the database */

		/******** Captain ********/
		if (strtolower($captEmail) == $email1Check || strtolower($captEmail) == $email2Check || strtolower($captEmail) == $email3Check || strtolower($captEmail) == $email4Check || strtolower($captEmail) == $email5Check){
			$errorMessage = $captEmail." has already been registered. Please contact the Site Administrator if you believe this is an error.";
		}

		/******** Summoner 2 ********/
		if (strtolower($summ2email) == $email1Check || strtolower($summ2email) == $email2Check || strtolower($summ2email) == $email3Check || strtolower($summ2email) == $email4Check || strtolower($summ2email) == $email5Check){
			$errorMessage = $summ2email." has already been registered. Please contact the Site Administrator if you believe this is an error.";
		}

		/******** Summoner 3 ********/
		if (strtolower($summ3email) == $email1Check || strtolower($summ3email) == $email2Check || strtolower($summ3email) == $email3Check || strtolower($summ3email) == $email4Check || strtolower($summ3email) == $email5Check){
			$errorMessage = $summ3email." has already been registered. Please contact the Site Administrator if you believe this is an error.";
		}

		/******** Summoner 4 ********/
		if (strtolower($summ4email) == $email1Check || strtolower($summ4email) == $email2Check || strtolower($summ4email) == $email3Check || strtolower($summ4email) == $email4Check || strtolower($summ4email) == $email5Check){
			$errorMessage = $summ4email." has already been registered. Please contact the Site Administrator if you believe this is an error.";
		}

		/******** Summoner 5 ********/
		if (strtolower($summ5email) == $email1Check || strtolower($summ5email) == $email2Check || strtolower($summ5email) == $email3Check || strtolower($summ5email) == $email4Check || strtolower($summ5email) == $email5Check){
			$errorMessage = $summ5email." has already been registered. Please contact the Site Administrator if you believe this is an error.";
		}

    }

    if ($errorMessage == ""){
        // No errors occured. Continue onwards.

		/* Email each user and let them know they have been registered

		   Reserved Variables: $summoner - Summoner being emails
							   $team - The team name
							   $password - The team password
		*/
		include '../emailProtocol.php';
		$summoner = $captain;
		mail($captEmail.$extension,$teamSubject, $teamMessage, $headers); // Captain's Email
		$summoner = $summoner2;
		mail($summ2email.$extension,$teamSubject, $teamMessage, $headers); // Summoner 2's Email
		$summoner = $summoner3;
		mail($summ3email.$extension,$teamSubject, $teamMessage, $headers); // Summoner 3's Email
		$summoner = $summoner4;
		mail($summ4email.$extension,$teamSubject, $teamMessage, $headers); // Summoner 4's Email
		$summoner = $summoner5;
		mail($summ5email.$extension,$teamSubject, $teamMessage, $headers); // Summoner 5's Email

		// Check for escape characters in the input entries
		$team = verify($team);
		$password = verify($password);
        $captain = verify($captain);
        $captEmail = verify($captEmail);
		$summoner2 = verify($summoner2);
		$summ2email = verify($summ2email);
		$summoner3 = verify($summoner3);
		$summ3email = verify($summ3email);
		$summoner4 = verify($summoner4);
		$summ4email = verify($summ4email);
		$summoner5 = verify($summoner5);
		$summ5email = verify($summ5email);
        
		// Insert into the table
        $query = "INSERT INTO premade VALUES ('".$team."', '".$captain."', '".$captEmail."', '".$summoner2."', '".$summ2email."', '".$summoner3."', '".$summ3email."', '".$summoner4."', '".$summ4email."', '".$summoner5."', '".$summ5email."', '".$time."', 'No', '$password')";
		// Key: Team Name, Captain Info, Summoner 2 Info, Summoner 3 Info, Summoner 4 Info, Summoner 5 Info, Time Entered, No for payment made
        mysql_query($query,$db);
        header("Location: registerSuccess.php");

    }else{
        $_SESSION['error'] = $errorMessage;
        header("Location: premadeTeams.php");
    }

?>