<?php
    require_once("config.php");

    if($DataBase->connect_error){
        die("Connection failed: ". $DataBase->connect_error );
    }

        $login = $_POST['nick'];
        $pass = $_POST['haslo'];

        $sql = "SELECT * FROM admin WHERE nick='$login' AND haslo='$pass' ";

        $result = $DataBase->query($sql);
        if($result -> num_rows >0 ){
            while($row = $result -> fetch_assoc()){
                header('Location: admin.php');
            }
        } else {
            header('Location: obsluga.php');
        }

?>

