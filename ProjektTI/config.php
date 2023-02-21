<?php
$host = "localhost";
$username  = "root";
$password = "";
$databaseName = "quizdb";

$DataBase = new mysqli($host,$username,$password,$databaseName);
$DataBase->set_charset("utf8");
