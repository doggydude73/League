<?php
	/************************************
	EMAIL PROTOCOL FOR SENDING EMAILS TO DIFFERENT FUNCTIONS EXECUTED ON THE WEBSITE

	****** Assumed known information that will be on the other file ******
	summoner - ... - The summoner name of the user receiving this email

	****** Different included information in the file *******

	extension - mtu.edu - Email extension required by all entered emails
	from - MTU League of Legends Club - Where the address is coming from. Covers up the administrator's email address
	headers - From:MTU League of Legends Club - Adds the header directly to the email being set
	aramSubject - Successful ARAM Tournament Registration - The subject line in the email being sent
	aramMessage - ... - The body and closing of the message sent to the email of the summoner registered 
	teamSubject - Successful Tournament Registration - The subject line in the email being sent
	teamMessage - .. - The body and closing of the message sent to the email of each summoner registered into the premade 5's team

	************************************/

	$extension = "@mtu.edu";
	$from = "MTU League Of Legends Club";
	$headers = "From:" . $from;

	// ARAM Signup
	$aramSubject = "Successful ARAM Tournament Registration";
	$aramMessage = "Hello ".$summoner.",

This is a confirmation email letting you know that you have been successfully registered in the upcoming ARAM Tournament hosted by the MTU League of Legends Club. Teams will be constructed 1-2 hours before the tournament is due to start. Please check back to see where you have been seeded as a team as well as which team you have been drafted into.

If you need to change your email address, summoner's name, or withdraw from the tourament, please log in using your summoner's name and your password and change the information.

Thank you for your registration and again, good luck in the tournament.

GLHF,
MTU League of Legends E-Board and Site Adminsitrator";

	// Team Signup Message
	$teamSubect = "Successful Tournament Registration";
	$teamMessage = "Hello ".$summoner.",
	
This is a confirmation email letting you know that you have been successfully registered in the upcoming Premade 5's Tournament hosted by the MTU League of Legends Club.  The bracket will be constructed approximately 30 minutes in advance to allow time for the captains to add each other before the tournament starts. 

If you need to change any of your team's information, swap team members, view your payment status, or withdraw from the tournament, please log in using your team's name and your team password to change the information.

Please make necessary payment to the Campus Cafe before the tournament starts.

If you have any questions or concerns, please contact the administration. Information can be found on the Contact Us link of the website.

Thank you for your registration.  

GLHF,
MTU League of Legends E-Board and Site Administrator";

?>
