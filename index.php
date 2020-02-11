<?php
//this line makes PHP behave in a more strict way


//we are going to use session variables so we need to enable sessions
session_start();
$active_array = 0; // for switching drinks and food

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
$name = $email = $street = $streetnumber = $city = $zipcode = $street_no_number = $zip_no_number = $counter_elements = $message_confirmation="";

if ($_SERVER["REQUEST_METHOD"] == "POST") { // check if it's posted
        if (empty($_POST["name"])) { // name verification
            $name_err = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            $counter_elements ++;
        }
        if (empty($_POST["email"])) { // email verification
            $user_email_err = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $user_email_err = "Invalid email format";
                echo $user_email_err;
                $counter_elements ++;
            }
        }
        if (empty($_SESSION['street'] = $_POST["street"])) { // street verification ---used a session
            $user_street_err = "Street is required";
        } else {
            $street = test_input($_POST["street"]);
            $counter_elements ++;
        }
        if (empty($_SESSION['streetnumber'] = $_POST["streetnumber"])) { // street number verification
            $user_street_number_err = "Street number is required";
        } else {
            $streetnumber = test_input($_POST["streetnumber"]);
            $counter_elements ++;
            if (! is_numeric($streetnumber)) { // 'is numeric' check if the characters entered into the field are numbers or not
                $street_no_number = 'Error: Invalid street number. Please enter numbers only';
            }
        }
        if (empty($_SESSION['city'] = $_POST["city"])) { // city verification
            $user_city = "City is required";
        } else {
            $city = test_input($_POST["city"]);
            $counter_elements ++;
        }
        if (empty($_SESSION['zipcode'] = $_POST["zipcode"])) { // city verification
            $user_zip = "Zip code is required";
        } else {
            $zipcode = test_input($_POST["zipcode"]);
            $counter_elements ++;
            if (! is_numeric($zipcode)) { // 'is numeric' check if the characters entered into the field are numbers or not
                $zip_no_number = 'Error: Invalid zipcode. Please enter numbers only';
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


//your products with their price.

    $products_array = [
    $products = [
        ['name' => 'Club Ham', 'price' => 3.20],
        ['name' => 'Club Cheese', 'price' => 3],
        ['name' => 'Club Cheese & Ham', 'price' => 4],
        ['name' => 'Club Chicken', 'price' => 4],
        ['name' => 'Club Salmon', 'price' => 5]
    ],

    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ]
];
    $totalValue = 0;

    require "form-view.php";