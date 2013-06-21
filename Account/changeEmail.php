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
					<h1>Change Email</h1>
				</div>

				<p class="lead">What would you update your email address to?</p>

				<p>Current Email Address: <?php echo $_SESSION['email'];?>@mtu.edu</p>

				<form class="form-horizontal" method="post" autocomplete="off" action="updateEmail.php">
                <fieldset>

                    <div class="control-group">
                        <label class="control-label">Updated Email Address</label>
                        <div class="input-append">
                            <input class="span2" type="text" name="email" id="email" placeholder="mtuLeague" style="margin-left: 20px" required/>
                            <span class="add-on">@mtu.edu</span>
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