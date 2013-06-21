<?php
	include '../Layout.php';
	if (inRole() == 0){
		header("Location: ../mainPage.php");
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
        <div style="margin-top:  100px;" class="container"> 
               
			<div class="well well-large"> 
				<div class="page-header">
					<h1>Account Management <small>- <?php echo $_SESSION['summoner'];?></small></h1>
				</div>

				<!-- Holds the tournament Eligibility-->
				<table class="table table-bordered centerT" style="width: 75%">
					<caption style="font-size: 14pt;"><b>Tournament Eligibility</b></caption>
					<tbody>
						<?php
							if ($_SESSION['ban']['0'] == "No"){
								echo '<tr class="success">
										<td style="text-align: center; font-size: 14pt">Ready to Play!</td>
									  </tr>';
							}else{
								$release = strtotime($_SESSION['ban'][2]);
								$release = date("F dS Y", $release);
								echo '<tr class="error">
										<td style="width: 30%; text-align: center">Currently Banned</td>
										<td style="width: 40%">Reason:'.$_SESSION['ban'][1].'</td>
										<td style="width: 30%">Suspension Lift: '.$release.'</td>
									  </tr>';
							}

						?>
						
					</tbody>
				</table>
				<br>

				<!-- Holds the overall record of the player with the club over their tenure (Includes Big and Small Tournaments) -->
				<table class="table table-bordered">
					<caption style="font-size: 14pt;"><b>Overall Club Record</b></caption>
					<thead>
						<tr>
							<td style="text-align: center; width: 34%"><b>Wins</b></td>
							<td style="text-align: center; width: 33%"><b>Loss</b></td>
							<td style="text-align: center; width: 33%"><b>Forfeits</b></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="background-color: #dff0d8; text-align: center"><?php echo $_SESSION['overall'][0]; ?></td>
							<td style="background-color: #f2dede; text-align: center"><?php echo $_SESSION['overall'][1]; ?></td>
							<td style="background-color: #fcf8e3; text-align: center"><?php echo $_SESSION['overall'][2]; ?></td>
						</tr>
					</tbody>
				</table>
				<br>

				<!-- Holds the current record for the current MTU LCS Season-->
				<table class="table table-bordered" >
					<caption style="font-size: 14pt;"><b>Fall LCS Current Stats</b></caption>
					<thead>
						<tr>
							<td style="text-align: center; width: 34%"><b>Wins</b></td>
							<td style="text-align: center; width: 33%"><b>Loss</b></td>
							<td style="text-align: center; width: 33%"><b>Forfeits</b></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="background-color: #dff0d8; text-align: center"><?php echo $_SESSION['lcs'][1]; ?></td>
							<td style="background-color: #f2dede; text-align: center"><?php echo $_SESSION['lcs'][2]; ?></td>
							<td style="background-color: #fcf8e3; text-align: center"><?php echo $_SESSION['lcs'][3]; ?></td>
						</tr>
					</tbody>	   
				</table>
				<br>

				<!-- Holds the data for the registered tournaments IE: What teams this person belongs to-->
				<table class="table table-bordered centerT" style="width: 50%;" >
					<caption style="font-size: 14pt"><b>Current Registered Teams</b></caption>
					<tbody>
						<tr>
							<td>Current MTU LCS Team</td>
							<td style="text-align: center"><?php echo $_SESSION['lcs'][0];?></td>
						</tr>
						<tr>
							<td style="width: 33%">Current ARAM Team</td>
							<td style="text-align: center"><?php 
								if ($_SESSION['solo'][0] == "None"){
									echo $_SESSION['solo'][0];
								}else{
									echo '<a href="Solo.php">'.$_SESSION['solo'][2].'</a>';
								}
								?>
							</td>
						</tr>
						<tr>
							<td>Current Premade Team</td>
							<td style="text-align: center"><?php 
								if ($_SESSION['team'][0] == "None"){
									echo $_SESSION['team'][0];
								}else{
									echo '<a href="Team.php">'.$_SESSION['team'][1].'</a>';
								}
							?></td>
						</tr>
					</tbody>
				</table>

				<br>

				<!-- Account actions the user can take in regards to his account-->
				<div class="page-header">
					<h2 style="text-align: center">Account Actions</h2>
				</div>
				<a href="changePassword.php" class="btn btn-block btn-primary centerT" style="font-size: 20px; padding: 10px; width: 30%">Change Password</a>
				<a href="changeSummoner.php" class="btn btn-block btn-info centerT" style="font-size: 20px; padding: 10px; width: 30%">Change Summoner</a>
				<a href="changeEmail.php" class="btn btn-block btn-inverse centerT" style="font-size: 20px; padding: 10px; width: 30%">Change Email Address</a>
				<a href="../Functions/refreshUserData.php" class="btn btn-block btn-success centerT" style="font-size: 20px; padding: 10px; width: 30%">Refresh Data</a>
				
			</div>
        </div>
    </body>
</html>
