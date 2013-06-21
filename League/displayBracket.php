<?php
    include '../Layout.php';
    include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("League", $db);

    $query = "SELECT * FROM bracketstorage";
    $sql = mysql_query($query,$db);
    $numberColumns = 13;
    $numberRows = 0;
    $numberTeams = 0;

    // Find out the number of rows
    while ($row = mysql_fetch_array($sql)){
        $numberRows ++;
    }

    // Create a table array
    $table = array();
    for ($i = 0; $i < $numberRows; $i++){
        $table[$i] = array();
        for ($j = 0; $j < $numberColumns; $j++){
            $table[$i][$j] = "";
        }
    }

    //Populate the table array with the correct information
    $j = 0;
    $sql = mysql_query($query,$db);
    while($row = mysql_fetch_array($sql))
    {
        for ($i = 0; $i < 13; $i++){
            if ($row["Col".$i] != ""){
                $table[$j][$i] = $row["Col".$i];
                // Check for team count
                if ($row["Col".$i] != "connect" && $row["Col".$i] != "winner" && $row["Col".$i] != "loser"){
                    $numberTeams ++;
                }
            }
        }
        $j++;
    }

    // Calculate the actual number of columns for the table
    $upperPower = ceil(log($numberTeams) / log(2));
    $numberColumns = $upperPower * 2 - 1;
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Das Lowen Haus</title>
        <link href="~/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    </head>
    <body onload="Javascript: timedRefresh(120000);">
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
                                <li><a href="Report.php">Record Winning</a></li>
                            </ul>
                        </div>
                    </div>
					<p><b>Home Team (Blue): Top</b></p>
					<p><b>Away Team (Purple): Bottom</b></p>
                </div>
				
                <?php
                    echo'<table class="table table-bordered table-hover" id="bracket"> <tbody>';
                    for ($i = 0; $i < $numberRows; $i++){
                        echo '<tr>';
                        for($j = 0; $j < $numberColumns; $j++ ){
                            if ($table[$i][$j] == "connect"){
                                echo'<td class="info">';
                                echo'</td>';
                            }
                            elseif ($table[$i][$j] == "winner"){
                                echo'<td class="success">';
                                echo'</td>';
                            }
                            elseif ($table[$i][$j] == "loser"){
                                echo'<td class="error">';
                                echo'</td>';
                            }
                            else if($table[$i][$j] != ""){
                                echo'<td class="warning">';
                                echo $table[$i][$j];
                                echo'</td>';
                            }
                            else{
                                echo'<td>';
                                echo'</td>';
                            }
                        }
                        echo '</tr>';
                    }
                    echo'</tbody> </table>';
                ?>
            </div>
        </div>
    </body>
</html>

<script>
	function timedRefresh(timeoutPeriod)
	{
		setTimeout("location.reload(true);", timeoutPeriod);
	}
</script>
