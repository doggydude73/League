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
            <div class="well well-large" id="announcements">
                <!-- Header Information and Sub Nav-Bar -->
                <div class="page-header">
                    <h1 id="header">League of Legends Club</h1>
                    <h2>ARAM Team Compositions</h2>
                    <div class="navbar">
                        <div class="navbar-inner">
                            <ul class="nav" style="width: auto;">
                                <li><a href="LeagueSignUp.php">Rules and Registration</a></li>
                                <li><a href="displayBracket.php">Live Brackets</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <ul>
                <!--Place content here-->
                <?php
                    $i = 0;
                    while ($row = mysql_fetch_array($sql)){
                        echo '<li>';
                        // Echo the team name
                        echo $row['TeamName'];
                        echo '<ul>';
                        echo '<li>'.$row['Captain'].'</li>';
                        for ($i = 2; $i < 6;$i++){
                            echo '<li>'.$row['Summoner'.$i].'</li>';
                        }
                        echo '</ul> </li>';
                    }

                ?>
                </ul>
            </div>
        </div>
    </body>
</html>
