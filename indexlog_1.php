<?php 
require_once 'config/Config.php';
        $sess= new MySession();
        $sess->sessVerify();
        
        if(isset($_GET['logout'])){
        $sess=new MySession();
        $sess->sessEnd();
    }
        if(isset($_GET['wyczysc'])){
            header('Location:indexlog_1.php');
        }
     
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Wycieczki</title>
        <link rel="stylesheet" href="style/bootstrap.min.css">
        <link rel="stylesheet" href="style/indexlog_1.css">
        <script src="scripts/jquery-3.1.1.js"></script>
        <script src="scripts/indexlog_1.js"></script>
    </head>
    <body>
        <?php
             if(isset($_GET['action']) && $_GET['action']=='del' && !empty($_GET['id'])){
            $id_exc=$_GET['id'];
            $zapytanie_usun="delete from `exc` where `id_exc`='$id_exc'";
            $baza=new DbConnect();
            $wynik=$baza->db->query($zapytanie_usun);
            header("Location:indexlog_1.php");
            exit();
        }
        
        $style='';
        $inputHidden='';
        if(isset($_GET['action']) && $_GET['action']=='mod' && !empty(trim($_GET['id']))){
            $id_mod=(int)$_GET['id'];
            $inputHidden='<input type="hidden" name="idWyc" value="'.$id_mod.'">';
            echo '<script>';
            ?>
        $(function(){
            $('#modal').css('display','block').hide().fadeIn(1000);
            $('#dod').css('display','block').hide().fadeIn(2000);
        });
            <?php
            
            echo '</script>';
            $zapytanie_mod = "select * from `exc` where `id_exc`='$id_mod'";
            $baza=new DbConnect();
            $wynik=$baza->db->query($zapytanie_mod);
            $row_mod=$wynik->fetch_object();

            $row_mod->nazwa;
            $row_mod->opis;
            $row_mod->cena;
            
           
       }

            if(isset($_POST['zapisz'])){
                    $data= date('Y-m-d');

                    $nazwa=$_POST['nazwa'];
                    $opis=$_POST['opis'];
                    $cena=$_POST['cena'];
                    
                    
                    
                    If(!isset($_POST['idWyc'])){
                    
                    $zapytanie="INSERT INTO `exc`(`id_exc`, `nazwa`, `opis`, `cena`) VALUES (null, '$nazwa','$opis','$cena')";
                    
            
                    } else {
                        $id_mod=(int)$_GET['id'];
                        $zapytanie="UPDATE `exc` set `nazwa`='$nazwa', `opis`='$opis', `cena`='$cena' where `id_exc`='$id_mod'";
                        

                    }
                    $baza=new DbConnect(); 
                    $wynik=$baza->db->query($zapytanie);
                    header("Location: indexlog_1.php");
                    
                }
        ?>
        
        <div id="modal" style="<?php echo $style; ?>">
            <form method="post">
                <div id="dod" style="<?php echo $style; ?>">
                    <div class="form-group">
                        <label for="nazwa">Nazwa</label>
                        <input name="nazwa" id="nazwa" class="form-control" value="<?php if (isset($row_mod->nazwa)){
                    echo $row_mod->nazwa;
                }?>">
                    </div>
                    <div class="form-group">
                        <label for="opis">Opis</label>
                        <input name="opis" id="opis" class="form-control" value="<?php if (isset($row_mod->opis)){
                    echo $row_mod->opis;
                }?>">
                    </div>
                    <div class="form-group">
                        <label for="cena">Cena</label>
                        <input name="cena" id="cena" class="form-control" value="<?php if (isset($row_mod->cena)){
                    echo $row_mod->cena;
                }?>">
                    </div>  
                    
                    <?php echo $inputHidden."\n";?>
                    <input type="submit" name="zapisz" class="btn btn-primary" value="Zapisz">
                    <input type="submit" id="anuluj" class="btn btn-danger" value="Anuluj">
                </div>
            </form>
        </div>
        
        <div id="exc">
        <form method="get">
            <a href="#" id="dodaj" class="btn btn-primary">Dodaj</a>
            <a href="indexlog_1.php?logout=yes" style="float:right" class="btn btn-danger" onclick="return confirm('Czy na pewno?')" >Wyloguj</a>
            <a href="indexlog_2.php" style="float:right; margin-right: 20px;" class="btn btn-default" >Klienty</a>
            <input type="submit" name="szukaj" value="Szukaj" class="btn btn-default" style="margin-right: 20px; float:right;">
            <input name="pattern" id="pattern" class="form-control" style="width: 200px; float: right; margin-right: 20px" >
            <input type="submit" name="wyczysc" value="Wyczyść" class="btn btn-default" style="margin-right: 20px; float:right;">
        </form>
        
       
        <br>
 
        <table class="table table-striped" >
        <thead>
            <tr style="color: white; text-align: center;">
                <th>Id wycieczki</th>
                <th>Zdjecie</th>
                <th>Nazwa wycieczki</th>
                <th>Opis</th>
                <th>Cena</th>
                <th>Ewentualne poczynania</th>
                <th>Dodaj zdjecia</th>
            </tr>
        </thead>
            <tbody>
    <?php
            
           if(isset($_GET['pattern']) && !empty(trim($_GET['pattern']))){
            $pattern = htmlentities($_GET['pattern']);
            $zapytanie ="select * from `exc` where `id_exc` like \"%$pattern%\" || `nazwa` like \"%$pattern%\"";
            
            } else {
                $zapytanie = "select * from `exc`";
            }
            
             $baza=new DbConnect();
             $wynik=$baza->db->query($zapytanie);
            $lp = 0;
            while ($wiersz=$wynik->fetch_object()){
                $lp++;
                echo "
            <tr class=\"tr\">
                <td>$wiersz->id_exc</td>
                <td><div id=\"fot\" style=\"width: 30px; height:30px;\"><img src=\"$wiersz->urlZdjecie\" style=\"width: 100%; height:100%;\"></img></div></td>
                <td>$wiersz->nazwa</td>
                <td>$wiersz->opis</td>
                <td>$wiersz->cena</td>
                <td><a href=\"?action=mod&id=$wiersz->id_exc\" class=\"btn btn-sm btn-primary mod\" id=\"modyfikuj\" style=\"margin-right: 20px\">Modyfikuj</a>"
                        . "<a href=\"indexlog_2.php?action=zapisani&id=$wiersz->id_exc\"  name=\"zapisani\" class=\"btn btn-sm btn-primary mod\" id=\"zapisani\" style=\"margin-right: 20px\">Zapisani</a>"
                        . "<a href=\"?action=del&id=$wiersz->id_exc\" name=\"usun\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Czy na pewno?')\" style=\"margin-right: 20px;\">Usuń</a></td>
                <td><form enctype=\"multipart/form-data\" method=\"post\" id=\"imageUp\"  action=\"?action=up&id=$wiersz->id_exc\">
            <input type=\"submit\" name=\"wyslij\" value=\"Wyslij\" style=\"float:right; margin-right: 20px;\" class=\"btn btn-default\">
            <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"10240000\" style=\"float:right; margin-right: 20px;\" class=\"btn btn-default\">
            <input type=\"file\" name=\"plik\" style=\"float:right; margin-right: 20px;\" class=\"btn btn-default\">
        </form></td>
                            
                        
            </tr>
            ";
        }
 
        if($lp==0) {
          echo 'Brak rekordów.';
        }
        if(isset($_POST['wyslij'])){
                $plik = new UploadFile('plik');
            }
            
//        <a href=\"?action=up&id=$wiersz->id_exc\" name=\"wyslij\" onclick=\"form.submit();\" style=\"margin-right: 20px;\">Wyslij</a>
    ?>
            
            </tbody>
        </table>
        </div>
        
     </body>
     
</html>
