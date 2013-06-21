<?php
    include '../Layout.php';
    include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("League", $db);

    $query = "SELECT * FROM teamalignment ORDER BY TeamName ASC";
    $sql = mysql_query($query,$db);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Das Lowen Haus</title>
        <link href="~/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    </head>
    <body>
        <?php include '../navBar.php'; ?>
        <div style="margin-top: 100px;" class="container">
            <div class="well well-large" id="brackets">
                <!-- Header Information and Sub Nav-Bar -->
                <div class="page-header">
                    <h1 id="header">League of Legends Club</h1>
                    <h2>Live Tournament Bracket</h2>
                    <div class="navbar">
                        <div class="navbar-inner">
                            <ul class="nav" style="width: auto;">
                                <li><a href="LeagueSignUp.php">Rules and Registration</a></li>
                                <li><a href="viewTeams.php">Team Composition</a></li>
                                <li><a href="displayBracket.php">Live Brackets</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Content for handling wins-->
                <form class="form-horizontal" method="post" autocomplete="off" action="updateBracket.php" enctype="multipart/form-data" >
                <fieldset>

                    <div class="control-group">
                        <label class="control-label">Team Name</label>
                        <div class="controls">
                            <select name="teams">
                                <?php
                                    while ($row = mysql_fetch_array($sql)){
                                        echo '<option value = "'.$row['TeamName'].'">';
                                        echo $row['TeamName'];
                                        echo '</option>';
                                    }                                
    
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Game Results</label>
                        <div class="controls">
                            <select name="results">
                                <option value="winner">Winner</option>
                                <option value="loser">Loser</option>
                            </select>
                        </div>
                    </div>

					<div class="control-group">
						<label class="control-label">Screen Capture</label>
						<div class="controls">
							<input type="file" name="screenCapture" id="screenCapture">	 
						</div>
					</div>

                    <!-- Waiver for University-->
                    <p style="margin: 25px 30px 0px 30px">Before checking this box, please verify the team name you have selected is your own name and that your status (winning or losing) is correct. If all of the information is correct, please check the box and proceed.</p>
                    <div class="control-group">
                        <div class="controls">
                            <input style="margin: 0 0 -5px -150px" type="checkbox" name="waiver" id="waiver" required/>
                        </div>     
                    </div>

                   <button style="margin-left:  30px;" class="btn btn-primary btn-large">Submit</button>
                </fieldset>
                </form> 
            </div>
        </div>
    </body>
</html>
