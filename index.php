<?php
// index.php

session_start(); // Start the user session

require_once('./model/database.php');
require_once('./model/category_db.php');
require_once('./model/product_db.php');
require_once('./model/customer_db.php');
require_once('./model/address_db.php');


$action = filter_input(INPUT_POST, 'action');

if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'home';
    }
} 


switch($action){
    case 'home':
        $categories = get_categories();
        include('./home.php');
        break;
    
    
    case 'support':
        $categories = get_categories();
        include('./support.php');
        break;
    
    
    case 'shipping':
        $categories = get_categories();
        include('./shipping.php');
        break;
    
    
    case 'list_products':
        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        if($category_id === null || $category_id === false){
            $category_id = 1; // guitars if the default category to be displayed
        }
        $categories = get_categories();
        $category_name = get_category_by_id($category_id)['category_name'];
        $products = get_products_by_category_id($category_id);
        include('./products/product_list.php');
        break;
    
    
    case 'guitars':
        $categories = get_categories();
        include('./products/guitars.php');
        break;
    
    case 'customer_logout':
        if (isset($_SESSION['email_address'])) {
            session_unset();
            session_destroy();
        }
        header("Location: index.php?action=home");
        break;
    
        
    case 'customer_login':
        // If the user is already logged in, redirect to the customer page
        if (isset($_SESSION['email_address'])) {
            header("Location: index.php?action=customer_page");
            exit(); // Exit to prevent further execution
        }

        $categories = get_categories();

        $request_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

        // If the user is attemption to login, verify the inputs
        if ($request_method === 'POST') {
            $email_address = filter_input(INPUT_POST, 'email_address', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            if ($email_address && $password) {
                $customer = get_customer_info_by_email_address($email_address);

                if ($customer && password_verify($password, $customer['password'])) {
                    $_SESSION['email_address'] = $email_address;
                    $_SESSION['last_name'] = $customer['last_name'];
                    header("Location: index.php?action=customer_page");
                    exit(); // Exit to prevent further execution
                } 
                else {
                    $login_error = "Invalid credentials, please try again.";
                }
            }
        }

        // Else, display the login form
        include('./customer/customer_login.php');
        break;
        
        
    case 'customer_page':
        $categories = get_categories();

        if (isset($_SESSION['email_address'])) {
            $customer = get_customer_info_by_email_address($_SESSION['email_address']);
            $states = get_states();
            $billing_address = get_address($customer['billing_address_id']);
            $shipping_address = get_address($customer['shipping_address_id']);
            include('./customer/customer.php');
        } 
        else {
           include('./customer/customer_login.php');
        }
        break;
        
        
    case 'update_customer_info':
        // Form data
        $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
        $first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
        $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
        $email_address = filter_input(INPUT_POST, 'email_address', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
        
        $current_customer_info = get_customer_info($customer_id);
        $updated = [];
        
        if ($first_name && $first_name !== $current_customer_info['first_name']) {
            update_first_name($customer_id, $first_name);
            $updated['first_name'] = "First name updated successfully!";
        }

        if ($last_name && $last_name !== $current_customer_info['last_name']) {
            update_last_name($customer_id, $last_name);
            $updated['last_name'] =  'Last name updated successfully!';
        }

        if ($email_address && $email_address !== $current_customer_info['email_address']) {
            update_email_address($customer_id, $email_address);
            $updated['email_address'] =  'Email updated successfully!';
        }
        
        if ($password && $password !== $confirm_password) {
            $updated['confirm_password'] =  "Password do not match";
        } else if ($password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            if (!password_verify($password, $current_customer_info['password'])) {
                update_password($customer_id, $hashed_password);
                $updated['password'] =  "Password updated successfully!";
            }
        }

        if (empty($updated)) {
            echo '<script>';
            echo 'alert("No form changes detected.");';
            echo '</script>';
        }

        // Retrieve information needed to display the customer page
        $categories = get_categories();
        $customer = get_customer_info($customer_id);
        $states = get_states();
        $billing_address = get_address($customer['billing_address_id']);
        $shipping_address = get_address($customer['shipping_address_id']);

        // Display the customer page
        include('./customer/customer.php');
        
        break;

    
    case 'update_billing_address':
    case 'update_shipping_address':
        // Form data
        $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
        $address_id = filter_input(INPUT_POST, 'address_id', FILTER_VALIDATE_INT);
        $line1 = filter_input(INPUT_POST, 'line1', FILTER_SANITIZE_STRING);
        $line2 = filter_input(INPUT_POST, 'line2', FILTER_SANITIZE_STRING);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
        $zip_code = filter_input(INPUT_POST, 'zip_code', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
        
        $current_customer_info = get_customer_info($customer_id);
        $current_customer_address = get_address($address_id);
        
        if(   ($line1 && $line1 !== $current_customer_address['line1'])  
           || ($line2 && $line2 !== $current_customer_address['line2'])  
           || ($city  && $city !== $current_customer_address['city'])
           || ($state && $state !== $current_customer_address['state'])
           || ($zip_code && $zip_code !== $current_customer_address['zip_code'])
           || ($phone && $phone !== $current_customer_address['phone']) 
        ){
            update_address($address_id, $line1, $line2, $city, $state, $zip_code, $phone);
            $message = "Address update successful.";
        } else {
            $message = "No form changes detected.";
        }

        echo '<script>';
        echo 'alert("' . $message . '");';
        echo '</script>';
        
        // Retrieve information needed to display the customer page
        $categories = get_categories();
        $customer = get_customer_info($customer_id);
        $states = get_states();
        $billing_address = get_address($customer['billing_address_id']);
        $shipping_address = get_address($customer['shipping_address_id']);
        
        // Display the customer page
        include('./customer/customer.php');
        
        break;
        
        
    default: 
        $categories = get_categories();
        include('./home.php');
}

?>

