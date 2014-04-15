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
			$found = TRUE;
			break;
		  }
		}

		// If the service wasnt found, start it up
		if ($found == FALSE)
		{
			exec("start murmur.lnk 2>NUL");
		}
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
				if ($found == FALSE)
				{
					echo '<div class="page-header">
					
					<h1>Started Murmur</h1>
					
					</div>
					<p class="lead">The murmur server has been started as requested.</p>
					<p>You will be redirected back to the Account Management page in 5 seconds.</p>';
				}else
				{
					echo '<div class="page-header">
					
					<h1>Failed Start</h1>
					
					</div>
					<p class="lead">The murmur is already in use.</p>
					<p>Please restart murmur or stop murmur and start it if desired.</p>
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
