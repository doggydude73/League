<?php
	include '../Layout.php';
	include '../databaseConnection.php';

	$db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("League", $db);

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
        <div style="margin-top:  50px; width: 500px;" class="container">
            <div class="page-header">
                <h1 style="text-align: center;">Show a Team Paid</h1>
            </div>
            <form class="form-horizontal" method="post" autocomplete="off" action="updatePaid.php">
                <fieldset>
                    <div class="control-group">
                    <label class="control-label">Registered Teams </label>
                        <div class="controls">
                            <select name="teams" id="teams" style="width: 300px;">
                            <?php
                                $person = "";
                                $query = "SELECT * FROM premade ORDER BY TeamName ASC";
                                $sql = mysql_query($query, $db);
                                while($row = mysql_fetch_array($sql))
                                {
                                    $paid = $row['Paid'];
                                    $team = $row['TeamName'];

                                    echo '<option value = "'.$team.'">'.$team.' - '.$paid.'</option>';
                                }
                            ?>
                            </select>
                        </div>   
                    </div>
                    <button class="btn btn-block btn-primary" style="padding: 10px 0 10px 0" name ="submit" value="Submit">Submit</button>    
                </fieldset>
            </form>
        </div>
        <div class="background"></div>
    </body>
</html>
