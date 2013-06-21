<?php
	$to = "ajsuneso@mtu.edu";
	$subject = "Working Email";
	$message = "Hi buddy!  I finally got my email system working. It emails from my gmail box atm but I can change it to whatever email origination I want!  YAY!!!!! :D  Google knows all if you can ask it the right questions. Have a good day buddy!";
	$from = "MTU League Of Legends Club";
	$headers = "From:" . $from;
	echo mail($to,$subject,$message,$headers);
?>
