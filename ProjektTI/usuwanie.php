<?php
require_once("config.php");

if($DataBase->connect_error){
    die("Connection failed: ". $DataBase->connect_error );
}

if($DataBase) {
    $result = $DataBase->query("SELECT * FROM pytania");
    while($row =  $result->fetch_assoc()) {
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

    <title>Dodawanie pytania</title>
    <link rel="stylesheet" href="usuwanie.css"/>
</head>

<body>
    <div class="login-box">
        <h1>Wszystkie posty</h1>
        <div class="edycja">
            <?php
            for($i = 0 ; $i<count($indeksPytania);$i++){

                echo "<div class='pytanie'>","Pytanie:", $pytanie[$i], "</div>";
                echo "<ul>";
                echo "<li>", "Odpowiedź nr 1: ",$odp1[$i] , "</li>";
                echo "<li>", "Odpowiedź nr 2: ",$odp2[$i] , "</li>";
                echo "<li>", "Odpowiedź nr 3: ",$odp3[$i] , "</li>";
                echo "<li>", "Odpowiedź nr 4: ",$odp4[$i] , "</li>";
                echo "<li>", "Nr odpowiedzi: ",$nrOdp[$i] ,"</li>";
                echo "</ul>";
                echo "<a class='edit' href='usuwanieDB.php?id=", $indeksPytania[$i], "'>Usuń</a>";
            }
            ?>
        </div>
        <form action="admin.php">
            <input class="btn" type="submit" name="submit" value="Powrót">
        </form>
    </div>

</body>
</html>