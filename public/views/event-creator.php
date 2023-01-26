<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b35c7465a2.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/event-validator.js" defer></script>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/event-creator-form.css">
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
            <div class="button" id="top-button" onclick="window.location.href='/planned'">
                <i class="fa-solid fa-xmark"></i>
                Anuluj
            </div>
        </header>
        <hr>
        <section class="event-creator">
            <form action="addEvent" method="POST" ENCTYPE="multipart/form-data">
                <h2>Nowe Wydarzenie</h2>
                <input name="title" type="text" placeholder="Podaj tytuł swojego wydarzenia">
                <input name="maxParticipants" type="number" placeholder="Podaj liczbę poszukiwanych osób">
                <input name="localisation" type="text" placeholder="Podaj lokalizacje wydarzenia">
                <input name="date" type="date" placeholder="Wybierz datę wydarzenia">
                <input name="duration" type="text" placeholder="Podaj długość wydarzenia">
                <textarea name="description" rows="4" placeholder="Opisz swoje wydarzenie"></textarea>
                <label class="custom-file-upload">
                    <input type="file" name="file" placeholder="">
                    <i class="fa-solid fa-image"></i>
                </label>
                <button type="submit">Zapisz</button>
            </form>
        </section>

    </main>
</div>
</body>
</html>