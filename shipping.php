<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Guitar Shop"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>The Guitar Shop | Shipping</title>
        <link rel="stylesheet" href="/Assignment10/styles/main.css"/>
        <link rel="stylesheet" href="/Assignment10/styles/shipping.css"/>
    </head>
    <body>
        <?php include('./view/header.php'); ?>
        <?php include('./view/horizontal_nav_bar.php'); ?>
        <main>
            <?php include('./view/aside.php'); ?>
            <section>
                <h2>Shipping Costs</h2>
                <div>
                    <label for="productCost">Enter cost of the product</label>
                    <input type="text" id="productCost" name="productCost" />
                    <input type="button" value="Calculate" id="calculate" name="calculate" />
                </div>
                <div>
                    <label for="totalCost">Total cost, including shipping</label>
                    <input type="text" id="totalCost" name="totalCost" disabled />
                </div>
            </section>
        </main>
        <?php include('./view/footer.php') ?>
        <script src="/Assignment10/scripts/shipping.js"></script>
    </body>
</html>
