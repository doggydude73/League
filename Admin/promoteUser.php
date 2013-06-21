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
        <div style="margin-top:  50px;" class="container">
            <?php
                $select = $_POST['people'];
                $person = "";
                $currRank;
                $query = "SELECT * FROM userprofile ORDER BY Role ASC";
                $sql = mysql_query($query, $db);
                while($row = mysql_fetch_array($sql))
                {
                    $user = $row['LoginId'];
                    if ($select == $user){
                        $person = $row['Summoner'];
                        $currRank = $row['Role'];
                        break;
                    }
                }
                $_SESSION['usernameSelect'] = $select;
                echo '<div class="page-header"><h1>Promote: '.$person.'</h1></div>';
                echo '<h2>Current Rank: '.$currRank.'</h2>';
                echo '<p class="lead">The person above has been selected to be promoted. Which rank would you like this user to be promoted to?</p>';
                $_SESSION['test'] = "";
            ?>
            <form method="post" autocomplete="off" action="../Functions/promote.php">
                <fieldset>
                        <div class="btn-group" style="margin-left: 25px;">
                            <!--Below is the code for putting the available games as check boxes-->
                            <button name="rank" value="New" class="btn btn-large btn-inverse span3">New</button>
                            <button name="rank" value="User" class="btn btn-large btn-primary span3">User</button>
                            <button class="btn btn-large btn-warning span3" name="rank" value="EBoard">E-Board Member</button>
                            <button class="btn btn-large btn-danger span3" name="rank" value="Same">Same</button>
                        </div>
                </fieldset>
            </form>
        </div>
        <div class="background"></div>
    </body>
</html>
