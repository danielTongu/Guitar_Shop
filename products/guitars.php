<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Guitar Shop"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="/Assignment10/styles/main.css"/>
        <link rel="stylesheet" href="/Assignment10/styles/guitars.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
        <title>Guitars</title>
    </head>
    <body>
        <?php include('./view/header.php'); ?>
        <?php include('./view/horizontal_nav_bar.php'); ?>
        <main>
            <?php include('./view/aside.php'); ?>
            <section>
                <h2>Our Guitars</h2>
                <p>Check out our fine selection of premium guitars!</p>
                <div><!-- bxSlider -->
                    <div>
                        <img alt="Caballero 11" src="/Assignment10/images/guitars/Caballero11.png" title="Caballero 11"/>
                    </div>
                    <div>
                        <img alt="Fender Stratocaster" src="/Assignment10/images/guitars/FenderStratocaster.png" title="Fender Stratocaster"/>
                    </div>
                    <div>
                        <img alt="Gibson Les Paul" src="/Assignment10/images/guitars/GibsonLesPaul.png" title="Gibson Les Paul"/>
                    </div>
                    <div>
                        <img alt="Gibson SB" src="/Assignment10/images/guitars/GibsonSB.png" title="Gibson SB"/>
                    </div>
                    <div>
                        <img alt="Washburn D10S" src="/Assignment10/images/guitars/WashburnD10S.png" title="Washburn D10S"/>
                    </div>
                    <div>
                        <img alt="Yamaha FG700S" src="/Assignment10/images/guitars/YamahaFG700S.png" title="Yamaha FG700S"/>
                    </div>
                </div>
            </section>
        </main>
        <?php include('./view/footer.php'); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
        <script src="/Assignment10/scripts/guitars.js"></script>
    </body>
    
</html>