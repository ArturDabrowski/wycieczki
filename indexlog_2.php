<?php 
require_once 'config/Config.php';
        $sess= new MySession();
        $sess->sessVerify();
        
        if(isset($_GET['logout'])){
        $sess=new MySession();
        $sess->sessEnd();
    }
        if(isset($_GET['wyczysc'])){
            header('Location:indexlog_2.php');
        }
    
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Klienty</title>
        <link rel="stylesheet" href="style/bootstrap.min.css">
        <link rel="stylesheet" href="style/indexlog.css">
        <script src="scripts/jquery-3.1.1.js"></script>
        <script src="scripts/indexlog_2.js"></script>
    </head>
    <body>
        <?php
        $style='';
        $inputHidden='';
        if(isset($_GET['action']) && $_GET['action']=='mod' && !empty(trim($_GET['id']))){
            $id_mod=(int)$_GET['id'];
            $inputHidden='<input type="hidden" name="idKontakt" value="'.$id_mod.'">';
            echo '<script>';
            ?>
        $(function(){
            $('#modal').css('display','block').hide().fadeIn(1000);
            $('#dod').css('display','block').hide().fadeIn(2000);
        });
            <?php
            
            echo '</script>';
//            $style="display: block";
            $zapytanie_mod = "select * from `klient` where `id_klient`='$id_mod'";
            $baza=new DbConnect();
            $wynik=$baza->db->query($zapytanie_mod);
            $row_mod=$wynik->fetch_object();
            
            
            $row_mod->nazwisko;
            $row_mod->imie;
            $row_mod->miejscowosc;
            $row_mod->ulica;
            $row_mod->nr_domu; 
            $row_mod->nr_mieszkania;
            $row_mod->kod_pocztowy;
            $row_mod->telefon;
            $row_mod->mail;
              
       }

            if(isset($_POST['zapisz'])){
                    $data= date('Y-m-d');
                    
                    
                    $id_exc=$_POST['id_exc'];
                    $nazwisko=$_POST['nazwisko'];
                    $imie=$_POST['imie'];
                    $miejscowosc=$_POST['miejscowosc'];
                    $ulica=$_POST['ulica'];
                    $nr_domu=$_POST['nr_domu'];
                    $nr_mieszkania=$_POST['nr_mieszkania'];
                    $kod_pocztowy=$_POST['kod_pocztowy'];
                    $telefon=$_POST['telefon'];
                    $mail=$_POST['mail'];
                    
                    If(!isset($_POST['idKontakt'])){
                    
                    $zapytanie="INSERT INTO `klient`(`id_klient`, `id_exc`, `nazwisko`,"
                    . " `imie`, `miejscowosc`, `ulica`, `nr_domu`, `nr_mieszkania`, `kod_pocztowy`, "
                    . "`telefon`, `mail`, `data`) VALUES (null,'$id_exc', '$nazwisko','$imie','$miejscowosc',"
                    . "'$ulica','$nr_domu','$nr_mieszkania','$kod_pocztowy','$telefon','$mail', '$data')";
                    
            
                    } else {
                        $id_mod=(int)$_GET['id'];
                        $zapytanie="UPDATE `klient` set `id_exc`='$id_exc', `nazwisko`='$nazwisko', `imie`='$imie', `miejscowosc`='$miejscowosc', "
                                . "`ulica`='$ulica',`nr_domu`='$nr_domu', `nr_mieszkania`='$nr_mieszkania', `kod_pocztowy`='$kod_pocztowy',"
                                . " `telefon`='$telefon', `mail`='$mail', `data`='$data' where `id_klient`=$id_mod";
                        

                    }
                    $baza=new DbConnect(); 
                    $wynik=$baza->db->query($zapytanie);
                    header("Location: indexlog_2.php");
                    
                }
         if(isset($_GET['action']) && $_GET['action']=='del' && !empty($_GET['id'])){
            $id_klient=$_GET['id'];
            $zapytanie_usun="delete from `klient` where `id_klient`='$id_klient'";
            $baza=new DbConnect();
            $wynik=$baza->db->query($zapytanie_usun);
            header("Location:indexlog_2.php");
            exit();
        }
        ?>
        
        <div id="modal" style="<?php echo $style; ?>" >
            <form method="post">
                <div id="dod" style="<?php echo $style; ?>">
                    <div class="form-group">
                        <label for="id_exc">Id wycieczki</label>
                        <input name="id_exc" id="id_exc" class="form-control" value="<?php if (isset($row_mod->id_exc)){
                    echo $row_mod->id_exc;
                }?>">
                    </div>
                    <div class="form-group">
                        <label for="nazwisko">Nazwisko</label>
                        <input name="nazwisko" id="nazwisko" class="form-control" value="<?php if (isset($row_mod->nazwisko)){
                    echo $row_mod->nazwisko;
                }?>">
                    </div>
                    <div class="form-group">
                        <label for="imie">Imię</label>
                        <input name="imie" id="imie" class="form-control" value="<?php if (isset($row_mod->imie)){
                    echo $row_mod->imie;
                }?>">
                    </div>
                    <div class="form-group">
                        <label for="miejscowosc">Miejscowosc</label>
                        <input name="miejscowosc" id="miejscowosc" class="form-control" value="<?php if (isset($row_mod->miejscowosc)){
                    echo $row_mod->miejscowosc;
                }?>">
                    </div>   
                    <div class="form-group">
                        <label for="ulica">Ulica</label>
                        <input name="ulica" id="ulica" class="form-control" value="<?php if (isset($row_mod->ulica)){
                    echo $row_mod->ulica;
                }?>">
                    </div>
                    <div class="form-group">
                        <label for="nr_domu">Nr domu</label>
                        <input name="nr_domu" id="nr_domu" class="form-control" value="<?php if (isset($row_mod->nr_domu)){
                    echo $row_mod->nr_domu;
                }?>">
                    </div>
                    <div class="form-group">
                        <label for="nr_mieszkania">Nr mieszkania</label>
                        <input name="nr_mieszkania" id="nr_mieszkania" class="form-control" value="<?php if (isset($row_mod->nr_mieszkania)){
                    echo $row_mod->nr_mieszkania;
                }?>">
                    </div>
                    <div class="form-group">
                        <label for="kod_pocztowy">Kod pocztowy</label>
                        <input name="kod_pocztowy" id="kod_pocztowy" class="form-control" value="<?php if (isset($row_mod->kod_pocztowy)){
                    echo $row_mod->kod_pocztowy;
                }?>">
                    </div>
                    <div class="form-group">
                        <label for="telefon">telefon</label>
                        <input name="telefon" id="telefon" class="form-control" value="<?php if (isset($row_mod->telefon)){
                    echo $row_mod->telefon;
                }?>">
                    </div>
                    <div class="form-group">
                        <label for="mail">E-mail</label>
                        <input name="mail" id="mail" class="form-control" value="<?php if (isset($row_mod->mail)){
                    echo $row_mod->mail;
                }?>">
                    </div>
                        <?php echo $inputHidden."\n";?>
                    <input type="submit" name="zapisz" class="btn btn-primary" value="Zapisz">
                    <input type="submit" id="anuluj" class="btn btn-danger" value="Anuluj">
                </div>
            </form>
        </div>
        
        <div id="klient">
        <form method="get">
            <a href="#" id="dodaj" class="btn btn-primary" >Dodaj</a>
            <a href="indexlog_1.php?logout=yes" style="float:right" class="btn btn-danger" onclick="return confirm('Czy na pewno?')" >Wyloguj</a>
            <a href="indexlog_1.php" style="float:right; margin-right: 20px;" class="btn btn-default" >Exc</a>
            <input type="submit" name="szukaj" value="Szukaj" class="btn btn-default" style="margin-right: 20px; float:right;">
            <input name="pattern" id="pattern" class="form-control" style="width: 200px; float: right; margin-right: 20px" >
            <input type="submit" name="wyczysc" value="Wyczyść" class="btn btn-default" style="margin-right: 20px; float:right;">
        </form>
        <br>
 
        <table class="table table-striped">
        <thead>
            <tr style="color: white">
                <th>Id wycieczki</th>
                <th>nazwisko</th>
                <th>imie</th>
                <th>miejscowosc</th>
                <th>ulica</th>
                <th>nr domu</th>
                <th>nr mieszkania</th>
                <th>kod pocztowy</th>
                <th>telefon</th>
                <th>mail</th>
                <th>data</th>
                <th>Akcja</th>
            </tr>
        </thead>
            <tbody>
           
             <?php
             
             
            if(isset($_GET['pattern']) && !empty(trim($_GET['pattern']))){
            $pattern = htmlentities($_GET['pattern']);
            $zapytanie ="select * from `klient` where `id_exc` like \"%$pattern%\" || `nazwisko` like \"%$pattern%\" || `imie` like \"%$pattern%\"";
            
            
            } elseif(isset($_GET['action']) && $_GET['action']=='zapisani' && !empty(trim($_GET['id']))){
                $zapisani=$_GET['id'];
                $zapytanie = "select * from `klient` where `id_exc`='$zapisani'"; 
                
                
            } else {
                $zapytanie = "select * from `klient` order by id_exc asc";
             
            }
             $baza=new DbConnect();
             $wynik=$baza->db->query($zapytanie);
             
            $lp = 0;
            while ($wiersz=$wynik->fetch_object()){
                $lp++;
                echo "
            <tr class=\"tr\">
                <td>$wiersz->id_exc</td>
                <td>$wiersz->nazwisko</td>
                <td>$wiersz->imie</td>
                <td>$wiersz->miejscowosc</td>
                <td>$wiersz->ulica</td>
                <td>$wiersz->nr_domu</td>
                <td>$wiersz->nr_mieszkania</td>
                <td>$wiersz->kod_pocztowy</td>
                <td>$wiersz->telefon</td>
                <td>$wiersz->mail</td>
                <td>$wiersz->data</td>   
                <td><a href=\"?action=del&id=$wiersz->id_klient\" name=\"usun\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Czy na pewno?')\" >Usuń</a>"
                        . "<a href=\"?action=mod&id=$wiersz->id_klient\"   class=\"btn btn-sm btn-primary mod\" id=\"modyfikuj\">Modyfikuj</a></td>
            </tr>
            ";
        }
        if($lp==0) {
          echo 'Brak rekordów.';
        } 
            ?>
            </tbody>
        </table>
        </div>
     </body>
     
</html>
