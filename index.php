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
$name = $email = $street = $streetnumber = $city = $zipcode = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") { // check if it's posted
if (isset($_POST['submit'])) { // to check if there's something
        if (empty($_POST["name"])) { // name verification
            $name_err = "Name is required";
            echo $name_err;
        } else {
            $name = test_input($_POST["name"]);
        }
        if (empty($_POST["email"])) { // email verification
            $user_email_err = "Email is required";
            echo $user_email_err;
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $user_email_err = "Invalid email format";
                echo $user_email_err;
            }
        }
        if (empty($_POST["street"])) { // street verification
            $user_street_err = "Street is required";
        } else {
            $street = test_input($_POST["street"]);
        }
        if (empty($_POST["streetnumber"])) { // street number verification
            $user_street_number_err = "Street number is required";
            echo $user_street_number_err;
        } else {
            $streetnumber = test_input($_POST["streetnumber"]);
            if (is_numeric($streetnumber)) { // 'is numeric' check if the characters entered into the field are numbers or not
                echo 'The street number you entered is '. $streetnumber.'. This is a valid number';
            } else {
                echo 'Error: Please enter numbers only';
            }
        }
        if (empty($_POST["city"])) { // city verification
            $user_city = "City is required";
        } else {
            $city = test_input($_POST["city"]);
        }
        if (empty($_POST["zipcode"])) { // city verification
            $user_zip = "";
        } else {
            $zipcode = test_input($_POST["zipcode"]);
            if (is_numeric($zipcode)) { // 'is numeric' check if the characters entered into the field are numbers or not
                echo 'The zipcode you entered is '. $zipcode.'. This is a valid number';
            } else {
                echo 'Error: Invalid zipcode. Please enter numbers only';
            }
    }



    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


//your products with their price.
    $products = [
        ['name' => 'Club Ham', 'price' => 3.20],
        ['name' => 'Club Cheese', 'price' => 3],
        ['name' => 'Club Cheese & Ham', 'price' => 4],
        ['name' => 'Club Chicken', 'price' => 4],
        ['name' => 'Club Salmon', 'price' => 5]
    ];

    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ];

    $totalValue = 0;

    require "form-view.php";