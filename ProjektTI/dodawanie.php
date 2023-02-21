<?php
require_once("config.php");

if($DataBase->connect_error){
    die("Connection failed: ". $DataBase->connect_error );
}
if($DataBase) {
    $result = $DataBase->query("SELECT * FROM pytania");
    while($row = $result->fetch_assoc()) {
        $indeksPytania[] = $row["id"];
        $pytanie[] = $row["pytanie"];
        $odp1[] = $row["odp1"];
        $odp2[] = $row["odp2"];
        $odp3[] = $row["odp3"];
        $odp4[] = $row["odp4"];
        $nrOdp[] = $row["nrOdp"];
    }
    $DataBase->close();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dodawanie pytania</title>
    <link rel="stylesheet" href="dodawanie.css"/>
</head>

<body>
<div class="login-box">
    <h1>Dodaj pytanie</h1>
    <form method="POST" action="dodawanieDB.php">
        <div class="textbox">
            <input type="text" placeholder="Pytanie" name="pytanie" value="" required>
        </div>

        <div class="textbox">
            <input type="text" placeholder="Odpowiedź nr 1" name="odp1" value="" required>
        </div>

        <div class="textbox">
            <input type="text" placeholder="Odpowiedź nr 2" name="odp2" value="" required>
        </div>

        <div class="textbox">
            <input type="text" placeholder="Odpowiedź nr 3" name="odp3" value="" required>
        </div>

        <div class="textbox">
            <input type="text" placeholder="Odpowiedź nr 4" name="odp4" value="" required>
        </div>

        <div class="textbox">
            <input type="number" placeholder="Nr poprawnej odpowiedzi" name="nrOdp" min="1" max="4" required>
        </div>

        <input class="btn" type="submit" name="submit" value="Dodaj">
    </form>
    <form action="admin.php">
        <input class="btn" type="submit" name="submit" value="Powrót">
    </form>
</div>
</body>
</html>
