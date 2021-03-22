<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Order Pizzas & drinks</title>
</head>
<body>
<?php
global $submit;
if($submit):
?>
    <div class="alert alert-info" role="alert">Your order has been SENT!
    </div>
<?php
else:
?>
<div class="container">
    <h2 d-flex align="center"><span class="badge bg-success">Mr.Pizza </span><span class="badge bg-danger mx-1">Express Delivery</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email" class="badge bg-dark my-1">E-mail:</label>
                <input type="text" id="email" placeholder="Enter your Email" name="email" class="form-control" value="<?= $userEmail ?? "" ?>"><?= $emailErr ?? "" ?>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend><span class="badge bg-warning my-2 p-2">Address </span></legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street" class="badge bg-dark my-1">Street:</label>
                    <input type="text" placeholder="Enter your street name" name="street" id="street" class="form-control" value="<?= $streetName ?? "" ?>" required>

                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber" class="badge bg-dark my-1">Street number:</label>
                    <input type="text" id="streetnumber" placeholder="Enter your street number" name="streetnumber" class="form-control" value="<?= $streetNum ?? "" ?>" required> <?= $streetNumErr ?? "" ?>

                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city" class="badge bg-dark my-1">City:</label>
                    <input type="text" id="city" placeholder="Enter Your town" name="city" class="form-control" value="<?= $cityName ?? "" ?>" required>

                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode" class="badge bg-dark my-1">Zipcode</label>
                    <input type="text" id="zipcode" placeholder="Enter Your Zipcode" name="zipcode" class="form-control" value="<?= $zipCode ?? "" ?>" required><?= $zipcodeErr ?? "" ?>
                </div>
            </div>
        </fieldset>
        <nav>
            <ul class="nav my-3">
                <li class="nav-item">
                    <a class="nav-link badge bg-success mx-4 p-2"  href="index.php?food=pizzas"> Order pizzas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link badge bg-danger p-2"  href="index.php?food=drinks">Order drinks</a>
                </li>
            </ul>
        </nav>
        <fieldset>
            <legend>Products</legend>
            <?php global $products; foreach ($products AS $i => $product): ?>

                <label>
                    <input type="checkbox" value="<?= $product['price'] ?>" name="product-<?php echo $i ?>"/> <?php echo $product['name'] ?> -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br />

            <?php endforeach; ?>
        </fieldset>

        <label>
            <input type="checkbox" name="express_delivery" value="5" />
            Express delivery (+ 5 EUR)
        </label>

        <button type="submit" class="btn btn-warning" name="submit">Order!</button>
    </form>

    <footer>You already ordered <?= $_COOKIE["total_spend"] ?? "" ?> <strong>&euro; <?php
            global $totalValue;
            echo $totalValue
            ?></strong> in pizza(s) and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
    body{
        background-image: url("https://image.freepik.com/free-photo/fresh-pizza-delivery-box-grey-concrete-background-top-view-copy-space_80743-1335.jpg");
        background-repeat: no-repeat;
        background-size: cover;

    }
</style>
<?php
endif;
?>
</body>
</html>
