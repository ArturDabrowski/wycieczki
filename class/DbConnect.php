<?php
 class DbConnect {
    public $db;
    
    function __construct() {
        $this->db = new mysqli(SERVER,USER,PASSWORD,DB);
        
    }
    function __destruct() {
//        $this->db->exit();
    }
  }