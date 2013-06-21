<?php
	include '../Layout.php';
    include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("League", $db);

    // Delete the old copy of the brackets
    $query  = "DELETE FROM bracketstorage";
    mysql_query($query, $db);

    // Query out the list of teams 
    $teams = array();
    $numTeams = 0;
    $query = "SELECT * FROM teamalignment";
    $sql = mysql_query($query, $db);

    // Add all the teams into the teams array
    while($row = mysql_fetch_array($sql))
    {
        $teams[$numTeams] = $row['TeamName'];
        $numTeams ++;
    }
 
    
    if ($numPlayers < 20 || $numPlayers > 320){
        $errorMessage = "There are not enough players to complete a bracket.";
    }
    
    $upperPower = ceil(log($numTeams) / log(2));

    // Find out a number that is a power of 2 and higher than numPlayers
    $countNodesUpperBound = pow(2,$upperPower);

    // Find out a number that is a power of 2 and lower than numPlayers
    $countNodesLowerBound = $countNodesUpperBound / 2;

    // This is the number of nodes that will receive a bye for the first round
    $countNodesHidden = $numTeams - $countNodesLowerBound;

    // Calculate the total number of columns and rows
    $numberRows = pow(2,$upperPower+1) - 1;
    $numberColumns = $upperPower * 2 + 1;

    // Create an array to hold all of the information to be put into the table 
    $table = array();
    for ($i = 0; $i < $numberRows; $i++){
        $table[$i] =  array();
    }

    // Populate the entire set of arrays with blankspace
    for ($i = 0; $i < $numberRows; $i++){
        for ($j = 0; $j < $numberColumns; $j++){
            $table[$i][$j] = "";
        }
    }

    // Populate the teams into the bracket
    for ($i = 0; $i < $countNodesLowerBound; $i++){
        if ($i < $countNodesHidden){
            // Team will be seeded into the first round
            $rowSelect = $i * 4; // Row number
            $colSelect = 0;

            // Get a team out of the list and set to the home position
            $rand = ceil(rand(0, $numTeams));
            $table [$rowSelect][$colSelect] = array_splice($teams, $rand-1, 1)[0];
            $numTeams --;

            // Get a team out of the list and set to the away position
            $rand = ceil(rand(0, $numTeams));
            $table [$rowSelect + 2][$colSelect] = array_splice($teams, $rand-1, 1)[0];
            $numTeams --;

            // Set the connecting pieces
            for ($j = 0; $j < 3; $j ++){
                $table[$rowSelect + $j][$colSelect + 1] = "connect";
            }

            // Set the advancement slot
            $table [$rowSelect + 1][$colSelect + 2] = " ";

        }else{
            // Team gets a free bye
            $rand = ceil(rand(0, $numTeams));
            $table [$i * 4 + 1][2] = array_splice($teams, $rand-1, 1)[0];
            $numTeams --;
        }
    }

    // Fill in the rest of the bracket
   $upperPower--;
   for ($i = 0; $i < $upperPower; $i++){
       $pow1 = pow(2, $i + 1);
       $pow2 = pow(2, $i + 2);
       $pow3 = pow(2, $i + 3);

       for ($j = 0; $j < pow(2, $upperPower - $i - 1); $j++){
           // Advancement placer
           $table[($j * $pow3) + $pow2 - 1][$i * 2 + 4] = " ";
           // Connecter pieces
           for ($k = 0; $k < $pow2 + 1; $k++){
               $table[($j * $pow3) + $pow1 - 1 + $k][$i * 2 + 3] = "connect";
           }
       } 
   }

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
   header("Location: displayBracket.php");
?>

