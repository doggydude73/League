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
                $select = $_POST['teams'];
                $paid = "";
                $query = "SELECT * FROM premade ORDER BY TeamName ASC";
                $sql = mysql_query($query, $db);
                while($row = mysql_fetch_array($sql))
                {
                    $team = $row['TeamName'];
                    if ($select == $team){
                        $paid= $row['Paid'];
                        break;
                    }
                }
                $_SESSION['teamSelect'] = $select;
                echo '<div class="page-header"><h1>Team: '.$select.'</h1></div>';
                echo '<h2>Payment Status: '.$paid.'</h2>';
                echo '<p class="lead">The team above has been selected. Have they paid their dues to be entered into the tournament?</p>';
            ?>
            <form method="post" autocomplete="off" action="../Functions/paid.php">
                <fieldset>
                    <div class="btn-group" style="margin-left: 00px;">
                        <!--Below is the code for putting the available games as check boxes-->
                        <button name="paid" value="No" class="btn btn-large btn-inverse span2">No</button>
                        <button name="paid" value="Yes" class="btn btn-large btn-primary span2">Yes</button>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="background"></div>
    </body>
</html>
