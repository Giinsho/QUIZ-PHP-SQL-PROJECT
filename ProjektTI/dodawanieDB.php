<?php
require_once("config.php");

if($DataBase->connect_error){
    die("Connection failed: ". $DataBase->connect_error );
}

$nrOdpCheck = (int)isset($_POST['nrOdp']);
if(isset($_POST['pytanie']) && isset($_POST['odp1']) && isset($_POST['odp2']) && isset($_POST['odp3']) && isset($_POST['odp4']) && $nrOdpCheck){
    if($DataBase){
        $dodawanie = sprintf("INSERT INTO `pytania` (`pytanie`, `odp1`, `odp2`, `odp3`, `odp4`, `nrOdp`) VALUES ('%s', '%s', '%s', '%s', '%s' , '%d')",
            htmlspecialchars($_POST['pytanie']),
            htmlspecialchars($_POST['odp1']),
            htmlspecialchars($_POST['odp2']),
            htmlspecialchars($_POST['odp3']),
            htmlspecialchars($_POST['odp4']),
            htmlspecialchars($_POST['nrOdp'])
        );
        $result = $DataBase->query($dodawanie);
        $DataBase->close();
    }
}

header('Location: dodawanie.php');
