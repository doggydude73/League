<?php
	include '../Layout.php';
	if (isset($_SESSION['solo'])){
		$_SESSION['entry'] = $_SESSION['solo'];
	}

	if ($_SESSION['entry'][0] == "None"){
		header("Location: ../Registration/Login.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <?php include '../navBar.php'; ?>

        <div style="margin-top: 100px;" class="container">
            <div class="well well-large" id="content">
				<div class="page-header">
					<h1>Account Management <small>- <?php echo $_SESSION['entry'][1]?></small></h1>
				</div>
				<p class="lead">Weclome to the account management page.  You are currently registered for the next ARAM Tournament.  What would you like to do?</p>

				<br>

				<a href="changeName.php" class="btn btn-block btn-primary centerT" style="font-size: 20px; padding: 10px; width: 30%">Change Team Name</a>
				<a onclick="myFunction()" class="btn btn-block btn-inverse centerT" style="font-size: 20px; padding: 10px; width: 30%">Withdraw from Tournament</a>
				
			</div>
		</div>
    </body>
</html>

<script>
	function myFunction()
	{
		var r = confirm("Are you sure you want to withdraw from the tournament?");
		if (r == true)
		{
			window.location = "Withdraw.php";
		}
	}
</script>