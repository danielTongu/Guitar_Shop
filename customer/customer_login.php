<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Guitar Shop"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Customer Login</title>
    <link rel="stylesheet" href="/Assignment10/styles/main.css"/>
    <link rel="stylesheet" href="/Assignment10/styles/customer_login.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
</head>
<body>
    <?php include('./view/header.php'); ?>
    <?php include('./view/horizontal_nav_bar.php'); ?>
    <main>
        <?php include('./view/aside.php'); ?>
        <section>
            <h2>Customer Login</h2>
            <form action="index.php" method="post">
                <input type="hidden" name="action" value="customer_login" />
                
                <label for="email_address">Email Address:</label>
                <input type="email" name="email_address" required value="<?php echo isset($_POST['email_address']) ? htmlspecialchars($_POST['email_address']) : ''; ?>"/>
                
                <label for="password">Password:</label>
                <div>
                    <input type="password" name="password" required value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>"/>
                    <i class="far fa-eye-slash"></i>
                </div>
                
                <div>
                    <input type="submit" value="Login" />
                    <input type="button" value="Cancel" onclick="window.location.href='index.php'" />
                </div>
            </form>
            
            <?php if(isset($login_error)): ?>
                <script>
                    alert("<?php echo $login_error; ?>");
                </script>
            <?php endif; ?>
            
        </section>
    </main>
    <?php include('./view/footer.php'); ?>
</body>
</html>