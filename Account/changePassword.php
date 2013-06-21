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
					<h1>Change your password</h1>
				</div>

				<p class="lead">What would you like to update your password to?</p>

				<form class="form-horizontal" method="post" autocomplete="off" action="updatePassword.php">
                <fieldset>

                    <div class="control-group">
                        <label class="control-label">Current Password: </label>
                        <div class="controls">
                            <input type="password" name="current" id="current" required/>
                        </div>
					</div>

					<div class="control-group">
                        <label class="control-label">New Password: </label>
                        <div class="controls">
                            <input type="password" name="newPass" id="newPass" required/>
                        </div>
					</div>

					<div class="control-group">
                        <label class="control-label">Confirm Password: </label>
                        <div class="controls">
                            <input type="password" name="confirm" id="confirm" required/>
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

<script> 
	function returnHome(){
		window.location = "Users.php";
	}
</script>