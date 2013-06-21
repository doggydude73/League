<?php
	include '../Layout.php';
	if ($_SESSION['role'] != "EBoard" && $_SESSION['role'] != "SuperAdministrator"){
        header("Location: ../mainPage.php");
    }else{
		include '../databaseConnection.php';

		$db = mysql_connect($connection,$dbUsername,$dbPassword);
		mysql_select_db("League", $db);
		$personBanned = $_GET['banned'];
		$personBanned = verify($personBanned);
		$dateBanned = date("Y-m-d");
		$bannedUntil = $_GET['date'];
		$reason = $_GET['reasons'];
		$reason = verify($reason);
		$banExecutioner = $_GET['executioner'];
		$banExecutioner = verify($banExecutioner);
	

		$query = "UPDATE permarecord SET banned = 'Yes', reason = '$reason', lift = '$bannedUntil', banner = '$banExecutioner', applied = '$dateBanned' WHERE summoner = '$personBanned'";
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
                    <h1>Ban Applied</h1>
					<p class="lead"><?php echo $personBanned; ?> has been banned. Redirecting back to administrator controls shortly.</p>
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
