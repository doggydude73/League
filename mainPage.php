<?php
    include 'Layout.php';
    include 'databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("League", $db);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Das Lowen Haus</title>
        <link href="~/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    </head>
    <body>
       <?php include 'navBar.php'; ?>

        <div style="margin-top: 100px;" class="container">
            <div class="well well-large" id="announcements">
            <div class="page-header">
                <h1>Welcome MTU LoL Club</h1>
            </div>

            <?php
                $query = "SELECT * FROM announce ORDER BY time DESC";
                $sql = mysql_query($query,$db);
                $counter = 0;

                // Get the top five announcements
                while($row = mysql_fetch_array($sql))
                {
                    // Terminate if more than 5 announcements are available
                    if ($counter == 5){break;}

                    $privacy = $row['access'];
                    $approval = $row['approval'];

                    if ($privacy == "Private" && inRole() > 1 ){
                        // Get information and convert into a readable form
                        $announcement = $row['news'];
                        $creator = $row['creator'];
                        $time = $row['time'];
                        $time = strtotime($time);
                        $time = date("F dS Y g:i:s A", $time);

                        echo "<div id=\"single\" class=\"well well-large\">";
                        echo "<p class=\"lead muted\" style=\"text-align: justify;\"><strong>".$announcement."</strong></p>";
                        echo "<p style=\"padding:0px; margin:0px; text-align: right\">".$time."</p>";
                        echo "<p style=\"text-align: right\">".$creator."</p>";
                        echo "</div>";
                        $counter = $counter  + 1;
                    } else if ($privacy == "Public" && $approval == "Yes"){
                        // Get information and convert into a readable form
                        $announcement = $row['news'];
                        $creator = $row['creator'];
                        $time = $row['time'];
                        $time = strtotime($time);
                        $time = date("F dS Y g:i:s A", $time);

                        echo "<div id=\"single\" class=\"well well-large\">";
                        echo "<p class=\"lead\" style=\"text-align: justify;\"><strong>".$announcement."<strong></p>";
                        echo "<p style=\"padding:0px; margin:0px; text-align: right\">".$time."</p>";
                        echo "<p style=\"text-align: right\">".$creator."</p></div>";
                        $counter = $counter  + 1;
                    }
                }                            

            ?>
            </div>

        <!-- Footer -->
            <div class="well well-large" id="footer">           
                <?php
                    include 'footer.php';
                ?>
            </div>
        </div>

    </body>
</html>