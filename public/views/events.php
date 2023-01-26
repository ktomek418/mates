<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b35c7465a2.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search_event.js" defer></script>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>Planned</title>
</head>
<body>
    <div class="base-container">
        <?php include('navigation.php') ?>
        <main>
            <header>
                <div class="search-bar">
                    <?php if ($planned == false): ?>
                    <form action="eventsLike" method="get">
                        <input type="text" name="query" placeholder="Szukaj w wydarzeniach">
                    </form>
                    <?php else: ?>
                        <form action="plannedLike" method="get">
                            <input type="text" name="query" placeholder="Szukaj w wydarzeniach">
                        </form>
                    <?php endif; ?>
                </div>

                <div class="button" id="top-button" onclick="window.location.href='/newEvent'">
                    <i class="fa-sharp fa-solid fa-plus"></i>
                    Nowe wydarzenie
                </div>
            </header>
            <hr>
            <section class="events">
                <?php foreach ($events as $event): ?>
                    <?php include('single-event.php') ?>
                <?php endforeach; ?>
            </section>

        </main>
    </div>
</body>
</html>