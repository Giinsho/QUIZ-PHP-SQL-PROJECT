<?php
require_once("config.php");

if($DataBase->connect_error){
    die("Connection failed: ". $DataBase->connect_error );
}
if($DataBase) {
    $result = $DataBase->query("SELECT * FROM pytania");
    $pytanie= [];

        $PostyBaza = $DataBase->query("SELECT * FROM pytania WHERE id = ".$_GET['id']);
        while($row = $PostyBaza->fetch_assoc()){
            $pytanie = $row;
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
    <title>Eydytowanie pytania</title>
    <link rel="stylesheet" href="dodawanie.css"/>
</head>

<body>
<div class="login-box">
    <h1>Edytuj pytanie</h1>
    <form method="POST" action="edytowanieDB.php<?php echo "?id"?>=<?php echo $pytanie['id'] ?>">
        <div class="textbox">
            <input type="text" placeholder="Pytanie" name="pytanie" value="<?php echo $pytanie['pytanie'] ?>" required>
        </div>

        <div class="textbox">
            <input type="text" placeholder="Odpowiedź nr 1" name="odp1" value="<?php echo $pytanie['odp1'] ?>" required>
        </div>

        <div class="textbox">
            <input type="text" placeholder="Odpowiedź nr 2" name="odp2" value="<?php echo $pytanie['odp2'] ?>" required>
        </div>

        <div class="textbox">
            <input type="text" placeholder="Odpowiedź nr 3" name="odp3" value="<?php echo $pytanie['odp3'] ?>" required>
        </div>

        <div class="textbox">
            <input type="text" placeholder="Odpowiedź nr 4" name="odp4" value="<?php echo $pytanie['odp4'] ?>" required>
        </div>

        <div class="textbox">
            <input type="number" placeholder="Nr poprawnej odpowiedzi" name="nrOdp" min="1" max="4"  value="<?php echo $pytanie['nrOdp'] ?>" required>
        </div>

        <input class="btn" type="submit" name="submit" value="Edytuj">
    </form>
    <form action="edycja.php">
        <input class="btn" type="submit" name="submit" value="Powrót">
    </form>
</div>
</body>
</html>
