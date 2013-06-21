<?php
	include '../Layout.php';
	include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);;
    if (!$db){die('Could not connect to database');}
    mysql_select_db("League", $db);

	$gameType = $_SESSION['entry'][0];
	$teamName = $_SESSION['entry'][1];
	$newSummoner = $_POST['summoner'];
	$newEmail = $_POST['email'];
	$position = $_POST['position'] - 1;
	$currSummoner = $_SESSION['entry'][$position + 1];
	$error = "";

	// Remove from the database based on the gametype
	if ($gameType == "Premade"){

		// Check for redundant naming
		$query = "SELECT * FROM premade";
		$sql = mysql_query($query, $db);
		$check = 0;
		while($row = mysql_fetch_array($sql)){
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

			/* Check each summoner against every summoner input in the database */

			/******** Summoner *******/
			if (strtolower($newSummoner) == $summ1Check || strtolower($newSummoner) == $summ2Check || strtolower($newSummoner) == $summ3Check || strtolower($newSummoner) == $summ4Check || strtolower($newSummoner) == $summ5Check)
			{
				$check = 1;	
			}

			/******** Email (Don't check because it could be non-mtu and the friend needs to register with that friend's MTU address ********/
			
		}

		// If the person is not already registered, update it 
		if ($check == 0){
			$_SESSION['entry'][$position + 1] = $newSummoner;
			$newSummoner = verify($newSummoner);
			$newEmail = verify($newEmail);
			$currSummoner = verify($currSummoner);
			// Update the email FIRST
			$query = "UPDATE premade SET Summoner".$position."Email = '$newEmail' WHERE Summoner".$position." = '$currSummoner'";
			mysql_query($query, $db);

			// Update the summoner name
			$query = "UPDATE premade SET Summoner".$position." = '$newSummoner' WHERE Summoner".$position." = '$currSummoner'";
			mysql_query($query, $db);
			
		}
		else
		{
			// The name was already being used. Output an error message
			$error = "The person you want to add to your team is already on another team. Please contact the Site Administrator if you believe there is an error.";
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
							<h1>Roster Changed</h1>
						</div>
						<p class="lead">Your roster has been changed. Thank you for completing this. Good luck in the upcoming tournament.</p>
						<p>You will be redirected back to the Account Management page in 5 seconds.</p>';}
					else
					{
						echo '<div class="page-header">
							<h1>Roster Change Failed</h1>
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
