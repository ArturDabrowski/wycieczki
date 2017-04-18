 <?php

    $value='';
    $checked='';

    
            if(isset($_POST['login']) && isset($_POST['haslo'])){
                $login=$_POST['login'];
                $haslo=$_POST['haslo'];
            
            
                $sesja = new MySession();
                $sesja->sessStart($login, $haslo);
            }
            
        $style='';
        if(isset($_GET['action']) && $_GET['action']=='zap' && !empty(trim($_GET['id']))){
            $id_exc=(int)$_GET['id'];
            echo '<script>';
            ?>
        $(function(){
            $('#modalS').css('display','block').hide().fadeIn(1000);
            $('#dodS').css('display','block').hide().fadeIn(2000);
        });
            <?php
            
            echo '</script>';

       }
                      
            if(isset($_POST['zapisz'])){
                    $data= date('Y-m-d');
                    $id_exc=$_GET['id'];
                    $nazwisko=$_POST['nazwisko'];
                    $imie=$_POST['imie'];
                    $miejscowosc=$_POST['miejscowosc'];
                    $ulica=$_POST['ulica'];
                    $nr_domu=$_POST['nr_domu'];
                    $nr_mieszkania=$_POST['nr_mieszkania'];
                    $kod_pocztowy=$_POST['kod_pocztowy'];
                    $telefon=$_POST['telefon'];
                    $mail=$_POST['mail'];
                    
                    $sprawdz=new Validate();
                    $sprawdz->puste($nazwisko, 'nazwisko');
                    $sprawdz->puste($imie, 'imie');
                    $sprawdz->puste($miejscowosc, 'miejscowosc');
                    $sprawdz->puste($ulica, 'ulica');
                    $sprawdz->puste($nr_domu, 'nr_domu');
                    $sprawdz->puste($nr_mieszkania, 'nr_mieszkania');
                    $sprawdz->validatePostCode($kod_pocztowy, 'kod_pocztowy');
                    $sprawdz->puste($telefon, 'telefon');
                    $sprawdz->validateEmail($mail, 'mail');
                    
                    if($sprawdz->liczError==0){
                    $zapytanie="INSERT INTO `klient`(`id_klient`, `id_exc`, `nazwisko`,"
                    . " `imie`, `miejscowosc`, `ulica`, `nr_domu`, `nr_mieszkania`, `kod_pocztowy`, "
                    . "`telefon`, `mail`, `data`) VALUES (null,'$id_exc', '$nazwisko','$imie','$miejscowosc',"
                    . "'$ulica','$nr_domu','$nr_mieszkania','$kod_pocztowy','$telefon','$mail', '$data')";
                    
                    $baza=new DbConnect(); 
                    $wynik=$baza->db->query($zapytanie);
                    header('Location: index.php');
                    exit();
                    }
            }

        ?>
        <aside class="aside" >
            <div>
            <form method="post" id="form">
                <div id="wiadomosc"></div>
                <input name="login" id="login1"  placeholder="Podaj login"><br>
                <input name="haslo" id="haslo1" type="password" placeholder="Podaj haslo"><br>
                <input name="zaloguj" id="zaloguj" type="submit" value="Logowanie"><br>
            </form>
        <hr>
        <a href="index.php?page=nie_pamietam"><button>Nie pamiętam hasła</button></a>
        </div>
        </aside>
        
        <section class="section">
            <header><h1>Chodź, zobaczymy co jest za górką..</h1><img src="img/sun.png"></header>
            <div id="modalS" style="<?php echo $style; ?>" >
            <form method="post">
                <div id="dodS" style="<?php echo $style; ?>">
                    <div class="form-group">
                        <label for="nazwisko">Nazwisko</label>
                        <input name="nazwisko" id="nazwisko" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="imie">Imię</label>
                        <input name="imie" id="imie" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="miejscowosc">Miejscowosc</label>
                        <input name="miejscowosc" id="miejscowosc" class="form-control">
                    </div>   
                    <div class="form-group">
                        <label for="ulica">Ulica</label>
                        <input name="ulica" id="ulica" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nr_domu">Nr domu</label>
                        <input name="nr_domu" id="nr_domu" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nr_mieszkania">Nr mieszkania</label>
                        <input name="nr_mieszkania" id="nr_mieszkania" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="kod_pocztowy">Kod pocztowy</label>
                        <input name="kod_pocztowy" id="kod_pocztowy" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="telefon">Telefon</label>
                        <input name="telefon" id="telefon" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="mail">E-mail</label>
                        <input name="mail" id="mail" class="form-control">
                    </div>
                    <input type="submit" name="zapisz" class="btn btn-primary" value="Zapisz">
                    <input type="submit" id="anulujS" class="btn btn-danger" value="Anuluj">
                    <?php unset($sprawdz); ?>
                </div>
                
            </form>
        </div>
            
            <div id="pudlo"> 
                
                <div id="gora"></div>
                
                
<div id="glownaWycieczki">
    <table class="table table-striped" border=1 frame=void rules=rows>
        <thead>
            <tr style="text-align: center;">
                <th>Zdjecie</th>
                <th>Nazwa wycieczki</th>
                <th>Opis</th>
                <th>Cena</th>
                <th></th>
            </tr>
        </thead>
            <tbody>
    <?php
    
    $zapytanie = "select * from `exc`";
           $baza=new DbConnect(); 
           $wynik=$baza->db->query($zapytanie);
            $lp = 0;
            while ($wiersz=$wynik->fetch_object()){
                $lp++;
                echo "
            <tr class=\"tr\">
                <td><div id=\"fot\" style=\"width: 100px; height:100px;\"><img src=\"$wiersz->urlZdjecie\" style=\"width: 100%; height:100%;\"></img></div></td>
                <td>$wiersz->nazwa</td>
                <td>$wiersz->opis</td>
                <td>$wiersz->cena</td>
                <td><a href=\"?action=zap&id=$wiersz->id_exc\" class=\"btn btn-sm btn-primary zapiszsie\" name=\"zapiszsie\" style=\"margin-right: 20px\">Zapisz się!</a></td>                
                
            </tr>
            ";
        }
 
        if($lp==0) {
          echo 'Brak rekordów.';
        }
    ?>
            <!--<td><a href=\"?action=zap&id=$wiersz->id_exc\" class=\"btn btn-sm btn-primary zapiszsie\" name=\"zapiszsie\" style=\"margin-right: 20px\">Zapisz się!</a></td>-->
            </tbody>
        </table>
    </div>
                <div id="dol"></div>
    </div> 
            <footer><h1>Bunkrów nieee ma, ale też jest fajnie :)</footer>
    </section>


