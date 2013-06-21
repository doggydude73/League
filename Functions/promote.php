<?php
    include '../Layout.php';

    $db = mysql_connect("localhost","rw","read");
    mysql_select_db("League", $db);

    $username = $_SESSION['usernameSelect'];
	$username = verify($username);
    $newRank = "";
    $_SESSION['usernameSelect'] = "";

    switch ($_POST['rank']){
        case 'New':
            $newRank = "New";
            break;

        case 'User':
            $newRank = "User";
            break;

        case 'EBoard':
            $newRank = "EBoard";
            break;

        default:
            break;
    }
    
    if ($newRank != ""){
        $query = "UPDATE userprofile SET Role = '".$newRank."' WHERE LoginId = '".$username."'";
        mysql_query($query,$db);
    }
    
    header("Location: ../mainPage.php");
?>