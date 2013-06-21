<?php
	include '../Layout.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
         <?php include '../navBar.php'; ?>

        <div style="margin-top: 100px;" class="container">
            <div class="well well-large" id="content">
				<div class="page-header">
					<h1>Change Team Name <small>- <?php echo $_SESSION['entry'][1]?></small></h1>
				</div>
				<p class="lead">What would you like to change your team name to?</p>

				<form class="form-horizontal" method="post" autocomplete="off" action="updateTeamName.php">
                <fieldset>

                    <div class="control-group">
                        <label class="control-label">Suggested Team Name</label>
                        <div class="controls">
                            <?php echo '<input type="text" name="team" id="team" placeholder="'.$_SESSION['entry'][1].'" required/> '; ?>
                        </div>
					</div>

                   <button style="margin-left:  30px;" class="btn btn-primary btn-large">Submit</button>
					
                </fieldset>
					
                </form>
				<button style="margin-left:  30px;" class="btn btn-primary btn-large" onclick="returnHome()">Cancel</button>
				
			</div>
		</div>
    </body>
</html>

<?php
	echo ' <script> function returnHome(){';
	// Check to see where to redirect
	if ($_SESSION['entry'][0] == "ARAM")
		echo 'window.location = "Solo.php";';
	else
		echo 'window.location = "Team.php";';

	echo '	} </script>';
	
?>
