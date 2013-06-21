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
					<h1>Change Summoner</h1>
				</div>

				<p class="lead">What would you like to update your summoner's name to?</p>
				<p>Current Summoner Name: <?php echo $_SESSION['summoner'];?></p>

				<form class="form-horizontal" method="post" autocomplete="off" action="updateSummoner.php">
                <fieldset>

                    <div class="control-group">
                        <label class="control-label">Updated Summoner Name</label>
                        <div class="controls">
                            <input type="text" name="newSummoner" id="newSummoner" required />
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
