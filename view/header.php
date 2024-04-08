<header>
    <div>
        <img src="/Assignment10/images/misc/FenderStratocasterHeader.png" alt="The Guitar Store Logo"/>
        <h2>The Guitar Store</h2>
        <h3>For rock stars everywhere!</h3>
    </div>
    <form action="index.php" method="post">
        <img src="/Assignment10/images/misc/customers-1.ico" alt="Login_Icon_Button" />
        <div>
            <button type="submit" name="action" value="customer_login">Login</button>
            <?php if (isset($_SESSION['email_address'])): ?>
                <br><button type="submit" name="action" value="customer_logout">Logout</button>
            <?php endif; ?>
        </div>
    </form>
</header>