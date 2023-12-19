<?php

 //$dsn = "mysql:dbname=codig267_db_teste1;host=localhost";
 //$dbuser="root";
 //$dbpass = "";

 $dsn = "mysql:dbname=codig267_db_teste1;host=108.167.151.55";
 $dbuser="codig267_db_teste1";
 $dbpass = "Alves1974#";

 try {

 	$pdo = new PDO( $dsn,$dbuser,$dbpass);

 	
 } catch (PDOException $e) {

 	echo "Falhou :".$e->getMessage();
 	
 }










?>