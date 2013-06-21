<?php
    include '../Layout.php';   
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Das Lowen Haus</title>
        <link href="~/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    </head>
    <body>
        <?php include '../navBar.php'; ?>
        <div style="margin-top: 100px;" class="container">
            <div class="well well-large" id="announcements">
                
                <div class="page-header">
                    <h1 id="header">League of Legends Club</h1>
                    <h2>Summer Tournaments 2013 (ARAMs)</h2>
                    <h3>To be Determined EST</h3>
					<h3>Registration Fee: None</h3>
					<h3>Prizes: None</h3>
                    <?php
                        if ($_SESSION['error'] != ""){
                            echo "<h2>".$_SESSION['error']."</h2>";
                        }
                    ?>
                    <div class="navbar">
                        <div class="navbar-inner">
                            <ul class="nav" style="width: auto;">
								<li><a href="premadeTeams.php">Premade 5's</a></li>
                                <li><a href="viewTeams.php">Team Composition</a></li>
                                <li><a href="displayBracket.php">Live Brackets</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="well well-large">
                    <h3>Tournament Rules and Registration Guidelines</h3>

                    <!-- Eligibility Rules HERE-->
                    <h4>Eligibility</h4>
                    <ul>
                        <li>All games will be played on North American live servers.</li>
                        <li>Players must register with their school-provided email address.  Exceptions can be made by contacting the President of the MTU League Club, the Vice President, or the Site Administrator.</li>
                        <li>Each participant must be in good standing within the game.</li>
                        <li>Each participant must have a working computer in working condition. If you can not enter a game within 10 minutes of your team being ready to play the other team, your team may be forced to forfeit at the MTU League of Legends E-board or Site Administrator's discretion.</li>
						<li><b>Each participant must not be on a tournament ban from the E-board or Site Administrator for any reason.</b></li>
                    </ul>

                    <!-- General Rules HERE-->
                    <h4>General</h4>
                    <ul>
                        <li>Players can NOT compete in more than one (1) team.</li>
                        <li>Players must play the same account throughout the tournament. You may make changes to the account registered up until the start of the first round, after that you must use the same one. If a player is banned during the tournament, their team would no longer meet the eligibility criteria and would be disqualified.</li>
                        <li>The player selected, after signup, to be the team's captain for ARAMs will be responsible for:
                            <ul>
                                <li><b>Home Team (Blue): </b>Submitting team scores and updating brackets online upon completion</li>
                                <li><b>Away Team (Purple): </b>Verifying the correct scores were input online.</li>
                                <li>Notifying and contacting your team as well as your opponent captain to set up games.</li>
                            </ul>
                        </li>
                        <li>If the team captain is not playing in a game, they must appoint someone who is playing to act as the temporary captain and fulfill their captainly duties.</li>
                        <li>Teams will be split up into the brackets randomly.</li>
                        <li>If possible, a Mumble server will be hosted to adequately accomodate all participants of the tournament.  If one is provided, all competitors should use the server so that all competitors are in one local area. This will help speed up potential downtime in between matches as well as allow for a common area for any teams not currently playing to congregate and talk.</li>
						<li>Inappropriate team names, as determined by the site administrator and current E-Board, will be renamed. You will be given one chance and up to a week max to rename your team. After such time as the chance or time has been exhausted, whichever comes first, the E-Board will rename the team.</li>
						<li><b>Excessive harrassment or inappropriate behavior before, during, or after a game will result in a warning and then a tournament suspension or if severe enough, an immediate tournament suspension will be given and you will be disqualified.  The exact length of the suspension will be determined by the E-Board and the Site Administrator.</b></li>
                    </ul>

                     <!-- Play Rules HERE-->
                    <h4>Match</h4>
                    <ul>
                        <li>Matches will consist of a single game on Howling Abyss. Winner advances to the next stage.</li>
                        <li>Both teams will have their characters randomly assigned to them. There are to be no re-rolls.  The first time will result in a warning. The second time may result in team disqualification.</li>
                        <li>All players in each game must be on their appropriate team. Using players not on the team roster may result in disqualification. If a substitution needs to be made,  contact the MTU League of Legends E-Board or the Site Administrator to notify of changes being made.</li>
                        <li>Failure to field a full team for a match is at the team's disgression. No substitutions may be made at the start of the game unless the opposing team agrees and the MTU League of Legends E-Board / Site Administrator are notified of the situation.</li>
                        <li>Failure to submit results in a timely fashion initially results in a warning and the opposing team's results will be counted as verified. Continued failure to do so may result in disqualification.</li>
                        <li>In order to ensure fairness, the match must be restarted if a teammate disconnects before the 5 minutes or first blood, whichever comes first. After first blood or 5 minutes, the game must continue. Limit 1 restart per match.</li>
                    </ul>

                </div>

                <form class="form-horizontal" method="post" autocomplete="off" action="addEntrant.php">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label">MTU Email Address</label>
                        <div class="input-append">
                            <input class="span2" type="text" name="email" id="email" placeholder="mtuLeague" style="margin-left: 20px" required/>
                            <span class="add-on">@mtu.edu</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Summoner's Name</label>
                        <div class="controls">
                            <input type="text" name="summoner" id="summoner" placeholder="Sandelina" required/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Suggested Team Name</label>
                        <div class="controls">
                            <input type="text" name="team" id="team" placeholder="Das Chocobo And Friends" required/>
                        </div>
                    </div>

					<div class="control-group">
						<label class="control-label">Solo Password</label>
						<div class="controls">
							<input type="password" name="password" id="password" placeholder="Password"/>
						</div>
						<p style="margin: 10px 30px 0px 65px">The password is so that you can remove yourself from the tournament should you need to withdraw.</p>	 
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
            </div>
        
        <!-- Footer -->
            <div class="well well-large" id="footer">           
                <?php
                    include '../footer.php';
                ?>
            </div>
        </div>

    </body>
</html>
