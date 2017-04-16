<?php

define('EMAIL_ADMIN', 'dabczasty89@gamil.com');
define('SERVER', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DB', 'wycieczki');
define('WITRYNA', 'http://localhost/wycieczki/');



function __autoload($className) {
    require 'class/'.$className.'.php';
}

