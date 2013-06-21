<?php
	include '../Layout.php';
	include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    if (!$db){die('Could not connect to database');}
    mysql_select_db("League", $db);

	$error = "";
	$newEmail = $_POST['email'];
	$_SESSION['email'] = $newEmail;
	$newEmail = verify($newEmail);
	$summoner = $_SESSION['summoner'];
	$summoner = verify($summoner);

	$query = "UPDATE userprofile SET Email = '$newEmail' WHERE Summoner = '$summoner'";
	mysql_query($query, $db);

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
							<h1>Email Changed</h1>
						</div>
						<p class="lead">Your email has been changed. Thank you for completing this.</p>
						<p>You will be redirected back to the Account Management page in 5 seconds.</p>';}
					else
					{
						echo '<div class="page-header">
							<h1>Email Change Failed</h1>
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
		setTimeout("window.location = \"Users.php\";", timeoutPeriod);
	}
</script>
