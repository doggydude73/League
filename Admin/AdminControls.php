<?php
    include '../Layout.php';
    if ($_SESSION['role'] != "EBoard" && $_SESSION['role'] != "SuperAdministrator"){
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
                    <h1>Administrator Controls</h1>
                </div>

                <p class="lead">What would you like to do Mr. Administrator?</p>


				<div class="dropdown">
					<a class="btn dropdown-toggle btn-primary btn-large" data-toggle="dropdown" href="#">
						Site Management
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="addAnnouncement.php">Add an Announcement</a></li>
						<li><a href="selectUser.php">Promote a User</a></li>
						<li><a href="teamPay.php">Report a Team Paid</a></li>
						<li><a href="ApplyBan.php">Apply a Tournament Ban</a></li>
						<li><a href="LiftBan.php">Lift a Tournament Ban</a></li>
					</ul>
				</div>

                <br>

				<div class="dropdown">
					<a class="btn dropdown-toggle btn-inverse btn-large" data-toggle="dropdown" href="#">
						Create Brackets
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a onclick ="verify(4)">Create Premade Bracket</a></li>
						<li><a onclick ="verify(1)">Create the ARAM Brackets</a></li>
					</ul>
				</div>

				<br>

				<div class="dropdown">
					<a class="btn dropdown-toggle btn-warning btn-large" data-toggle="dropdown"	href="#">
						Mumble Services
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a onclick="verify(6)">Start the Server</a></li>
						<li><a onclick="verify(7)">Restart the Server</a></li>
						<li><a onclick="verify(8)">Stop the Server</a></li>
					</ul>
				</div>

				<br>

				<div class="dropdown">
					<a class="btn dropdown-toggle btn-danger btn-large" data-toggle="dropdown" href="#">
						Clear Databases
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a onclick ="verify(2)">Delete Premade Registration</a></li>
						<li><a onclick ="verify(3)">Delete ARAM Registration</a></li>
						<li><a onclick ="verify(5)">Delete the Brackets</a></li>
					</ul>
				</div>
            </div>
        </div>
        <div class="background"></div>
    </body>
</html>

<script>
	/*  
	Function displays the correct confirm bracket and relocater for the given button
	*/
	function verify(location)
	{
		// 1 - Create the teams and bracket 
		if (location == 1)
		{
			var r = confirm("Create the teams/bracket? Please note any old teams and brackets will be overrode if the process has already been completed.");
			if (r == true)
			{
				window.location = "../League/generateTeams.php";
			}
		} else if (location == 2)
		{
			// 2 - Delete the premade registration database
			var r = confirm("Delete the premade registration?  After this has been completed, there is no recovery.");
			if (r == true)
			{
				window.location = "../Functions/deletePremade.php";
			}
		} else if (location == 3)
		{
			// 3 - Delete the ARAM registration database
			var r = confirm("Delete the ARAM registration? After this has been completed, there is no recovery.");
			if (r == true)
			{
				window.location = "../Functions/deleteAram.php";
			}
		} else if (location == 4)
		{
			// 4 - Move the Premade Teams and Generate the Bracket
			var r = confirm("Move the Premade Teams and Create the Brackets? Please note any old stored teams and brackets will be overrode if the process has already been completed.");
			if (r == true)
			{
				window.location = "../League/transferTeams.php";
			}
		} else if (location == 5)
		{
			// 5 - Delete the Tournament Brackets, Team Listings, and Mumble Server Channels
			var r = confirm("Delete the brackets, listings, and mumble channels?");
			if (r == true)
			{
				window.location = "../Functions/deleteBrackets.php";
			}
		}else if (location == 6)
		{
			// 6 - Start the Murmur Server provided it is down
			var r = confirm("Would you like to start Murmur? If the server is already up, it will not restart.");
			if (r == true)
			{
				window.location = "../Functions/startMurmur.php";
			}
		}else if (location == 7)
		{
			// 7 - Restart the Murmur Server if it is Up
			var r = confirm("Would you like to restart Murmur? Please note you will disconnect all currently connected users.");
			if (r == true)
			{
				window.location = "../Functions/restartMurmur.php";
			}
		}else if (location == 8)
		{
			// 8 - Delete the Tournament Brackets, Team Listings, and Mumble Server Channels
			var r = confirm("Would you like to shut down Murmur? Please note you will disconnect anyone current connected.");
			if (r == true)
			{
				window.location = "../Functions/stopMurmur.php";
			}
		}
	}

	$('.dropdown-toggle').dropdown();
</script>