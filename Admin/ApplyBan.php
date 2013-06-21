<?php
	include '../Layout.php';
    if ($_SESSION['role'] != "EBoard" && $_SESSION['role'] != "SuperAdministrator"){
        header("Location: ../mainPage.php");
    }else{
		include '../databaseConnection.php';

		$db = mysql_connect($connection,$dbUsername,$dbPassword);
		mysql_select_db("League", $db);

		$query = "SELECT summoner FROM permarecord";
		$users = mysql_query($query, $db);

		$query = "SELECT summoner FROM userprofile WHERE Role IN ('EBoard', 'SuperAdministrator')";
		$Eboard = mysql_query($query, $db);
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
                    <h1>Apply a Ban</h1>
                </div>
				<p class="lead">Select the person to apply a ban to, the day which the ban is to be lifted, and the person who executed the ban.</p>
				
				<form autocomplete="off" class="form-horizontal">
					<fieldset>

						<div class="control-group">
							<label class="control-label">Registered Users </label>
							<div class="controls">
								<select name="banned" id="banned">
									<?php
										while ($row = mysql_fetch_array($users)){
											echo '<option value='.$row['summoner'].'>'.$row['summoner'].'</option>';
										}
									?>
								</select>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Banned Until (YYYY/MM/DD): </label>
							<div class="controls">
								<input type="date" name="until" id="until" required>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Ban Issuer </label>
							<div class="controls">
								<select name="executioner" id="executioner">
									<?php
										while ($row = mysql_fetch_array($Eboard)){
											echo '<option value='.$row['summoner'].'>'.$row['summoner'].'</option>';
										}
									?>
								</select>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Reasons for Ban</label>
							<div class="controls">
								<textarea name="reasons" id="reasons" style="max-width: 350px; width: 350px;" rows="4" placeholder="Reasons for the ban go here."></textarea>
							</div>
						</div>

						<div class="control-group">
							<a onclick="verify()" class="btn btn-block btn-primary" style="font-size: 20px; padding: 10px; width: 30%">Submit</a>
						</div>
					</fieldset>
				</form>

			</div>
		</div>
        
    </body>
</html>

<script>

	// Function verifies the board member wishes to enact the ban
	function verify()
	{
		// Get data
		var selected = document.getElementById("banned").value;
		var release = document.getElementById("until").value;
		var executioner = document.getElementById("executioner").value;
		var reason = document.getElementById("reasons").value;

		// Activate the confirmation box
		var con = confirm(selected + " has been selected to be banned until " + release + " by " + executioner + ". Is this correct?");

		// If the user selects yes, reroute to submit ban page
		if (con == true)
		{
			document.location = "submitBan.php?banned=" + selected + "&date=" + release + "&executioner=" + executioner + "&reasons=" + reason;
		}
	}

</script>
