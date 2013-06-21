<?php
    /*********** Build the bracket *************/
    include '../Layout.php';
    include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("League", $db);
    $error = 0;

    $query = "SELECT * FROM bracketstorage";
    $sql = mysql_query($query,$db);
    $numberColumns = 13;
    $numberRows = 0;
    $numberTeams = 0;
	$winningTeam = "";
	$losingTeam = "";

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

    /************* Find the team and their current place in the bracket *************/
    $team = $_POST['teams'];
    $firstI = -1;
    $firstJ = -1;
    $finalI = -1;
    $finalJ = -1;

    // Find the preliminary location
    for ($i = 0; $i < $numberColumns; $i ++){
        for ($j = 0; $j < $numberRows; $j ++){
            // Search by row first at the left side and work right looking for the team's entry. I and J are reversed for this case
            if ($table[$j][$i] == $team){
                $firstI = $j;
                $firstJ = $i;
                break;
            }
        }
        // Case breaker for outer
        if ($firstI != -1){ 
            $finalI = $firstI; 
            $finalJ = $firstJ; 
            break;
        }
    }

    $moveUp = 0;
    $firstPass = 1;
    // Find where the team's farthest location in the tournament
    while ($table[$finalI][$finalJ + 1] != "connect"){
        
        // Someone is trying to alter their status as loser or the bracket is completed
        if($table[$finalI][$finalJ + 1] == "loser" || $finalJ + 1 == $numberColumns){
            //header ("Location: displayBracket.php");
            $error = 1;
        } 

        // Increment finalJ into the next column
        $finalJ ++;
        // Determine whether to move down (or up) the column
        if ($finalI != 0 && ($table[$finalI-1][$finalJ] == "winner") && $firstPass == 1){
            $moveUp = 1;
            $firstPass = 0;
        }else{
            $firstPass = 0;
        }

        //Move to the next advancement slot
        while ($table[$finalI][$finalJ + 1] == ""){
            if ($moveUp ==1){
                $finalI --;
            }else{
                $finalI ++;
            }
        }

        // Move into the next advancement slot
        $finalJ ++;
        // Going around again so reset first round
        $firstPass = 1;
        $moveUp = 0;
    }
    // The pointer sits at the edge of the bracket where the selected team has advanced

    // Repeat the process once more to move the pointer into their advancement 
    $finalJ ++;
    // Determine whether to move down (or up) the column
    if ($finalI != 0 && $table[$finalI - 1][$finalJ] == "connect" && $firstPass == 1){
        $moveUp = 1;
        $firstPass = 0;
    }else{
        $firstPass = 0;
    }

    //Move to the next advancement slot
    while ($table[$finalI][$finalJ + 1] == ""){
        if ($moveUp ==1){
            $finalI --;
        }else{
            $finalI ++;
        }
    }

    // Move into the next advancement slot
    $finalJ ++;

    /************** Apply the winner and loser status to the charts ************/
    $result = $_POST['results'];

    // Get Smart: Turning moveup from a boolean into arethmatic modifier
    if ($moveUp == 1){ $moveUp = 1; } else { $moveUp = -1; }

    $tempI = $finalI;
    if ($result == "winner"){
        // Team input they won the game
        $table[$finalI][$finalJ] = $team;

		// Set the winningTeam Variable to the input team
		$winningTeam = $team;
        
        // Move back a column into the advancement line to color it 
        $finalJ --;
        $table[$tempI][$finalJ] = "winner";

        // Set the winner trail
        while ($tempI + $moveUp >= 0 && $table[$tempI + $moveUp][$finalJ] != ""){
            $tempI = $tempI + $moveUp;
            $table[$tempI][$finalJ] = "winner";
        }
        // Check to make sure winner declared has advanced to this point
        if ($table[$tempI][$finalJ - 1] != $team){
            //header ("Location: displayBracket.php");
            $error = 1;
        }

        // Set the loser trail
        $tempI = $finalI -  $moveUp;
        $table[$tempI][$finalJ] = "loser";
        while ($tempI - $moveUp >= 0 && $table[$tempI - $moveUp][$finalJ] != ""){
            $tempI = $tempI - $moveUp;
            $table[$tempI][$finalJ] = "loser";
        }
        // Check to make sure the winner isnt trying to win against an undeclared opponent
        if ($table[$tempI][$finalJ - 1] == " "){
            //header ("Location: displayBracket.php");
            $error =1;
        }else{
        	$losingTeam = $table[$tempI][$finalJ - 1];
        }

    }else{
        // Team input was the losing team
        // Move back a column into the advancement line to color it 
        $finalJ --;
        $tempI = $finalI + $moveUp;
        $table[$tempI][$finalJ] = "loser";

		// Set the losing team
		$losingTeam = $team;

        // Set the loser trail
        while ($tempI + $moveUp >= 0 && $table[$tempI + $moveUp][$finalJ] != ""){
            $tempI = $tempI + $moveUp;
            $table[$tempI][$finalJ] = "loser";
        }
        // Check to make sure the loser isnt trying to win against an undeclared opponent
        if ($table[$tempI][$finalJ - 1] != $team){
            //header ("Location: displayBracket.php");
            $error = 1;
        }

        // Set the winner trail
        $tempI = $finalI;
        $table[$tempI][$finalJ] = "winner";
        while ($tempI - $moveUp >= 0 && $table[$tempI - $moveUp][$finalJ] != ""){
            $tempI = $tempI - $moveUp;
            $table[$tempI][$finalJ] = "winner";
        }

        // Get the winning team and set them at the advancement slot
        $team = $table[$tempI][$finalJ - 1];
        $table[$finalI][$finalJ+1] = $team; 
        // Check to verify the one team isnt advancing prematurely
        if ($team == " "){
            //header ("Location: displayBracket.php");
            $error = 1;
        }else{
        	$winningTeam = $team;
        }
    }

	/*********************** Verify the Picture *********************************/
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$test = $_FILES["screenCapture"]["name"];

	$extension = end(explode(".", "$test"));
	if ((($_FILES["screenCapture"]["type"] == "image/gif") || ($_FILES["screenCapture"]["type"] == "image/jpeg") || ($_FILES["screenCapture"]["type"] == "image/jpg") || ($_FILES["screenCapture"]["type"] == "image/pjpeg") || ($_FILES["screenCapture"]["type"] == "image/x-png") || ($_FILES["screenCapture"]["type"] == "image/png")) && ($_FILES["screenCapture"]["size"] < 5000000) && in_array(strtolower($extension), $allowedExts))
	{
		if ($_FILES["screenCapture"]["error"] > 0)
		{
			echo "Error: " . $_FILES["screenCapture"]["error"] . "<br>";
			$error = 1;
		}
		else
		{
			echo "Upload: " . $_FILES["screenCapture"]["name"] . "<br>";
			echo "Type: " . $_FILES["screenCapture"]["type"] . "<br>";
			echo "Size: " . ($_FILES["screenCapture"]["size"] / 1024) . " kB<br>";

			if (file_exists("../submittedResults/" . $winningTeam . " VERSUS " . $losingTeam . "." . $extension))
			{
				echo $_FILES["screenCapture"]["name"] . " already exists. ";
				$error = 1;
			}
			else if ($error == 0)
			{
				move_uploaded_file($_FILES["screenCapture"]["tmp_name"],
				"../submittedResults/" . $winningTeam . " VERSUS " . $losingTeam . "." . $extension );
				echo "Stored as: " . "../submittedResults/" . $winningTeam . " Versus " . $losingTeam . ".jpg";
			}
		}
	}
	else
	{
		echo "Invalid file";
	}

    /*********************** Write Back to the Database *************************/
    // Check for error
    if ($error == 0){
        // No error
        // Delete the old copy of the brackets
        $query  = "DELETE FROM bracketstorage";
        mysql_query($query, $db);

        // Insert the table data into the sql table for storage
        for ($i = 0; $i < $numberRows; $i++){
			$colInsert = "";
			$colValues = "";
			for ($j = 0; $j < $numberColumns; $j++){
				if ($table[$i][$j] != ""){
					// Insert into the sql table the data
					if ($colInsert == ""){
						$colInsert = "Col".$j;
						$colValues = "'".verify($table[$i][$j])."'";
					}else{
						$colInsert = $colInsert.", Col".$j;
						$colValues = $colValues.", '".verify($table[$i][$j])."'";
					}
				}
           
			}
			$query = "INSERT INTO bracketstorage (".$colInsert.") VALUES (".$colValues.")";
			mysql_query($query,$db);
		}

		// Update the overall record of the team players in the club
		updateRecord($winningTeam, "Win", $db);
		updateRecord($losingTeam, "Loss", $db);

	}

    //header ("Location: displayBracket.php");
?>