<?php
    include '../Layout.php';
	include '../Functions/EntryLogin.php';
	include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    if (!$db){die('Could not connect to database');}
    mysql_select_db("League", $db);

    function redirection($website){
        header($website);
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
           <div style="margin-top:  100px; width: 300px;" class="container"> 
               
            <div class="well well-large"> 
				<?php
					$user;
					$password;

					if(isset($_POST['submit'])){
						// Get the user and password and convert the username to lowercase.
						$user = $_POST['username'];
						$user = verify($user);
						$password = $_POST['password'];
						$password = verify($password);

						$userLower = strtolower($user);

						// Attempt a login and get the summonerName and email
						$sql = "SELECT * FROM userprofile WHERE LoginId = '$userLower'";
						$role = attemptLogin($sql, $password, $db);
						$summoner = getName($sql, $db);
						$query = "SELECT * FROM userprofile WHERE LoginId = '$userLower'";
						$email = getEmail($db, $userLower);

						// If the user was found
						if ($role != "0"){
							// Set the current session variable
							$_SESSION['email'] = $email;
							$_SESSION['role'] = $role;
							$_SESSION['summoner'] = $summoner;
							// Call aram and team store to see if the user currently belongs to any registered teams
							$summoner = verify($summoner);
							aramStore($db, $summoner);
							teamStore($db, $summoner);
							// Call the record store functions to get the current status of the user (Bans, overall, and current season)
							banStore($summoner, $db);
							overallStore($summoner, $db);
							lcsStore($summoner, $db);
							// Redirect to the successful login page
							redirection("Location: SuccessfulLogin.php");
						}else
						{
							// Attempt to log in the ARAM contestant
							if (aramLogin($db, $user, $password) == 1)
							{
								redirection("Location: ../Account/Solo.php");
							}
							// Attempt a log in to the teams
							else if(teamLogin($db, $user, $password) == 1)
							{
								redirection("Location: ../Account/Team.php");
							}
							// Else, the user does not exist
							echo '<h1>Failed to login.</h1> <p style ="color: #f00"><b> Please check your username and password </b><br><br></p>';
						}
					}
				?>
          
              
				<form method="post" action="" autocomplete="off">
					<fieldset>
						<legend>Log In to Your Account</legend> 
						<br>  
								<label>Username/Team Name</label>
								<input type="text" id="username" name="username" required/>
                            
								<br><br>

								<label>Password</label>
								<input type="password" id="password" name="password" required/>
                           
								<br><br>

								<button type="submit" name="submit" value="Login" class="btn btn-large">Sign In</button></button>
					</fieldset>
				</form> 
				<p> Please note: For ARAMS, use your summoner name.  For premade 5's use your team name.</p>
            </div>   
        </div>
    </body>
</html>
