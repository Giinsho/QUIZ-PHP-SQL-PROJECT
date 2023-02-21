<?php
require_once("config.php");

if($DataBase->connect_error){
    die("Connection failed: ". $DataBase->connect_error );
}
if(isset($_GET['id']) && isset($_POST['pytanie'])  && isset($_POST['odp1']) && isset($_POST['odp2']) && isset($_POST['odp3']) && isset($_POST['odp4'])&& isset($_POST['nrOdp']) ){
    if($DataBase){
        $str = sprintf("UPDATE `pytania` SET  `pytanie` = '%s', `odp1` = '%s', `odp2` = '%s', `odp3` = '%s', `odp4` = '%s', `nrOdp` = '%d' WHERE `id` = %d",
            htmlspecialchars($_POST['pytanie']),
            htmlspecialchars($_POST['odp1']),
            htmlspecialchars($_POST['odp2']),
            htmlspecialchars($_POST['odp3']),
            htmlspecialchars($_POST['odp4']),
            htmlspecialchars($_POST['nrOdp']),
            htmlspecialchars($_GET['id'])
        );
        $result = $DataBase->query($str);
        $DataBase->close();
    }
}
header('Location: edycja.php?id='.$_GET['id']);
