<?php
  require_once 'config/Config.php';
  require_once 'config/Switch.php';

?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Potwierdzenie rejestracji</title>
        <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
        <?php
            $mail= htmlentities($_GET['mail']);
            $sec= htmlentities($_GET['sec']);
            $zapytanie= "select `id_klient` from klient where `mail`='$mail' and `security`='$sec' and `aktywne`=0";
            
        ?>
        <div class="blad">
        <?php
  
        $account=new Account();
        $account->potAccount($zapytanie, $mail);
    
        ?>
        </div>
        
    </body>
</html>
