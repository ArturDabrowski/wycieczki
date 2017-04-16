<?php

require_once 'config/Config.php';
if(isset($_GET['login'])){
    $login= htmlentities($_GET['login']);
    
    $zapytanie="select `id_klient` from `users` where `login`='$login'";
  
} else {
    $mail= htmlentities($_GET['mail']);
    
    $zapytanie="select `id_klient` from `users` where `mail`='$mail'";
}

    $baza=new DbConnect();
        $wynik=$baza->db->query($zapytanie);

        if($wynik->num_rows==1){
            echo 'TAK';
        } else {
            echo 'NIE';
        }

