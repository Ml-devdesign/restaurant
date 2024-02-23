<?php 
    try {
        $db= new PDO("mysql:host=localhost;dbname=restaurant;charset=utf8",
        "root", 
        "");
    } catch (PDOException $e) {
        echo $e->getMessage();
        die("Failed to connect to");
        }   

?>