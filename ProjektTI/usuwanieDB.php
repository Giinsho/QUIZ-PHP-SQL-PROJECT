<?php
require_once("config.php");

if($DataBase->connect_error){
    die("Connection failed: ". $DataBase->connect_error );
}

if(isset($_GET['id'])){
    if($DataBase){
        $usuwanie = sprintf("DELETE FROM `pytania` WHERE `id`='%d'",htmlspecialchars($_GET['id']));
        $result = $DataBase->query($usuwanie);
        $DataBase->close();
    }
}

header('Location: usuwanie.php?id='.$_GET['id']);