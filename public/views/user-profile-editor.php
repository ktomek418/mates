<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b35c7465a2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/user-details.css">
    <title>Planned</title>
</head>
<body>
<div class="base-container">
    <?php include('navigation.php') ?>
    <main>
        <header>
            <div class="search-bar">
                <form action="eventsLike" method="get">
                    <input type="text" name="query" placeholder="Szukaj w wydarzeniach">
                </form>
            </div>
            <div class="button" id="top-button" onclick="window.location.href='/userProfile'">
                <i class="fa-solid fa-xmark"></i>
                Anuluj
            </div>
        </header>
        <hr>
        <section class="user-profile-editor">
            <form action="updateOrCreateUserDetails" method="POST" ENCTYPE="multipart/form-data">
                <h2>Edytor profilu użytkownika</h2>
                <input name="name" type="text" placeholder="Imię Użytkownika" value="<?=$user->getName() ?>">
                <input name="surname" type="text" placeholder="Nazwisko Użytkownika" value="<?=$user->getSurname() ?>">
                <input name="phone" type="text" placeholder="Numer telefonu użytkownika" value="<?=$user->getPhoneNumber() ?>">
                <textarea name="description" rows="4" placeholder="Opis Użytkownika" ><?=$user->getDescription() ?></textarea>
                <label class="custom-file-upload">
                    <input type="file" name="file" placeholder="">
                </label>
                <button type="submit">Zapisz</button>
            </form>
        </section>

    </main>
</div>
</body>
</html>