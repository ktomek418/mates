<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b35c7465a2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
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
                <div class="button" id="top-button" onclick="window.location.href='/receivedApplication'">
                    <i class="fa-solid fa-user"></i>
                    Nadesłane zgłoszenia
                </div>

            </header>
            <hr>
            <section class="applications">
                <?php foreach ($applications as $application): ?>
                    <div class="application">
                        <div class="application-info">
                            <p><?=$application->getUserName() ?></p>
                            <h3>Twoje zgłoszenie do wydarzenia <?=$application->getEventTitle() ?> oczekuje na decyzje organizatora</h3>
                        </div>
                        <div class="application-actions">
                            <form method="post" action="/cancelApplication">
                                <input type="hidden" name="applicationId" value="<?=$application->getId() ?>">
                                <button class="application-button" type="submit">
                                    <i class="fa-solid fa-ban"></i>
                                    <p>Wycofaj zgłoszenie</p>
                                </button>
                            </form>
                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>
            </section>

        </main>
    </div>
</body>
</html>