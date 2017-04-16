<?php
  $page='start';
  $title='Strona startowa';

    if (isset($_GET['page'])) {
    $page = $_GET['page'];    
    }   
    
    switch ($page){
        case 'nie_pamietam':
            $page = 'nie_pamietam';
            $title='Przypomnij haslo';
            break;
        case 'resetHasla':
            $page = 'resetHasla';
            $title='Resetuj haslo';
            break;
        default:
            $page = 'start';
        }
