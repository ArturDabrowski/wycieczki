<?php

    if(empty($_POST['login'])){
        echo 'Pole login nie może być puste;<br>';
    } else {
        echo ';';
    }
    if(empty($_POST['password'])){
        echo 'Pole hasło nie może być puste;<br>';
    } else {
        echo ';';
    }

