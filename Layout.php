<?php
    function findThis($get){
        $d = '';
        for ($i = 0; $i < 20; $i++){
            if (file_exists($d.$get)){ return $d; }
            else{$d.="../";}
        }
    }    

    $pathRoot = findThis("mainPage.php");
?>

<?php
    session_start();
    include $pathRoot."Functions/sql.php";
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
        <?php echo'
            <link rel="stylesheet" href="'.$pathRoot.'bootstrap.css">
            <link rel="stylesheet" href="'.$pathRoot.'bootstrap-responsive.css">
            ';
        ?>
       
    </head>
    <body style="min-width: 550px;">
        <?php 
        echo'
        <div style="position:absolute; top: 0px; left:0px; height: 451px; z-index: -2; min-width: 550px; width: 100%; margin-top:  30px; background-image: url('.$pathRoot.'gradient.jpg); background-repeat: repeat-x;"></div>
        <div style="position: absolute; top: 0px; right: 0px; height:  451px;  min-width: 416px;  z-index: -1; margin-top: 30px; background-image:  url('.$pathRoot.'test.jpg); background-position-x: right; background-repeat: no-repeat;"></div>
        ';
        ?>
    </body>
         
</html>
<?php
    echo'
    <script src="'.$pathRoot.'jQuery.js"></script>
    <script src="'.$pathRoot.'bootstrap.js"></script>
    <script src="'.$pathRoot.'bootstrap.min.js"></script>
    ';
?>