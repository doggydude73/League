<?php
	include '../Layout.php';
	include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    if (!$db){die('Could not connect to database');}
    mysql_select_db("League", $db);

	$gameType = $_SESSION['entry'][0];
	$teamName = $_SESSION['entry'][1];
	$newTeamName = $_POST['team'];
	$newTeamNameV = verify($newTeamName);
	$teamName = verify($teamName);
	$error = "";

	// Remove from the database based on the gametype
	if ($gameType == "ARAM"){

		// Check for redundant naming
		$query = "SELECT * FROM signup WHERE TeamName = '$newTeamNameV'";
		$sql = mysql_query($query, $db);
		$check = 0;
		while($row = mysql_fetch_array($sql)){
			$check = 1;
		}

		// If noone was already using the name, update it 
		if ($check == 0){
			$_SESSION['entry'][1] = $newTeamName;
			$query = "UPDATE signup SET TeamName = '$newTeamNameV' WHERE TeamName = '$teamName'";
			mysql_query($query, $db);
			
		}
		else
		{
			// The name was already being used. Output an error message
			$error = "Your team name already exists. Please select a new name.";
		}
	}
	else if ($gameType == "Premade"){

		// Check for redundant naming
		$query = "SELECT * FROM premade WHERE TeamName = '$newTeamNameV'";
		$sql = mysql_query($query, $db);
		$check = 0;
		while($row = mysql_fetch_array($sql)){
			$check = 1;
		}

		// If no one was already using the name, update it 
		if ($check == 0){
			$_SESSION['entry'][1] = $newTeamName;
			$query = "UPDATE premade SET TeamName = '$newTeamNameV' WHERE TeamName = '$teamName'";
			mysql_query($query, $db);
		}
		else
		{
			// The name was already being used. Output an error message
			$error = "Your team name already exists. Please select a new name.";
		}
	}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body onload="Javascript: timedRefresh(8000);">
        <?php include '../navBar.php'; ?>

        <div style="margin-top: 100px;" class="container">
            <div class="well well-large" id="content">
				<?php
					if ($error==""){
						echo '<div class="page-header">
							<h1>Team Name Changed</h1>
						</div>
						<p class="lead">Your team name has been changed. Thank you for completing this. Good luck in the upcoming tournament.</p>
						<p>You will be redirected back to the Account Management page in 5 seconds.</p>';}
					else
					{
						echo '<div class="page-header">
							<h1>Name Change Failed</h1>
						</div>
						<p class="lead">'.$error.'</p>
						<p>You will be redirected back to the Account Management page in 5 seconds.</p>';
					}
				?>
			</div>
			
		</div>
    </body>
</html>

<?php
	echo ' <script> function timedRefresh(timeoutPeriod){';
	// Check to see where to redirect
	if ($_SESSION['entry'][0] == "ARAM")
		echo 'setTimeout("window.location = \"Solo.php\";", timeoutPeriod);';
	else
		echo 'setTimeout("window.location = \"Team.php\";", timeoutPeriod);';

	echo '	} </script>';
	
?>