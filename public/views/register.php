<!DOCTYPE html>
<html lang="en" xmlns:color="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script type="text/javascript" src="./public/js/login-validator.js" defer></script>
    <title>LOGIN PAGE</title>
</head>
<body>
    <div class="image-container">
        <div class ="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class="register-container">
        <form class="register-form" action="register" method="POST">
            <div class="messages">
                <?php
                if(isset($messages)){
                    foreach($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name= "name" type="text" placeholder="Nazwa użytkownika" >
            <input name= "email" type="text" placeholder="Email" >
            <input type="password" name="password" placeholder="Hasło">
            <input type="password" name="repeatPassword" placeholder="Powtórz hasło">
            <button type="submit">Zarejestruj</button>
            <div class="button" onclick="window.location.href='/login'">PANEL LOGOWANIA</div>
        </form>
        </div>
    </div>
</body>
</html>