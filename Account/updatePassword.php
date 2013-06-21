<?php
	include '../Layout.php';
	include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    if (!$db){die('Could not connect to database');}
    mysql_select_db("League", $db);

	$error = "";
	$success = "";

	$oldPassword = $_POST['current'];
	$newPassword = $_POST['newPass'];
	$confirmNew = $_POST['confirm'];

	if ($newPassword != $confirmNew){
		$error = "Your new password and the confirmation password do not match. Please go back to the password change page and try again.";
	}else{
		// Query the database for a match of the summoner and old password
		$summoner = $_SESSION['summoner'];
		$summoner = verify($summoner);
		$oldPassword = verify($oldPassword);
		$query = "SELECT * FROM userprofile WHERE Summoner = '$summoner' AND Password = '$oldPassword'";
		$sql = mysql_query($query, $db);

		while ($row = mysql_fetch_array($sql)){
			// Only 1 instance of the summoner in the database if everything matches
			$success = "Found";
			$newPassword = verify($newPassword);
			$query = "UPDATE userprofile SET Password = '$newPassword' WHERE Summoner = '$summoner'";
			mysql_query($query, $db);
		}

		// Username and old password did not match
		if ($success == ""){
			$error = "Your old password is incorrect. Please go back to the password change page and try again.";
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
							<h1>Password Changed</h1>
						</div>
						<p class="lead">Your password has been changed. Thank you for completing this.</p>
						<p>You will be redirected back to the Account Management page in 5 seconds.</p>';}
					else
					{
						echo '<div class="page-header">
							<h1>Password Change Failed</h1>
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
