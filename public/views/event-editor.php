<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b35c7465a2.js" crossorigin="anonymous"></script>
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
                Anuluj edycje
            </div>
        </header>
        <hr>
        <section class="event-creator">
            <form action="updateEvent" method="POST" ENCTYPE="multipart/form-data">
                <h2>Edycja wydarzenia</h2>
                <input name="title" type="text" placeholder="Podaj tytuł swojego wydarzenia" value="<?=$event->getTitle() ?>">
                <input name="localisation" type="text" placeholder="Podaj lokalizacje wydarzenia" value="<?=$event->getLocalisation() ?>">
                <input name="date" type="date" placeholder="Wybierz datę wydarzenia" value="<?=$event->getDate() ?>">
                <input name="duration" type="text" placeholder="Podaj długość wydarzenia" value="<?=$event->getDuration() ?>">
                <textarea name="description" rows="4" placeholder="Opisz swoje wydarzenie">
                    <?=$event->getDescription()?>
                </textarea>
                <label class="custom-file-upload">
                    <input type="file" name="file" placeholder="">
                    <i class="fa-solid fa-image"></i>
                </label>
                <input type="hidden" name="eventId" value="<?=$event->getId() ?>">
                <button type="submit">Zapisz zmiany</button>
            </form>
        </section>

    </main>
</div>
</body>
</html>