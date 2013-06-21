<?php
    include '../Layout.php';
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
            <div class="well well-large" id="announcements">
                <div class="page-header">
                    <h1 id="header">League of Legends Club</h1>
                    <h2>Registration Successful</h2>
					<div class="navbar">
                        <div class="navbar-inner">
                            <ul class="nav" style="width: auto;">
								<li><a href="LeagueSignUp.php">League Sign-Up Page</a></li>
                                <li><a href="viewTeams.php">Team Composition</a></li>
                                <li><a href="displayBracket.php">Live Brackets</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="well well-large">
                <p class="lead">You are now registered for the next MTU League of Legends Tournament.</p>
				<p> Please check back 2-3 hours before to find your team you have been assigned to as well as the tournament bracket.</p>
                </div>
            </div>
        </div>
    </body>
</html>
