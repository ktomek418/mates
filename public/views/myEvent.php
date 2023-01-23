<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b35c7465a2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="public/css/event.css">
    <title>Planned</title>
</head>
<body>
    <div class="project">
        <div class="main-section">
            <img src="public/uploads/<?=$event->getImage() ?>">
            <ul class="event-description">
                <li>
                    <h2>Title: <?=$event->getTitle() ?></h2>
                </li>
                <li>
                    <i class="fa-solid fa-user-group"></i>
                    <p>Uczestnicy: <?=$event->getParticipants() ?>/<?=$event->getMaxParticipants() ?> </p>
                </li>
                <li>
                    <i class="fa-solid fa-location-dot"></i>
                    <p>Lokalizacja: <?=$event->getLocalisation() ?></p>
                </li>
                <li>
                    <i class="fa-solid fa-calendar-days"></i>
                    <p>Data: <?=$event->getDate() ?></p>
                </li>
                <li>
                    <i class="fa-solid fa-clock"></i>
                    <p>Czas trwania: <?=$event->getDuration() ?></p>
                </li>
                <li>
                    <i class="fa-solid fa-circle-info"></i>
                    <p>Informacje: <?=$event->getDescription() ?></p>
                </li>
            </ul>
        </div>
        <div class="buttons-section">
            <button class="project-button">
                <i class="fa-solid fa-pen-to-square"></i>
                Edytuj
            </button>
            <button class="project-button">
                <i class="fa-solid fa-ban"></i>
                Anuluj
            </button>
        </div>
    </div>

</body>
</html>