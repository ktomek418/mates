<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b35c7465a2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="public/css/navigation.css">
    <title>Navigation</title>
</head>
<body>
    <nav>
        <img src="public/img/image2vector.svg">
        <ul>
            <li>
                <i class="fa fa-calendar"></i>
                <div class="button" id="nav-button" onclick="window.location.href='/planned'">Zaplanowane</div>
            </li>
            <li>
                <i class="fa fa-globe"></i>
                <div class="button" id="nav-button" onclick="window.location.href='/events'">Wydarzenia</div>
            </li>
            <li>
                <i class="fa fa-users"></i>
                <div class="button" id="nav-button" onclick="window.location.href='/receivedApplication'">Zaproszenia</div>
            </li>
            <li>
                <i class="fa fa-gear"></i>
                <div class="button" id="nav-button" onclick="window.location.href='/userProfile'">Ustawienia</div>
            </li>
            <li>
                <i class="fa-solid fa-right-from-bracket"></i>
                <div class="button" id="nav-button" onclick="window.location.href='/logout'">Wyloguj</div>
            </li>
        </ul>
    </nav>
</body>
</html>