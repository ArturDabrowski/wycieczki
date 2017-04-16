<?php
require_once 'config/Config.php';
class MySession  {
    
    function __construct() {
        session_start();
    }
            
    function sessStart($login, $haslo){
        $polacz = new DbConnect();
        $zapytanie="select `id_admin`, `login` from `admin` where `login`='$login' and `password` = '$haslo'";
                $wynik=$polacz->db->query($zapytanie);
                $wynik1=$wynik->fetch_object();
                
                if($wynik->num_rows == 1){
                    
                    if(isset($_POST['zapamietaj']) && ($_POST['zapamietaj']=='tak')){
                   
                    setcookie('login',$login, time()+(60*60*24*7));
               } else {
                   setcookie('login', $login, time()-3600);
               }
                    $_SESSION['identyfikator_sesji']= session_id();
                    $_SESSION['id_admin']=$wynik1->id_admin;
                    $_SESSION['login']=$wynik1->login;
                    $_SESSION['klient']=$_SERVER['HTTP_USER_AGENT'];
                    $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
                    header('Location:indexlog_1.php');
                    exit();
                } else {
                    header("Location:index.php?logowanie=no");
                    exit();
                }
    }
    function sessVerify(){
        if(!isset($_SESSION['id_admin']) || $_SESSION['identyfikator_sesji'] != session_id() || $_SESSION['ip'] != $_SERVER['REMOTE_ADDR'] || $_SESSION['klient']!=$_SERVER['HTTP_USER_AGENT']){
            header('Location:index.php');
            exit();
        }
    }
    
    function sessEnd(){
            $_SESSION[]=array(); //przypisuje pusta tablice. W efekcie wszystkie zmienne sesyjne giną.
            session_regenerate_id();
            session_destroy();
            header('Location:index.php');
            exit();
        
    }
}




