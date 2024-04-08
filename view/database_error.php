<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Guitar Shop"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Database Error</title>
        <link rel="stylesheet" href="/Assignment10/styles/main.css"/>
    </head>
    <body>
        <?php include './header.php'; ?>
        <?php include './horizontal_nav_bar.php'; ?>
        <main>
            <?php include './aside.php'; ?>
            <section>
                <h2>Database Error</h2>
                <p><?php $error_message ?></p>
            </section>
        </main>
        <?php include './footer.php'; ?>
    </body>
</html>

