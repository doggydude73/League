<?php
    include '../Layout.php';
	include '../databaseConnection.php';

	$db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("League", $db);

    if ($_SESSION['role'] != "EBoard" && $_SESSION['role'] != "SuperAdministrator"){
        header("Location: ../mainPage.php");
    }

    $personalRank = inRole();
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
                <h1 style="text-align: center;">Promote a User</h1>
            </div>
            <form class="form-horizontal" method="post" autocomplete="off" action="promoteUser.php">
                <fieldset>
                     <!--Below is the code for putting the available games as check boxes-->
                    <div class="control-group">
                    <label class="control-label">Registered Users </label>
                        <div class="controls">
                            <select name="people" id="people" style="width: 300px;">
                            <?php
                                // TODO Consider adding color coding to the list based on ranks to sift through people faster
                                $person = "";
                                $query = "SELECT * FROM userprofile ORDER BY Role ASC";
                                $sql = mysql_query($query, $db);
                                while($row = mysql_fetch_array($sql))
                                {
                                    $currRank = $row['Role'];
                                    $user = $row['LoginId'];
                                    $person = $row['Summoner'];

                                    // If the user is a greater rank than the person they are attempting to promote,
                                    //     administators are not attacking each other, True Admin has ultimate rights, and you are not promoting yourself
                                    if ($currRank != "SuperAdministrator"){
                                        echo '<option value = '.$user.'>'.$person.' - '.$currRank.'</option>';
                                    }
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
