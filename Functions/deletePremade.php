<?php
	include '../Layout.php';
    if ($_SESSION['role'] != "EBoard" && $_SESSION['role'] != "SuperAdministrator"){
        header("Location: ../mainPage.php");
    }else{
    	include '../databaseConnection.php';

		$db = mysql_connect($connection,$dbUsername,$dbPassword);
		if (!$db){die('Could not connect to database');}
		mysql_select_db("League", $db);

		$query = "DELETE FROM premade";
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

        <div style="margin-top: 100px;" class="container">
            <div class="well well-large" id="content">
				<div class="page-header">
					<h1>Premade 5's Database Deleted</h1>
				</div>
				<p class="lead">The premade teams database has been cleared.</p>
				<p>You will be redirected back to the Account Management page in 5 seconds.</p>
			</div>
			
		</div>
    </body>
</html>

<script>
	function timedRefresh(timeoutPeriod)
	{
		setTimeout("window.location = \"../Admin/AdminControls.php\";", timeoutPeriod);
	}
</script>