<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b35c7465a2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/navigation.css">
    <link rel="stylesheet" type="text/css" href="../css/event-creator.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Planned</title>
</head>
<body>
<div class="base-container">
    <nav>
        <img src="../img/image2vector.svg">
        <ul>
            <li>
                <form method="POST" action="logout">
                    <i class="fa fa-calendar"></i>
                    <button type="submit" class="button">Zaplanowane</button>
                </form>
            </li>
            <li>
                <form method="POST" action="logout">
                    <i class="fa fa-globe"></i>
                    <button type="submit" class="button">Wydarzenia</button>
                </form>
            </li>
            <li>
                <form method="POST" action="logout">
                    <i class="fa fa-users"></i>
                    <button type="submit" class="button">Zaproszenia</button>
                </form>
            </li>
            <li>
                <form method="POST" action="logout">
                    <i class="fa fa-gear"></i>
                    <button type="submit" class="button">Ustawienia</button>
                </form>
            </li>
            <li>
                <form method="POST" action="logout">
                    <i class="fa fa-gear"></i>
                    <button type="submit" class="button">Wyloguj</button>
                </form>
            </li>
        </ul>
    </nav>

    <main>
        <header>
            <div class="search-bar">
                <form>
                    <input placeholder="Szukaj w wydarzeniach">
                </form>
            </div>
            <button class="open-event-creator">
                <i class="fa-duotone fa-plus"></i>
                Nowe wydarzenie
            </button>
        </header>
        <hr>
        <section id="event-creator">
                <h1>UPLOAD</h1>
            <form action="add-event" method="post" ENCTYPE="multipart/form-data">
                <input name="title" type="text" placeholder="title">
                <input name="maxParticipants" type="number" placeholder="maxParticipants">
                <input name="localisation" type="text" placeholder="localisation">
                <input name="date" type="date" placeholder="date">
                <input name="duration" type="text" placeholder="duration">
                <textarea name="description" rows="5" placeholder="description"></textarea>
                <input type="file" name="file">
                <button type="submit">Zapisz</button>
            </form>
        </section>

    </main>
</div>
</body>
</html>