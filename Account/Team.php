<?php
	include '../Layout.php';
	if (isset($_SESSION['team'])){
		// Transfer from the User's Page. Adjust the entry variable
		$_SESSION['entry'] = $_SESSION['team'];
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
				<p class="lead">Welcome to the account management page.  You are currently registered for the next MTU League of Legends Tournament.  What would you like to do?</p>

				<br>

				<p class="text-center"><b>Current Team Information:</b></p>
				<table class="table table-bordered">
					<tbody>
						<!-- Coloring of the row based on payment made -->
						<tr
						<?php
							if ($_SESSION['entry'][7] == "Yes"){
								echo 'class="success"';
							}else{
								echo 'class="error"';
							}
						?>
						>
						<!-- Team Name Column -->
						<td style="word-wrap: normal; width: 37%">Current Team Name:<br>
							&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $_SESSION['entry'][1];?></td>

						<!-- Team Listing -->
						<td style="width: 40%; word-wrap: normal;">
							<ul class="unstyled">
								<li>Captain: <?php echo $_SESSION['entry'][2];?></li>
								<li>Summoner 2: <?php echo $_SESSION['entry'][3];?></li>
								<li>Summoner 3: <?php echo $_SESSION['entry'][4];?></li>
								<li>Summoner 4: <?php echo $_SESSION['entry'][5];?></li>
								<li>Summoner 5: <?php echo $_SESSION['entry'][6];?></li>
							</ul>
						</td>
							
						<!-- Team Paid -->
						<td>Paid status: <?php echo $_SESSION['entry'][7];?> <i class="icon-ok"> </i></td>
						</tr>
					</tbody>
				</table>
				<br>

				<a href="changeName.php" class="btn btn-block btn-primary" style="font-size: 20px; padding: 10px;">Change Team Name</a>
				<a href="changeMembers.php" class="btn btn-block btn-info" style="font-size: 20px; padding: 10px;">Change Team Members</a>
				<a onclick="myFunction()" class="btn btn-block btn-inverse" style="font-size: 20px; padding: 10px;">Withdraw from Tournament</a>
				
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
