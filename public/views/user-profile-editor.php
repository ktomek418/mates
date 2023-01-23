<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b35c7465a2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/user-details-form.css">
    <title>Planned</title>
</head>
<body>
<div class="base-container">
    <?php include('navigation.php') ?>
    <main>
        <header>
            <div class="search-bar">
                <form>
                    <input placeholder="Szukaj w wydarzeniach">
                </form>
            </div>
            <form method="post" action="addEvent">
                <button type="submit" class="open-event-creator">
                    <i class="fa-duotone fa-plus"></i>
                    Nowe wydarzenie
                </button>
            </form>
        </header>
        <hr>
        <section class="user-update">
            <div class="profileImage">
                <img src="public/uploads/<?=$user->getProfileImage() ?>">
            </div>
            <form action="updateOrCreateUserDetails" method="POST" ENCTYPE="multipart/form-data">
                    <ul class="user-description">
                        <li>
                            <p>Imię</p>
                            <input name="name" type="text" placeholder="Podaj nazwę użytownika">
                        </li>
                        <li>
                            <p>Nazwisko</p>
                            <input name="surname" type="text" placeholder="Podaj imię">
                        </li>
                        <li>
                            <p>Numer telefonu</p>
                            <input name="phone" type="text" placeholder="Podaj nazwisko">
                        </li>
                        <li>
                            <p>Opis</p>
                            <textarea name="description" rows="4" placeholder="Dodaj swój opis"></textarea>
                        </li>
                        <li>
                            <p>Wybierz zdjęcie profilowe</p>
                            <label class="custom-file-upload">
                                <input type="file" name="file" placeholder="">
                                <i class="fa-solid fa-image"></i>
                            </label>
                        </li>
                    </ul>
                <button type="submit" >
                    Zapisz zmiany
                </button>
            </form>
        </section>

    </main>
</div>
</body>
</html>