<?php


class Account extends DbConnect {
    function addAccount($zapytanie, $zapytanie_weryfikacja_login, $zapytanie_weryfikacja_mail){
        $spr = $this->db->query($zapytanie_weryfikacja_login);
        $spr2 = $this->db->query($zapytanie_weryfikacja_mail);
        $this->istnieje=0;
       
        if($spr->num_rows !=0) {
            $this->istnieje++;
            echo "<div class=\"komunikat\" id=\"komunikat\">Taki login już istnieje.</div>";
        }
        if($spr2->num_rows !=0) {
            $this->istnieje++;
            echo "<div class=\"komunikat\" id=\"komunikat\">Taki adres e-mail już istnieje.</div>";
            
        }
        if($this->istnieje == 0){
            $this->db->query($zapytanie);
        }
    }
    function newAccount(){
          
    }
    
    function potAccount($zapytanie, $mail){
        $wynik= $this->db->query($zapytanie);
        if($wynik->num_rows==1){
            
            $zapytanie_update= "update `users` set `aktywne`=1 where `mail`='$mail'";
            $potwierdzenie = $this->db->query($zapytanie_update);
            if($potwierdzenie){
                echo "<div class=\"komunikat\" id=\"komunikat\">Proces potwierdzenia został zakończony poprawnie. Możesz się zalogować.<br><a href='index.php'>Click!</a></div>";
                
            } else {
                echo "<div class=\"komunikat\" id=\"komunikat\">Podczas potwierdzenia wystąpił błąd.</div>";
                
            }
        } else {
            
            echo "<div class=\"komunikat\" id=\"komunikat\">Dane potwierdzenia niepoprawne lub konto zostało już aktywowane.</div>";
        }
    }
            
    function modAccount(){
        if(isset($_POST['przypomnij'])){
        
        $mail=htmlentities($_POST['mail']);
                  
        $val=new Validate();
        $val->puste($mail, 'mail');
        $val->validateEmail($mail, 'mail');
        
        if($val->liczError==0) {
          $zapytanie="SELECT `id_kontakt` FROM `users` WHERE `mail` = '$mail'";
          
          $wynik=$this->db->query($zapytanie);
          if($wynik->num_rows==0) {
              echo "<div class=\"komunikat\" id=\"komunikat\">Nie ma takiego adresu e-mail</div>";
          } else {
              
            $sec=(uniqid()); 
            
            $updateSec="UPDATE `users` SET `security` = '$sec' WHERE `mail` = '$mail'";
            
            $wynik1=$this->db->query($updateSec);
            
            if($wynik1) {
                $message="<a href=\"".WITRYNA."index.php?page=resetHasla&mail=$mail&sec=$sec\"> Kliknij aby wygenerowac nowe haslo.</a>";
                $mail_reset=new SendMail(EMAIL_ADMIN);
                $mail_reset->send($mail, 'Reset hasla',$message );
                } else {
                    echo "<div class=\"komunikat\" id=\"komunikat\">Wystąpił błąd, spróbuj ponownie.</div>";
            }
            
          }
                  
        }
        unset($val);
     }
    }
    function resetPassword() {
              if(isset($_POST['zapisz'])){
          $sec=$_GET['sec'];
          $mail=$_GET['mail'];

          $haslo= htmlentities($_POST['haslo']);
          $haslo2= htmlentities($_POST['haslo2']);
          $haslosha1=sha1($_POST['haslo']);
          
          $spr=new Validate();
          $spr->haslo($haslo, 'haslo', $haslo2, 'haslo2');
          $spr->validatePass($haslo, 'haslo');
          
          if($spr->liczError==0) {
            $zapytanie= "UPDATE `users` SET `password` = '$haslosha1' WHERE `mail` = '$mail'";
            
            $wynik= $this->db->query($zapytanie);
            echo "<div class=\"komunikat\" id=\"komunikat\">Hasło zostało pomyślnie zmienione. Mozesz się zalogować.<br><a href='index.php'>Logowanie</a></div>";
            
          
          }
      }
    }
    
    function delAccount(){
        
    }
}

