<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Obsluga</title>
    <link rel="stylesheet" href="admin.css"/>
</head>

<body>
<div class="login-box">
    <h1>Wybierz opcje</h1>
    <form  action="dodawanie.php">
        <input class="btn" type="submit" name="submit" value="Dodawanie">
    </form>

    <form  action="edycja.php">
        <input class="btn" type="submit" name="submit" value="Edycja">
    </form>

    <form  action="usuwanie.php">
        <input class="btn" type="submit" name="submit" value="Usuwanie">
    </form>

    <form action="index.html">
        <input class="btn" type="submit" name="submit" value="Powrót">
    </form>
</div>

</body>
</html>