<?php
	include '../Layout.php';
    if ($_SESSION['role'] != "EBoard" && $_SESSION['role'] != "SuperAdministrator"){
        header("Location: ../mainPage.php");
    }else{
		include '../databaseConnection.php';

		$db = mysql_connect($connection,$dbUsername,$dbPassword);
		mysql_select_db("League", $db);

		$query = "SELECT summoner FROM permarecord WHERE banned = 'Yes'";
		$users = mysql_query($query, $db);
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body onload="updateBan()">
        <?php include '../navBar.php'; ?>
        <div style="margin-top:  100px;" class="container">
            <div class="well well-large">
                <div class="page-header">
                    <h1>Lift a Ban</h1>
                </div>
				<p class="lead">Select the person to lift a ban from.</p>
				
				<form autocomplete="off" class="form-horizontal">
					<fieldset>

						<div class="control-group">
							<label class="control-label">Currently Banned Users </label>
							<div class="controls">
								<select name="banned" id="banned" onchange="updateBan()">
									<?php
										while ($row = mysql_fetch_array($users)){
											echo '<option value='.$row['summoner'].'>'.$row['summoner'].'</option>';
										}
									?>
								</select>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Ban Lift Date</label>
							<div class="controls">
								<input type="text" name="lift" id="lift" disabled/>
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

	function updateBan()
	{
		// Get the summoner
		var summoner = document.getElementById("banned").value;

		// Process the AJAX request
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function ()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("lift").value = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "../Functions/getReleaseBanDate.php?summoner=" + summoner, true);
		xmlhttp.send();
	}

	// Function verifies the board member wishes to enact this ban
	function verify()
	{
		// Get data
		var selected = document.getElementById("banned").value;

		// Activate the confirmation box
		var con = confirm(selected + " has been selected to be release from their ban. Is this correct?");

		// If the user selects yes, reroute to submit ban page
		if (con == true)
		{
			document.location = "releaseBan.php?banned=" + selected;
		}
	}

</script>
