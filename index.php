<?php
require_once 'config/Config.php';
require_once 'config/Switch.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title ?></title>
        <link rel="stylesheet" href="style/style.css">
        <script src="scripts/jquery-3.1.1.js"></script>
        <script src="scripts/jquery-ui.js"></script>
        <script src="scripts/script.js"></script>
        <script src="scripts/komunikaty.js"></script>
        <script src="scripts/logowanie.js"></script>
        <script src="scripts/start.js"></script>
        
    </head>
    <body>
        <?php
       
        require_once "page/{$page}.php";
     
        ?>
        
    </body>
</html>
