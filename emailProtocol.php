<?php
	/************************************
	EMAIL PROTOCOL FOR SENDING EMAILS TO DIFFERENT FUNCTIONS EXECUTED ON THE WEBSITE

	****** Assumed known information that will be on the other file ******
	summoner - ... - The summoner name of the user receiving this email
	team - ... - The team the user has signed up to be on (Team Signups Only)
	password - ... - The team password (Team Signups Only)
	oldSummonerName - ... - Old summoner name in summoner name changes
	newSummonerName - ... - New summoner name in summoner name changes
	teamName - ... - Team Name of the team where members are being changed

	****** Different included information in the file *******
	extension - mtu.edu - Email extension required by all entered emails
	from - MTU League of Legends Club - Where the address is coming from. Covers up the administrator's email address
	headers - From:MTU League of Legends Club - Adds the header directly to the email being set

	****** Subject and Messages for different function on the site *******
	aramSubject - Successful ARAM Tournament Registration - The subject line in the email being sent (ARAM Registration)
	aramMessage - ... - The body and closing of the message sent to the email of the summoner registered (ARAM Registration)

	teamSubject - Successful Tournament Registration - The subject line in the email being sent (Team Registration)
	teamMessage - .. - The body and closing of the message sent to the email of each summoner registered into the premade 5's team (Team Registration)

	aramWithdrawSubject - ... - Subject header sent to the person withdrawing from the ARAM Tournament (ARAM Withdrawl Feature)
	aramWithdrawMessage - ... - Message sent to the person withdrawing from the ARAM Tournament (ARAM Withdrawl Feature)

	teamMemberRemovalSubject - ... - Subject header sent to the member being removed from a team (Team Member Change Feature) NYI
	teamMemberRemovalMessage - ... - Message sent to the member being removed from a team (Team Member Change Feature)

	teamMemberAdditionSubject - ... - Subject header sent to the member being added to a team (Team Member Change Feature) NYI
	teamMemberAdditionMessage - ... - Message sent to the member being added to a team (Team Member Change Feature)

	teamNameChangeSubject - ... - Subject header sent to all team members regarding a change in team name (Team Name Change Feature) NYI
	teamNameChangeMessage - ... - Message sent to all team members regarding a change in the team name (Team Name Change Feature)

	siteRegisterSubject - ... - Subject header sent to new registrants on the website (Site Registration) NYI
	siteRegisterMessage - ... - Message sent to the new registrants on the website (Site Registration)

	sitePasswordChangeSubject - ... - Subject header for the change of password on an account (Site Password Change Feature) NYI
	sitePasswordChangeMessage - ... - Message sent notifying the user of a change in password on their account (Site Password Change Feature)

	siteSummonerChangeSubject - ... - Subject header for the change of summoner name on the account (Site Summoner Name Change Feature) NYI
	siteSummonerChangeMessage - ... - Message sent notifying the user of a change in summoner name on the account (Site Summoner Name Change Feature)

	siteEmailChangeOldSubject - ... - Subject header for the change of email on the account (Site Email Change Feature) NYI
	siteEmailChangeNewSubject - ... - Message sent to the old email notifying in regards to a change of email (Site Email Change Feature)

	siteEmailChangeNewSubject - ... - Subject header for the change of email on the account (Site Email Change Feature) NYI
	siteEmailChangeNewMessage - ... - Message sent to the new email notifying in regards to a change of email (Site Email Change Feature)

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
	$teamSubject = "Successful Tournament Registration";
	$teamMessage = "Hello ".$summoner.",
	
This is a confirmation email letting you know that you have been successfully registered in the upcoming Premade 5's Tournament hosted by the MTU League of Legends Club.  The bracket will be constructed approximately 30 minutes in advance to allow time for the captains to add each other before the tournament starts. 

If you need to change any of your team's information, swap team members, view your payment status, or withdraw from the tournament, please log in using your team's name and your team password to change the information.

Please make necessary payment to the Campus Cafe before the tournament starts.

If you have any questions or concerns, please contact the administration. Information can be found on the Contact Us link of the website.

Thank you for your registration.  

GLHF,
MTU League of Legends E-Board and Site Administrator

Team Name:".$team."
Password:".$password;

	// ARAM Withdrawl
	$aramWithdrawSubject = "ARAM Tournament Withdrawl";
	$aramWithdrawMessage = "Dear ".$summoner.",

We have received word that you are withdrawing from the upcoming ARAM tournament.  We are saddened by your withdraw but we understand life comes first.  If you wish to re-register at a later date, provided you become available again.  Thank you for completing this withdrawl.

If you did not file for this withdrawl, please contact the Site Administrator as soon as possible and we appologize for the inconvenience.

Sincerely,
MTU League of Legends E-Board and Site Administrator";

	// Team Member Removal
	$teamMemberRemovalSubject = "Team Member Removal";
	$teamMemberRemovalMessage = "Dear ".$summoner.",

This email is being sent in regards to a change on the server. We have been informed you are being removed from ".$teamName." and being replaced.  If you believe this is an issue, please contact your team captain.  The Site Administrator can not handle disputes in teams.

If you believe this is an issue with the system malfunctioning, please contact the Site Administrator to have it fixed.

Thanks,
MTU League of Legends Site Administrator";

	// Team Member Add
	$teamMemberAdditionSubject = "Team Member Addition";
	$teamMemberAdditionMessage = "Dear ".$summoner.",

This email is being sent to you in regards to a recent change on the server. We have been informed that you are being added to ".$teamName." to replace another team member.  If you believe this is incorrect, please contact your team captain or the Site Administrator.

To get your team's password, please contact your Team Captain.

Good luck in the upcoming tournament.

GLHF,
MTU League of Legends E-Board and Site Administrator";

	// Team Name Change
	$teamNameChangeSubject = "Team Name Changed";
	$teamNameChangeMessage = "Dear ".$summoner.".

This email is being sent because someone on your team has requested a name change for the upcoming tournament.  The new team name submitted is ".$newTeamName.".  Please use this when logging into your team page to check paid status and any other team changes.  If this was not authorized by your team, please contact the Site Administrator at your earliest convenience to get it fixed.

Thanks,
MTU League of Legends E-Board and Site Administrator";

	// Site Registration
	$siteRegisterSubject = "MTU League of Legends Site Registration";
	$siteRegisterMessage = "Dear ".$summoner.",

Thank you for registering with the MTU League of Legends Club Site.

Please feel free to wander the site.  Some benefits you receive as a registered member is when you are logged in, you have access to a progress tracker, the ability to register for the MTU LCS, and faster registration for the regular tournaments.

If you have any questions, feel free to contact the E-Board or the Site Administrator.

Thanks again for registering,
MTU League of Legends E-Board and Site Administrator";

	// Account Password Change
	$sitePasswordChangeSubject = "MTU LoL Password Change";
	$sitePasswordChangeMessage = "Dear ".$summoner.",

You have recently filed a password change on the server for your account. If you were not the one who completed this, please contact the Site Administrator to get this fixed.

Thanks,
MTU LoL Site Administrator";

	// Account Summoner Change
	$siteSummonerChangeSubject = "MTU LoL Summoner Change";
	$siteSummonerChangeMessage = "Dear ".$summoner.",

We have received your change of summoner name on your account from ".$oldSummonerName." to ".$summoner.". If you did not make this change, please contact the Site Administrator.

Thank you for the update of summoner name.

Sincerely,
MTU LoL E-Board and Site Administrator";

	// Account Email Change Old
	$siteEmailChangeOldSubject = "MTU LoL Email Change";
	$siteEmailChangeOldMessage = "Dear ".$summoner.",

We have received change in our servers that you are updating your email. While this shouldn't normally be happening... we allow it.  If you did not authorize this change in MTU Email, please update your password and revert your email through the Account Administration Page.

Thanks,
MTU LoL Site Administrator";

	// Account Email Change New
	$siteEmailChangeNewSubject = "MTU LoL Email Change";
	$siteEmailChangeNewMessage = "Dear ".$summoner.",

We have received changes in our servers that reflect you have changed your email.  While this shouldn't happen, we allow it.  If you did not authorize this change in MTU Email, please update your password and revert your email through the Account Administration Page.

Thanks,
MTU LoL Site Administrator";

?>
