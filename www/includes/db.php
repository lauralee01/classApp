<?php

    define('DBNAME', 'classApp');
    define('DBUSER', 'root');
    define('DBPASS', 'graced01');

    try{

    $conn = new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

    } catch(PDOException $err) {

        echo $err->getMessage();
    }

?>