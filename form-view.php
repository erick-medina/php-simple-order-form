<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Order food & drinks</title>
</head>
<body>
<div class="container">
    <h1>Order food in restaurant "the Personal Ham Processors"</h1>
    <div class="alert alert-dark" role="alert"><?php echo $name_err, $user_email_err, $user_street_err, $user_street_number_err, $user_city, $user_zip, $zip_no_number, $street_no_number ?> </div>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> <!-- Sends the submitted form data to the page itself -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Full name:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $name; ?>" /> <!-- value + $name is to display what the user entered -->
            </div>
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" class="form-control" value="<?php echo $result_email; ?>" <?php echo $user_email_err ?>/>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" value="<?php echo $street_session; ?>"> <!-- Session will store the address even when refreshing as long as the user doesn't close the window -->
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?php echo $street_number_session; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" value="<?php echo $city_session; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?php echo $zipcode_session; ?>">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>
        <fieldset>
            <legend>Delivery method</legend>
            <input type="checkbox" name="check1" value="1"><label>&ensp; <strong>Normal delivery:</strong> It could take up to 2 hours</label><br>
            <input type="checkbox" name="check2" value="2"><label>&ensp; <strong>Express delivery:</strong> It could take up to 45 minutes</label>
        </fieldset>

        <button name="submit" type="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
    <div class="alert alert-success" role="alert"><?php echo $message_confirmation ?></div>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>