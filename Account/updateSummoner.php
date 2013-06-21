<?php
	include '../Layout.php';
	include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    if (!$db){die('Could not connect to database');}
    mysql_select_db("League", $db);

	$currentSummoner = $_SESSION['summoner'];
	$newSummoner = $_POST['newSummoner'];
	$error = "";

	// Update the Session Variable
	$_SESSION['summoner'] = $newSummoner;
	
	// Prepare the current and new summoners for sql statements
	$currentSummoner = verify($currentSummoner);
	$newSummonerV = verify($newSummoner);

	// Check for a summoner with the new proposed name
	$query = "SELECT * FROM userprofile WHERE Summoner = '$newSummonerV'";
	$sql = mysql_query($query, $db);
	while ($row = mysql_fetch_array($sql)){
		$error = "Your new suggested summoner name has already been registered. Please contact the administrator if you feel this is an error.";
	}

	// If the while loop did not trigger, there is no record of the new summoner name. Update the files accordingly
	if ($error == ""){

		// Update the user profile table
		$query = "UPDATE userprofile SET Summoner ='$newSummonerV' WHERE Summoner = '$currentSummoner'";
		mysql_query($query,$db);

		// Update the LCS table
		$query = "UPDATE mtulcs SET Summoner ='$newSummonerV' WHERE Summoner = '$currentSummoner'";
		mysql_query($query,$db);

		// Update the LCS table
		$query = "UPDATE permarecord SET Summoner ='$newSummonerV' WHERE Summoner = '$currentSummoner'";
		mysql_query($query,$db);
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
							<h1>Summoner Name Changed</h1>
						</div>
						<p class="lead">Your summoner name has been updated.</p>
						<p>You will be redirected back to the Account Management page in 5 seconds.</p>';}
					else
					{
						echo '<div class="page-header">
							<h1>Summoner Name Change Failed</h1>
						</div>
						<p class="lead">'.$error.'</p>
						<p>You will be redirected back to the Account Management page in 5 seconds.</p>';
					}
				?>
			</div>
			
		</div>
        
    </body>
</html>

<script> 
	function timedRefresh(timeoutPeriod){
		setTimeout("window.location = \"../Functions/refreshUserData.php\";", timeoutPeriod);
	}
</script>