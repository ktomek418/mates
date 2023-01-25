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
                <?php if ($myApplications == true): ?>
                    <div class="button" id="top-button" onclick="window.location.href='/receivedApplication'">
                        <i class="fa-solid fa-user"></i>
                        Otrzymane
                    </div>
                <?php else: ?>
                    <div class="button" id="top-button" onclick="window.location.href='/myApplication'">
                        <i class="fa-solid fa-user"></i>
                        Moje zgłoszenia
                    </div>
                <?php endif; ?>

            </header>
            <hr>
            <section class="applications">
                <?php foreach ($applications as $application): ?>
                    <?php if ($myApplications == true): ?>
                        <div class="application">
                            <div class="application-info">
                                <p>Użytkownik <?=$application->getUserName() ?></p>
                                <h3>Otrzymał twoje zgłoszenie do wydarzenia <?=$application->getEventTitle() ?></h3>
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
                    <?php else: ?>
                        <div class="application">
                            <div class="application-info">
                                <p>Użytkownik <?=$application->getUserName() ?></p>
                                <h3>Chciałby dołączyć do wydarzenia <?=$application->getEventTitle() ?>, którego jesteś organizatorem</h3>
                            </div>
                            <div class="application-actions">
                                <form method="post" action="/cancelApplication">
                                    <input type="hidden" name="applicationId" value="<?=$application->getId() ?>">
                                    <button class="application-button" type="submit">
                                        <i class="fa-solid fa-ban"></i>
                                        <p>Odrzuć</p>
                                    </button>
                                </form>
                                <form method="post" action="/acceptApplication">
                                    <input type="hidden" name="applicationId" value="<?=$application->getId() ?>">
                                    <button class="application-button" type="submit">
                                        <i class="fa-solid fa-check"></i>
                                        <p>Akceptuj</p>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                    <hr>
                <?php endforeach; ?>
            </section>

        </main>
    </div>
</body>
</html>