# php-order-form

## Learning objectives:
* Be able to tell the difference between the superglobals $_GET, $_POST, $_COOKIE and $_SESSION variable.
* Be able to write basic validation for PHP.
* Be able to sent an email with PHP

### Tips:

* You can use filter_var($email, FILTER_VALIDATE_EMAIL) to filter for e-mails.
* To check if an input is a number you can use is_numeric($number)
* If the mail() function doesn't work you might need to install sendmail
* When you are stuck try to run the function var_dump(), it might provide you with information how to access your input data. Or even better: use xdebug!
* Do not use private browsing during this excersise, it will make it more difficult to get everything working.
* You do not set cookies the same way you set other variables. Google how to do it!