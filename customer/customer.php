<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Guitar Shop"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Customer</title>
        <link rel="stylesheet" href="/Assignment10/styles/main.css"/>
        <link rel="stylesheet" href="/Assignment10/styles/customer.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    </head>
    <body>
        <?php include('./view/header.php'); ?>
        <?php include('./view/horizontal_nav_bar.php'); ?>
        <main>
            <?php include('./view/aside.php'); ?>
            <section>
                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="update_customer_info" />
                    <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($customer['customer_id']); ?>" required />

                    <h2>Customer Information</h2>

                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" value="<?php echo htmlspecialchars($customer['first_name']); ?>" required />
                    <input type="text" name="confirmation" value="<?php echo isset($updated['first_name']) ? $updated['first_name'] : ''; ?>" readonly /><br>

                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" value="<?php echo htmlspecialchars($customer['last_name']); ?>" required />
                    <input type="text" name="confirmation" value="<?php echo isset($updated['last_name']) ? $updated['last_name'] : ''; ?>" readonly /><br>

                    <label for="email_address">Email:</label>
                    <input type="text" name="email_address" value="<?php echo htmlspecialchars($customer['email_address']); ?>" required />
                    <input type="text" name="confirmation" value="<?php echo isset($updated['email_address']) ? $updated['email_address'] : ''; ?>" readonly /><br>

                    <label for="password">Password:</label>
                    <div>
                        <input type="password" name="password" />
                        <i class="far fa-eye-slash"></i>
                    </div>
                    <input type="text" name="confirmation" value="<?php echo isset($updated['password']) ? $updated['password'] : ''; ?>" readonly /><br>
                    
                    <label for="confirm_password">Confirm Password:</label>
                    <div>
                        <input type="password" name="confirm_password" />
                        <i class="far fa-eye-slash"></i>
                    </div>
                    <input type="text" name="confirmation" value="<?php echo isset($updated['confirm_password']) ? $updated['confirm_password'] : ''; ?>" readonly /><br>

                    <button type="submit">Update Customer Information</button>
                </form>

                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="update_billing_address"/>
                    <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($customer['customer_id']); ?>" required/>
                    <input type="hidden" name="address_id" value="<?php echo htmlspecialchars($customer['billing_address_id']); ?>" required/>

                    <h2>Billing Address</h2>

                    <label for="line1">Address Line 1:</label>
                    <input type="text" name="line1" value="<?php echo htmlspecialchars($billing_address['line1']); ?>" required/><br>

                    <label for="line2">Address Line 2:</label>
                    <input type="text" name="line2" value="<?php echo htmlspecialchars($billing_address['line2']); ?>"/><br>

                    <label for="city">City:</label>
                    <input type="text" name="city" value="<?php echo htmlspecialchars($billing_address['city']); ?>" required/><br>

                    <label for="state">State:</label>
                    <select name="state" required>
                        <?php
                            foreach ($states as $stateOption) :
                                $selected = ($billing_address['state'] == $stateOption['state']) ? 'selected' : '';
                                echo "<option value=\"{$stateOption['state']}\" $selected>{$stateOption['state']}</option>";
                            endforeach;
                        ?>
                    </select><br>

                    <label for="zip_code">Zip Code:</label>
                    <input type="text" name="zip_code" value="<?php echo htmlspecialchars($billing_address['zip_code']); ?>" required/><br>

                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" value="<?php echo htmlspecialchars($billing_address['phone']); ?>" required/><br>

                    <button type="submit">Update Billing Address</button>
                </form>

                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="update_shipping_address" />
                    <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($customer['customer_id']); ?>" required/>
                    <input type="hidden" name="address_id" value="<?php echo htmlspecialchars($customer['shipping_address_id']); ?>" required/>

                    <h2>Shipping Address</h2>

                    <label for="line1">Address Line 1:</label>
                    <input type="text" name="line1" value="<?php echo htmlspecialchars($shipping_address['line1']); ?>" required/><br>

                    <label for="line2">Address Line 2:</label>
                    <input type="text" name="line2" value="<?php echo htmlspecialchars($shipping_address['line2']); ?>"/><br>

                    <label for="city">City:</label>
                    <input type="text" name="city" value="<?php echo htmlspecialchars($shipping_address['city']); ?>" required/><br>

                    <label for="state">State:</label>
                    <select name="state" required>
                        <?php
                            foreach ($states as $stateOption) :
                                $selected = ($shipping_address['state'] == $stateOption['state']) ? 'selected' : '';
                                echo "<option value=\"{$stateOption['state']}\" $selected>{$stateOption['state']}</option>";
                            endforeach;
                        ?>
                    </select><br/>

                    <label for="zip_code">Zip Code:</label>
                    <input type="text" name="zip_code" value="<?php echo htmlspecialchars($shipping_address['zip_code']); ?>" required/><br>

                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" value="<?php echo htmlspecialchars($shipping_address['phone']); ?>"required/><br>

                    <button type="submit">Update Shipping Address</button>
                </form>
            </section>
        </main>
        <?php include('./view/footer.php'); ?>
        <script src="/Assignment10/scripts/customers.js"></script>
    </body>
</html>
