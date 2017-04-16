<?php

class Contact extends DbConnect {
    function showContact($zapytanie) {
         
            $wynik=$this->db->query($zapytanie);
            $lp = 0;
            while ($wiersz=$wynik->fetch_object()){
                $lp++;
                echo "
            <tr class=\"tr\">
                <td>$lp</td>
                <td>$wiersz->nazwisko</td>
                <td>$wiersz->imie</td>
                <td>$wiersz->miejscowosc</td>
                <td>$wiersz->ulica</td>
                <td>$wiersz->nr_domu</td>
                <td>$wiersz->nr_mieszkania</td>
                <td>$wiersz->kod_pocztowy</td>
                <td>$wiersz->poczta</td>
                <td>$wiersz->mail</td>
                <td>$wiersz->data</td>   
                <td><a href=\"?action=del&id=$wiersz->id_kontakt\" name=\"usun\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Czy na pewno?')\" >Usuń</a>"
                        . "<a href=\"?action=mod&id=$wiersz->id_kontakt\"   class=\"btn btn-sm btn-primary mod\" id=\"modyfikuj\">Modyfikuj</a></td>
            </tr>
            ";
        }
        if($lp==0) {
          echo 'Brak rekordów.';
        }
 
    }
    
    function newContact($id_exc, $nazwisko, $imie, $miejscowosc, $ulica, $nr_domu, $nr_mieszkania, $kod_pocztowy, $poczta, $mail){
        $zapytanie="INSERT INTO `klient`(`id_klient`, `id_exc`, `nazwisko`,"
                    . " `imie`, `miejscowosc`, `ulica`, `nr_domu`, `nr_mieszkania`, `kod_pocztowy`, "
                    . "`poczta`, `mail`, `data`) VALUES (null,'$id_exc', '$nazwisko','$imie','$miejscowosc',"
                    . "'$ulica','$nr_domu','$nr_mieszkania','$kod_pocztowy','$poczta','$mail')";
            $czyPuste=new Validate();
            $czyPuste->puste($nazwisko,'nazwisko');
            $czyPuste->puste($imie,'imie');
            $czyPuste->puste($miejscowosc,'miejscowosc');
            $czyPuste->puste($ulica,'ulica');
            $czyPuste->puste($nr_domu,'nr_domu');
            $czyPuste->puste($nr_mieszkania,'nr_mieszkania');
            $czyPuste->puste($kod_pocztowy,'kod_pocztowy');
            $czyPuste->puste($poczta,'poczta');
            $czyPuste->puste($mail,'mail');
            $czyPuste->validateEmail($mail,'mail');            
            if($czyPuste->liczError==0){
                
              $wyslij=$this->db->query($zapytanie);
              header("Location:indexlog_1.php");
              exit();
            }   
    }
   
    function getContactInForm($id_mod){
            
        $zapytanie_mod = "select * from `klient` where `id_kontakt`='$id_mod'";
            
            $wynik_mod= $this->db->query($zapytanie_mod);
            $row_mod=$wynik_mod->fetch_object();

            $this->nazwisko=$row_mod->nazwisko;
            $this->imie=$row_mod->imie;
            $this->miejscowosc=$row_mod->miejscowosc;
            $this->ulica=$row_mod->ulica;
            $this->nr_domu=$row_mod->nr_domu; 
            $this->nr_mieszkania=$row_mod->nr_mieszkania;
            $this->kod_pocztowy=$row_mod->kod_pocztowy;
            $this->poczta=$row_mod->poczta;
            $this->mail=$row_mod->mail;
            
    }
        function modContact($data, $nazwisko, $imie, $miejscowosc, $ulica, $nr_domu, $nr_mieszkania, $kod_pocztowy, $poczta, $mail ){
     $id_mod=(int)$_GET['id'];
     $zapytanie="UPDATE `klient` set `nazwisko`='$nazwisko', `imie`='$imie', `miejscowosc`='$miejscowosc', `ulica`='$ulica',`nr_domu`='$nr_domu', `nr_mieszkania`='$nr_mieszkania', `kod_pocztowy`='$kod_pocztowy', `poczta`='$poczta', `mail`='$mail', `data`='$data' where `id_kontakt`=$id_mod";
     
            $czyPuste=new Validate();
            $czyPuste->puste($nazwisko,'nazwisko');
            $czyPuste->puste($imie,'imie');
            $czyPuste->puste($miejscowosc,'miejscowosc');
            $czyPuste->puste($ulica,'ulica');
            $czyPuste->puste($nr_domu,'nr_domu');
            $czyPuste->puste($nr_mieszkania,'nr_mieszkania');
            $czyPuste->puste($kod_pocztowy,'kod_pocztowy');
            $czyPuste->puste($poczta,'poczta');
            $czyPuste->puste($mail,'mail');
            $czyPuste->validateEmail($mail,'mail');  
            
            if($czyPuste->liczError==0){
                $wyslij=$this->db->query($zapytanie);
                header("Location:indexlog.php");
                exit();
                       }   
               }

    function delContact($id_exc){
            $zapytanie_usun="delete from `exc` where `id_exc`='$id_exc'";
            $wynik=$this->db->query($zapytanie_usun);
            header("Location:indexlog_1.php");
            exit();
    }
}
   
    
            
            
            
    
         

        