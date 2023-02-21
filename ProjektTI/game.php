<!DOCTYPE html>
<html lang="pl">
<?php

require_once("config.php");
if($DataBase->connect_error){
    die("Connection failed: ". $DataBase->connect_error );
}
if($DataBase){
    $result =  $DataBase->query("SELECT * FROM pytania");
}

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
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz - play</title>
    <link rel="stylesheet" href="app.css" />
    <link rel="stylesheet" href="game.css" />
</head>
<body>
    <div class="container">

        <div id="game" class="justify-center flex-column">

            <div id="hud">
                <div id="hud-item">
                    <p id="progressText" class="hud-prefix">
                        Pytanie
                    </p>
                    <div id="progressBar">
                        <div id="progressBarFull"></div>
                    </div>

                </div>


                <div id="hud-item">
                    <p class="hud-prefix">
                        Wynik
                    </p>
                    <h1 class="hud-main-text" id="score">
                        0
                    </h1>
                </div>

            </div>

            <h2 id = "question">Pytanie... ?</h2>

            <div class="choice-container">
                <p class="choice-prefix">A</p>
                <p class="choice-text" data-number="1">Odpowiedz 1</p>
            </div>

            <div class="choice-container">
                <p class="choice-prefix">B</p>
                <p class="choice-text" data-number="2">Odpowiedz 2</p>
            </div>

            <div class="choice-container">
                <p class="choice-prefix">C</p>
                <p class="choice-text" data-number="3">Odpowiedz 3</p>
            </div>

            <div class="choice-container">
                <p class="choice-prefix">D</p>
                <p class="choice-text" data-number="4">Odpowiedz 4</p>
            </div>

        </div>
    </div>
<script>
    const question = document.getElementById("question");
    const choices = Array.from(document.getElementsByClassName("choice-text"));
    const progressText = document.getElementById("progressText");
    const scoreText = document.getElementById("score");
    const progressBarFull = document.getElementById("progressBarFull");

    console.log(choices);
    let obecnePytanie = {};
    let poprawneOdpowiedzi = true;
    let wynik = 0;
    let licznikPytan = 0;
    let MozliweOdpowiedzi = [];

    // tworzenie tablicy pytan
    let pytania = [
        <?php
        for($i=0; $i < count($indeksPytania); $i++){
            echo "{\n";
            echo "question:", "\"$pytanie[$i]\"" , ",\n";
            echo "choice1:", "\"$odp1[$i]\"" , ",\n";
            echo "choice2:" , "\"$odp2[$i]\"" , ",\n";
            echo "choice3:" , "\"$odp3[$i]\"" , ",\n";
            echo "choice4:" , "\"$odp4[$i]\"" , ",\n";
            echo "answer:" , "\"$nrOdp[$i]\"\n" ;
            if($i < count($indeksPytania)-1){
                echo "},\n";
            } else {
                echo "}\n";
            }

        }
        ?>
    ];

    const BONUS = 10;
    let MAX_ILOSC_PYTAN;

    // maksymalna ilosc pytań
    <?php
    echo "MAX_ILOSC_PYTAN=", count($indeksPytania),";";
    ?>



    startGame = () => {
        licznikPytan = 0 ;
        wynik = 0;

        // kopiowanie zawartosci z tablicy questions
        MozliweOdpowiedzi = [...pytania];
        console.log(MozliweOdpowiedzi);
        getNewQuestion();
    };

    // pobieranie nowego pytania
    getNewQuestion = () => {

        if(MozliweOdpowiedzi.length === 0 || licznikPytan >= MAX_ILOSC_PYTAN){
            //przechowanie wyniku, aby potem uzyc go w end.js - jako finalScore
            localStorage.setItem('score',wynik);
            //koniec gry => przejscie do strony konca gry
            return window.location.assign("end.html");
        }

        licznikPytan++;
        progressText.innerText = "Pytanie "+licznikPytan+"/"+ MAX_ILOSC_PYTAN;

        //zwiekszanie paska progressu - ustawianie procentów w stylach
        progressBarFull.style.width = `${(licznikPytan / MAX_ILOSC_PYTAN) * 100}%`;

        //losowanie pytania
        const questionIndex = Math.floor(Math.random() * MozliweOdpowiedzi.length);
        obecnePytanie = MozliweOdpowiedzi[questionIndex];
        question.innerText = obecnePytanie.question;


        choices.forEach(choice => {
            const number = choice.dataset['number'];
            choice.innerText = obecnePytanie['choice' + number];
        });

        // usuwanie wybranej liczby elementow

        MozliweOdpowiedzi.splice(questionIndex,1);

        poprawneOdpowiedzi = true;
    };


    // klikniecie na pytanie wywoluje dalsze działania
    choices.forEach(choice => {
        choice.addEventListener('click', e =>{
            console.log(e.target);
            if(!poprawneOdpowiedzi) return;

            
            poprawneOdpowiedzi = false;
            const selectedChoice = e.target;
            const selectedAnswer = selectedChoice.dataset["number"];

            //  === porównuje typ, == porównuje zawartosc pomijajac typ danych
            const classToApply =
                selectedAnswer == obecnePytanie.answer ? "correct" : "incorrect";

            if(classToApply === "correct"){
                incrementScore(BONUS);
            }

            //wyklucza powtarzanie sie pytań ->
            selectedChoice.parentElement.classList.add(classToApply);

            //mała przerwa po zaznaczeniu odpowiedzi oraz usuwanie pytania
            setTimeout( () => {
                selectedChoice.parentElement.classList.remove(classToApply);
                getNewQuestion();
            },1000);
        });
    });

    // zwiekszanie wyniku  -- 10 za poprawne
    incrementScore = num => {
        wynik += num;
        scoreText.innerText = wynik;
    };

    startGame();
</script>
</body>
</html>