<?php
    include '../Layout.php';
	include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    if (!$db){die('Could not connect to database');}

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
       
            <div class="container" style="text-align: center; margin-top: 100px;">
            
         <div style="width: 420px;" class="container well well-small">
            <?php
                $user;
                $password;
                $confirmPassword;
                $ErrorMessage = "";
                $rolePassword;
                $summoner;
                $email;

                if(isset($_POST['submit'])){
                    $user = $_POST['user'];
                    $user = verify($user);
                    $password = $_POST['password'];
                    $password = verify($password);
                    $confirmPassword =$_POST['confirmPassword'];
                    $confirmPassword = verify($confirmPassword);
                    $rolePassword = $_POST['rolePassword'];
                    $rolePassword = verify($rolePassword);
                    $email = $_POST['email'];
                    $email = verify($email);
                    $summoner = $_POST ['summoner'];
                    $summoner = verify($summoner);

                    if ($password != $confirmPassword){
                        $ErrorMessage = "Password and confirmation do not match.";
                        echo $ErrorMessage;}

                    // All of the information is valid.  Create a new account
                    if ($ErrorMessage == ""){
                        mysql_select_db("League", $db);
                        
                        // Confirm Role
                        if ($rolePassword == "EBoard"){$rolePassword = "EBoard";}                    
                        else {$rolePassword = "New";}

                        // Check to see if the user exists
                        $userLower = strtolower($user);
                        $sql = "SELECT * FROM userprofile WHERE LoginId = '$userLower'";
                        $result = tableQuery($sql, "LoginId", $userLower, $db);

						// If the user does no exist, insert into the database
                        if ($result == 0){
                            $sql = "INSERT INTO userprofile (LoginId, Summoner, Email, Password, Role) VALUES ('$userLower', '$summoner', '$email', '$password', '$rolePassword')";

							// If the query fails, output failed error message
                            if(mysql_query($sql, $db)){

								// Insert the user into the permanent record database and the lcs database
								$query = "INSERT INTO permarecord (summoner, banned) VALUES ('$summoner', 'No')";
								mysql_query($query,$db);
								
								$query = "INSERT INTO mtulcs (summoner, team) VALUES ('$summoner', 'None')";
								mysql_query($query,$db);

                                // Set up the user's session
                                $_SESSION['user'] = $userLower;
                                $_SESSION['role'] = $rolePassword;
                                $_SESSION['summoner'] = $summoner;
								$_SESSION['email'] = $email;

                                // Redirect to successful creation page
                                $website = "Location: SuccessfulCreation.php";
                                redirection($website);
                            }
                            else{
                                echo '<h1>Failed. Please contact Site Administrator</h1>';
                            }
                        }
                        else {echo '<h1>Username already exists </h1>';}
                    } 
                    
                }
            ?>
                
            <form class="form-horizontal" method="post" action="">
                <fieldset><legend>Registration Form</legend></fieldset><br>
                <div class="control-group">
                    <label class="control-label">Username</label>
                    <div class="controls">
                        <input type="text" id="user" name="user" required />
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Password</label>
                    <div class="controls">
                        <input type="password" id="password" name="password" required/>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Confirm Password</label>
                    <div class="controls">
                        <input type="password" id="confirmPassword" name="confirmPassword" required/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Summoner Name</label>
                    <div class="controls">
                        <input type="text" id="summoner" name="summoner" placeholder="Sandelina" required />
                    </div>
                </div>

                <div class="control-group">
                        <label class="control-label">MTU Email Address</label>
                        <div class="input-append">
                            <input class="span2" type="text" name="email" id="email" placeholder="mtuLeague" style="margin-left: -20px" required/>
                            <span class="add-on">@mtu.edu</span>
                        </div>
                    </div>


                <div class="control-group">
                    <label class="control-label">Role Password</label>
                    <div class="controls">
                        <input type="password" id="rolePassword" name="rolePassword" placeholder="Can Leave This Blank" />
                    </div>
                </div>
                <button name="submit" value="Submit" class="btn-block btn-primary btn-large">Submit</button>
            </form>
        </div>
        </div>
    </body>
</html>
