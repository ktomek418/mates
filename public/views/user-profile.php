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
            <?php if ($myProfile == true): ?>
            <form method="post" action="userProfileEditor">
                <button type="submit" id="top-button">
                    <i class="fa-solid fa-user-pen"></i>
                    Edytuj profil
                </button>
            </form>
            <?php else: ?>
                <div class="button" id="top-button" onclick="window.location.href='/receivedApplication'">
                    <i class="fa-solid fa-arrow-left"></i>
                    Zamknij podgląd
                </div>
            <?php endif; ?>
        </header>
        <hr>
        <section class="user-profile">
            <div class="profileImage">
                <img src="public/uploads/<?=$user->getProfileImage() ?>">
            </div>
            <div class="profile-description">
                <ul>
                    <li>
                        <h2>Profil użytkownika <?=$user->getUserName()?></h2>
                    </li>
                    <li>
                        <p>Imię: <?=$user->getName() ?></p>
                    </li>
                    <li>
                        <p>Nazwisko: <?=$user->getSurname() ?></p>
                    </li>
                    <li>
                        <p>Numer telefonu: <?=$user->getPhoneNumber() ?></p>
                    </li>
                    <li>
                        <p>Opis: <?=$user->getDescription() ?></p>
                    </li>
                </ul>
            </div>
        </section>

    </main>
</div>
</body>
</html>