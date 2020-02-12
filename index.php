<?php
//this line makes PHP behave in a more strict way
declare(strict_types = 1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}
whatIsHappening();
$name_err = $user_email_err = $user_street_err = $user_street_number_err = $user_city = $user_zip = "";// variables to hold error messages for the required field
$name = $email = $result_email = $street = $street_session = $street_number_session = $zipcode_session = $city_session = $street_no_number = $zip_no_number = $counter_elements = $message_confirmation="";
$street_session= $_SESSION['street']; $street_number_session= $_SESSION['streetnumber']; $city_session= $_SESSION['city']; $zipcode_session = $_SESSION['zipcode'];

if ($_SERVER["REQUEST_METHOD"] == "POST") { // check if it's posted
    if (isset($_POST['submit'])) {
        if (empty($_POST['name'])) { // name verification
            $name_err = 'Name is required </br>';
        } else {
            $name = test_input($_POST["name"]); // variable 'result name' to store what the post does and then to use the variable in html
            $counter_elements++;
        }
        if (empty($_POST['email'])) { // email verification
            $user_email_err = 'Email is required </br>';
        } else {
            $result_email = test_input($_POST['email']);
            // check if e-mail address is well-formed
            if (!filter_var($result_email, FILTER_VALIDATE_EMAIL)) {
                $user_email_err = 'Invalid email format </br>';
                $counter_elements++;
            }
        }
        if (empty($_POST['street'])) { // street verification ---used a session
            $user_street_err = 'Street is required </br>';
            $street_session = "";
        } else {
            $_SESSION["street"]  = test_input($_POST['street']);
            $street_session = $_SESSION['street'];
            $counter_elements++;
            }

        if (empty($_POST["streetnumber"])) { // street number verification
            $user_street_number_err = 'Street number is required </br>';
        } else {
            $_SESSION["streetnumber"] = test_input($_POST["streetnumber"]);
            $street_number_session = $_SESSION["streetnumber"];
            $counter_elements++;
            if (!is_numeric($_SESSION["streetnumber"])) { // 'is numeric' check if the characters entered into the field are numbers or not
                $street_no_number = 'Error: Invalid street number. Please enter numbers only </br>';
            }
        }
        if (empty($_POST["city"])) { // city verification
            $user_city = 'City is required </br>';
        } else {
            $_SESSION['city'] = test_input($_POST["city"]);
            $city_session = $_SESSION['city'];
            $counter_elements++;
        }
    }
        if (empty($_POST["zipcode"])) { // city verification
            $user_zip = 'Zip code is required </br>';
        } else {
            $_SESSION['zipcode'] = test_input($_POST["zipcode"]);
            $zipcode_session = $_SESSION['zipcode'];
            $counter_elements++;
            if (!is_numeric($_SESSION["zipcode"])) { // 'is numeric' check if the characters entered into the field are numbers or not
                $zip_no_number = 'Error: Invalid zipcode. Please enter numbers only </br>';
            }
        }
        /*
    $toEmail = "admin@phppot_samples.com";
    $mailHeaders = "From: " . $name . "<". $email .">\r\n";
    if(mail($toEmail, $street, $city, $mailHeaders)) {
        $message = "Your order has been received successfully.";
        $type = "success";
    }
*/
}

if ($counter_elements == 5) { // if all elements are filled in, then the message confirmation will be displayed
    $message_confirmation = "Your order has been successfully sent";
}
function test_input($data) {
    $data = trim($data); // for unnecessary spaces
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$delivery_method = [
    ['Normal delivery' => '2 hours'],
    ['Express delivery' => '45 minutes']
];

//your products with their price.

$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$products_food = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$products_drink = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];
    if (isset ($_GET['food'])) {
        if ($_GET['food'] == 1) {
            $products = $products_food;
        } else {
            $products = $products_drink;
        }

    }
var_dump($_POST['products']);
    if(isset($_POST['products'])){ // checking if the checkboxes exist
        $checkbox_list = $_POST['products'];

        foreach ($checkbox_list as $checked=>$value) {
            array_push($products, $value);
        }
    }
   // $sum = array_sum(array_map('intval', $_POST['product']));

    $totalValue = 0;

    require "form-view.php";