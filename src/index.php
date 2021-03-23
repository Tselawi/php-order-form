<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);



//we are going to use session variables so we need to enable sessions
session_start();

//function whatIsHappening() {
//    echo '<h2>$_GET</h2>';
//    var_dump($_GET);
//    echo '<h2>$_POST</h2>';
//    var_dump($_POST);
//    echo '<h2>$_COOKIE</h2>';
//    var_dump($_COOKIE);
//    echo '<h2>$_SESSION</h2>';
//    var_dump($_SESSION);
//}


//your products with their price.

    $products = [
        ['name' => 'Margherita', 'price' => 8],
        ['name' => 'Hawaï', 'price' => 8.5],
        ['name' => 'Salami pepper', 'price' => 10],
        ['name' => 'Prosciutto', 'price' => 9],
        ['name' => 'Parmiggiana', 'price' => 9],
        ['name' => 'Vegetarian', 'price' => 8.5],
        ['name' => 'Four cheeses', 'price' => 10],
        ['name' => 'Four seasons', 'price' => 10.5],
        ['name' => 'Scampi', 'price' => 11.5]
    ];

if (isset($_GET['food']) && $_GET['food'] == 'drinks') {
        $products = [
            ['name' => 'Water', 'price' => 1.8],
            ['name' => 'Sparkling water', 'price' => 1.8],
            ['name' => 'Cola', 'price' => 2],
            ['name' => 'Fanta', 'price' => 2],
            ['name' => 'Sprite', 'price' => 2],
            ['name' => 'Ice-tea', 'price' => 2.2],
        ];
    }

// Declares the variables

$userEmail = $streetNum = $zipCode = $cityName = $streetName= "";
$emailErr = $streetNumErr = $zipcodeErr= "";
$totalValue = 0;

// make the submit button false by default
$submit =false;
// if you press the submit button
if (isset($_POST['submit'])) {
    // call the email, streetnumber, street, city, zipcodes inputs and make the filtering...!
    $userEmail = $_POST['email'];
    $streetNum = $_POST['streetnumber'];
    $zipCode = $_POST['zipcode'];
    $cityName = trim($_POST['city']);
    $streetName = trim($_POST['street']);
    $userEmail = filter_var($userEmail, FILTER_SANITIZE_EMAIL);
    $streetNum = filter_var($streetNum, FILTER_SANITIZE_NUMBER_INT);
    $zipCode = filter_var($zipCode, FILTER_SANITIZE_NUMBER_INT);

    // Here we should make validation for Email, street number and zipcode!
    if (filter_var($streetNum, FILTER_VALIDATE_INT) && filter_var($zipCode, FILTER_VALIDATE_INT) && filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        //here we save the data address in cookie and we could use session too!
        setcookie('street', $streetName, time() + 3600, '/' );
        setcookie('streetnumber', "{$streetNum}", time() + 3600, '/' );
        setcookie('city',$cityName , time() + 3600, '/' );
        setcookie('zipcode',"{$zipCode}", time() + 3600, '/' );
        setcookie('totalSpend', "{$totalValue}", time()+ 3600, '/'); // here we save the total value in cookie!

        // here we set total spend in cookie..!
        if (isset($_COOKIE["totalSpend"])){
            $totalValue=(float)$_COOKIE["totalSpend"];
        }else{
            $totalValue=0;
        }
        // for each checkbox in list price we add it in total value
        foreach ($products as $i => $product){
            if(!empty($_POST["product-{$i}"])){
                $price= $product["price"];
                $totalValue += $price;
            }
        }
        // if you click to express delivery checkbox
        if(isset($_POST['express_delivery'])){
            $totalValue+=5;
            echo '<div class="alert alert-primary" role="alert">Your order will arrive in 30 Minutes
                                </div>';

        // if express delivery checkbox is empty!
        }elseif (empty($_POST['express_delivery'])){
           echo '<div class="alert alert-primary" role="alert">Your order will arrive in one hour
            </div>';
        }


        // display the total amount
        echo '<div class="alert alert-success" role="alert">Your Total amount is : ' . number_format($totalValue , 2) . ' &euro;' . '</div>';
        $submit = true;


        // here if your inputs are errors
    } else {
        if (empty($_POST['email'])) {
            $emailErr = '<div class="alert alert-danger" role="alert">Try again! There are empty fields!
                                </div>';
        } else {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $emailErr = '<div class="alert alert-danger" role="alert">Change the characters!
                                </div>';
            }
        }
        if (empty($_POST['streetnumber'])) {
            $streetNumErr = '<div class="alert alert-danger" role="alert">Try again! There are empty fields!
                                </div>';
        } else {
            if (!filter_var($_POST['streetnumber'], FILTER_VALIDATE_INT)) {
                $streetNumErr = '<div class="alert alert-danger" role="alert">This Field takes ONLY integers!
                                </div>';
            }
        }
        if (empty($_POST['zipcode'])) {
            $zipcodeErr = '<div class="alert alert-danger" role="alert">Try again! There are empty fields!
                                </div>';
        } else {
            if (!filter_var($_POST['zipcode'], FILTER_VALIDATE_INT)) {
                $zipcodeErr = '<div class="alert alert-danger" role="alert">This Field takes ONLY integers!
                                </div>';
            }
        }
    }
}


require 'form-view.php';
