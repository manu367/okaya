<?php
   class DB_Connect {
   function __construct() {}
   function __destruct(){}
   public function connect() {
       $db_user = 'root';
       $db_pass = '';
       $db_host = 'localhost';
       $db = "okaya_beta";
       $con = mysqli_connect($db_host, $db_user, $db_pass,$db);
       return $con;
   }
  public function close() {
    mysqli_close();
	     }
    }
	  ?>