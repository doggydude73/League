<?php
	// Inclusions
	include '../Layout.php';
	include '../databaseConnection.php';

	// Connect to the league database
    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("League", $db);

	// Get the team selected
    $team = $_SESSION['teamSelect'];
	$team = verify($team);
    $newPaid = "";
    $_SESSION['teamSelect'] = "";

	// Set the newPaid variable to whether they ahve paid
    switch ($_POST['paid']){
        case 'No':
            $newPaid = "No";
            break;

        case 'Yes':
            $newPaid = "Yes";
            break;

        default:
            break;
    }
    
	// Update the database
    if ($newPaid != ""){
        $query = "UPDATE premade SET Paid = '".$newPaid."' WHERE TeamName = '".$team."'";
        mysql_query($query,$db);
    }
    
	// Return to the administrator team pay webpage
    header("Location: ../Admin/teamPay.php");
?>