<?php
    include '../Layout.php';
    include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("League", $db);

	$_SESSION['error'] = "";
    date_default_timezone_set("America/Detroit");
    $time = date("Y/m/d H:i:s");
    $summoner = $_POST['summoner'];
    $email = $_POST['email'];
    $team = $_POST['team'];
	$password = $_POST['password'];
    $waiver = $_POST['waiver'];
    $errorMessage = "";

    // Check to make sure the user has agreed to the waiver
    if ($waiver != "on"){
        $errorMessage = "You have not checked the waiver. Please check the waiver in order to complete registration.";
    }

	// Check for empty input
	if ($summoner == "" || $email == "" || $team == "" || $password == ""){
		$errorMessage = "Please fill in all of the blanks to proceed.";
	}

    // Check for redundancies in the database
    $query = "SELECT * FROM signup";
    $sql = mysql_query($query, $db);
    while($row = mysql_fetch_array($sql))
    {
       
         if (strtolower($row['Summoner']) == strtolower($summoner)){ 
            $errorMessage = "Your summoner name has already been registered. Please contact the site administrator to resolve the issue."; 
            break;
        }
        else if (strtolower($row['TeamName']) == strtolower($team)){
            $errorMessage = "Your suggested team name has already been entered. Please select a new team name.";
            break;
        }
    }

    if ($errorMessage == ""){

		// Send an email to the participant letting them know they have registered in the tournament.
		include '../emailProtocol.php';
		$to = $email.$extension;
		mail($to,$aramSubject,$aramMessage,$headers);

        // No errors occured. Continue onwards.
        $summoner = verify($summoner);
        $email = verify($email);
        $team = verify($team);
		$password = verify($password);

        $query = "INSERT INTO signup VALUES ('".$summoner."', '".$email."', '".$team."', '".$time."', '$password')";
        mysql_query($query,$db);
        header("Location: registerSuccess.php");

    }else{
        $_SESSION['error'] = $errorMessage;
        header("Location: LeagueSignUp.php");
    }
?>
