<?php
	include '../Layout.php';
    if ($_SESSION['role'] != "EBoard" && $_SESSION['role'] != "SuperAdministrator"){
        header("Location: ../mainPage.php");
    }else{
		// kill tasks matching
		$kill_pattern = '~(murmur)\.exe~i';

		// get tasklist
		$task_list = array();
		$found = FALSE;

		exec("tasklist 2>NUL", $task_list);

		foreach ($task_list AS $task_line)
		{
		  if (preg_match($kill_pattern, $task_line, $out))
		  {
			exec("taskkill /F /IM ".$out[1].".exe 2>NUL");
			$found = TRUE; 
		  }
		}
		exec("start murmur.lnk 2>NUL");
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body onload="Javascript: timedRefresh(6000);">
        <?php include '../navBar.php'; ?>

        <div style="margin-top: 100px;" class="container">
            <div class="well well-large" id="content">
				<?php
				if ($found == TRUE)
				{
					echo '<div class="page-header">
					
					<h1>Restarted Murmur</h1>
					
					</div>
					<p class="lead">The murmur server has been reloaded as requested.</p>
					<p>You will be redirected back to the Account Management page in 5 seconds.</p>';
				}else
				{
					echo '<div class="page-header">
					
					<h1>Failed Restart</h1>
					
					</div>
					<p class="lead">The murmur service was not found. No murmur will be loaded</p>
					<p>You will be redirected back to the Account Management page in 5 seconds.</p>';
				}
				?>
			</div>
		</div>
    </body>
</html>

<script>
	function timedRefresh(timeoutPeriod)
	{
		setTimeout("window.location = \"../Admin/AdminControls.php\";", timeoutPeriod);
	}
</script>
