<?php
	include '../Layout.php';
	if ($_SESSION['entry'][0] == "None"){
		header("Location: ../Registration/Login.php");
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

        <div style="margin-top: 100px;" class="container">
            <div class="well well-large" id="content">
				<div class="page-header">
					<h1>Replace Team Member <small>- <?php echo $_SESSION['entry'][1]?></small></h1>
				</div>
				<p class="lead">Which member would you like to replace?</p>

				<form class="form-horizontal" method="post" autocomplete="off" action="updateMember.php">
                <fieldset>

                    <div class="control-group">
                        <label class="control-label">Position to fill</label>
                        <div class="controls">
                            <select name="position" id="position" style="width: 300px;" onchange="updateText()">
								<option value="2">Captain</option>
								<option value="3">Summoner 2</option>
								<option value="4">Summoner 3</option>
								<option value="5">Summoner 4</option>
								<option value="6">Summoner 5</option>
							</select>
                        </div>
                    </div>

					<div class="control-group">
						<label class="control-label">Current Summoner Name</label>
						<div class="controls">
							<input type="text" name="summoner" id="old" placeholder="Current Holder" disabled/>
						</div>	 
					</div>

					<div class="control-group">
                        <label class="control-label">New Summoner</label>
                        <div class="input-append">
                            <input class="span2" type="text" name="email" id="email" placeholder="ggu" style="margin-left: 20px" required/>
                            <span class="add-on">@mtu.edu</span>
                        </div>
                    </div>

					<div class="control-group">
                        <div class="controls">
                            <input type="text" name="summoner" id="summoner" placeholder="Flowski" required/>
                        </div>
                    </div>

                    <!-- Waiver for University-->
                    <p style="margin: 25px 30px 0px 30px"><b>I do hereby fully and forever release and discharge, covenant not to sue and agree to indemnify and hold harmless</b> Michigan Tech Dining Services, its representatives and staff, Michigan Technological University (MTU), its Board of Control, employees, and agents from and against any and all personal or bodily injury, death, property damage, claims, demands, damages or rights of action, present or future, whether the same be known or unknown, anticipated or unanticipated, resulting from or arising out of my participation in the program.</p>
                    <div class="control-group">
                        <div class="controls">
                            <input style="margin: 0 0 -5px -150px" type="checkbox" name="waiver" id="waiver" required/>
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
	echo '<script>

		function updateText()
		{
			var summoner = document.getElementById("old");
			var select = document.getElementById("position").value;
			// Captain
			if (select == 2){
				summoner.value = "';
				echo $_SESSION['entry'][2];
				echo '";
			}
			// Summoner 2
			if (select == 3){
				summoner.value = "';
				echo $_SESSION['entry'][3];
				echo '";
			}
			// Summoner 3
			if (select == 4){
				summoner.value = "';
				echo $_SESSION['entry'][4];
				echo '";
			}
			// Summoner 4
			if (select == 5){
				summoner.value = "';
				echo $_SESSION['entry'][5];
				echo '";
			}
			// Summoner 5
			if (select == 6){
				summoner.value = "';
				echo $_SESSION['entry'][6];
				echo '";
			}
		}

	</script>';
?>

<?php
	echo ' <script> function returnHome(){';
	// Check to see where to redirect
	if ($_SESSION['entry'][0] == "ARAM")
		echo 'window.location = "Solo.php";';
	else
		echo 'window.location = "Team.php";';

	echo '	} </script>';
	
?>