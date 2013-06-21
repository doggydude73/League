<?php
	include '../Layout.php';
	include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    if (!$db){die('Could not connect to database');}
    mysql_select_db("League", $db);

	$gameType = $_SESSION['entry'][0];
	$teamName = $_SESSION['entry'][1];
	$teamName = verify($teamName);

	// Remove from the database based on the gametype
	if ($gameType == "ARAM"){
		$query = "DELETE FROM signup WHERE Summoner = '$teamName'";
		mysql_query($query, $db);
	}else if ($gameType == "Premade"){
		$query = "DELETE FROM premade WHERE TeamName = '$teamName'";
		mysql_query($query, $db);
	}
	
	$newTeamArray = array();
	$newTeamArray[0] = "None";
	$_SESSION['entry'] = $newTeamArray;
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
				<div class="page-header">
					<h1>Withdrawl Success</h1>
				</div>
				<p class="lead">You have successfully withdrawn from the tournament. Thank you for doing so. If you wish to re-register because you are re-available, feel free.</p>
				<p>You will be redirected back to the main page in 5 seconds.</p>
			</div>
		</div>
    </body>
</html>

<script> 
	function timedRefresh(timeoutPeriod){
		setTimeout("window.location = \"../Functions/refreshUserData.php\";", timeoutPeriod);
	}
</script>