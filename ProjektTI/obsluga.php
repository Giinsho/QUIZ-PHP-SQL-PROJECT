<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Obsluga</title>
    <link rel="stylesheet" href="obsluga.css"/>
</head>

<body>
<div class="login-box">
    <h1>Login</h1>
    <form method="POST" action="logowanie.php">
        <div class="textbox">
            <input type="text" placeholder="Nazwa" name="nick" value="" >
        </div>

        <div class="textbox">
            <input type="password" placeholder="Hasło" name="haslo" value="" >
        </div>

        <input class="btn" type="submit" name="submit" value="Zaloguj">
    </form>
    <form action="index.html">
        <input class="btn" type="submit" name="submit" value="Powrót">
    </form>
</div>
</body>
</html>