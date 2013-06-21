<?php
    echo' 
    <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
    <div class="container">

    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <a class="brand" style="float: left; font-size:25px; font-weight:bold;" href="'.$pathRoot.'mainPage.php">MTU League of Legends</a>

    <div class="nav-collapse collapse">
    <ul class="nav pull-right" style="width: auto;">
    <li><a href="'.$pathRoot.'League/premadeTeams.php">League of Legends Signup</a></li>';

    // User is not logged in
    if (inRole() == 0){
    echo '<li><a href="'.$pathRoot.'Registration/register.php">Register</a></li>
          <li><a href="'.$pathRoot.'Registration/Login.php">Log In</a></li>';}
             

    // User is Administrator
    if (isset($_SESSION['role']) and ($_SESSION['role'] == "EBoard" || $_SESSION['role'] == "SuperAdministrator")){  
    echo '<li><a href="'.$pathRoot.'Admin/AdminControls.php">Administrator Controls</a></li>'; }

    // User is Logged In
    if (inRole() > 0){
    echo '<li class="divider-vertical"></li>
		  <li class="right"><a href='.$pathRoot.'Account/Users.php>'.$_SESSION['summoner'].'</a></li>
          <li class="right"><a href="'.$pathRoot.'Registration/Logout.php">Logout</a></li>';}
                
                
    echo '
        <li><a href="'.$pathRoot.'contactUs.php">Contact Us</a><li>
    </div>
    </ul>
               
    </div>
    </div>
    </div>';    
?>