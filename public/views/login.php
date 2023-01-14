<!DOCTYPE html>
<html lang="en" xmlns:color="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>LOGIN PAGE</title>
</head>
<body>
    <div class="container">
        <div class ="logo">
            <img src="public/img/image2vector.svg">
        </div>
        <div class="login-container">
        <form class="form" action="login" method="post">
            <div class="messages">
                <?php
                if(isset($messages)){
                    foreach($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name= "email" type="text" placeholder="email" >
            <input type="password" name="password" placeholder="hasło">
            <button type="submit">LOGIN</button>
        </form>
        </div>
    </div>
</body>
</html>