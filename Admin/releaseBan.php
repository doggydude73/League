<?php
	include '../Layout.php';
	if ($_SESSION['role'] != "EBoard" && $_SESSION['role'] != "SuperAdministrator"){
		// If the user is not of the correct role, do not execute the following code
        header("Location: ../mainPage.php");
    }else{
		// Connect to the database and get the user that will be released from a ban
		include '../databaseConnection.php';

		$db = mysql_connect($connection,$dbUsername,$dbPassword);
		mysql_select_db("League", $db);
		$personBanned = $_GET['banned'];
		$personBanned = verify($personBanned);
		
		$query = "UPDATE permarecord SET banned = 'No' WHERE summoner = '$personBanned'";
		mysql_query($query, $db);
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
        <div style="margin-top:  100px;" class="container">
            <div class="well well-large">
                <div class="page-header">
                    <h1>Ban Released</h1>
					<p class="lead"><?php echo $personBanned; ?> has been released from their ban. Redirecting back to administrator controls shortly.</p>
                </div> 
			</div>
		</div>
    </body>
</html>

<script> 
	function timedRefresh(timeoutPeriod){
		setTimeout("window.location = \"AdminControls.php\";", timeoutPeriod);
	}
</script>
