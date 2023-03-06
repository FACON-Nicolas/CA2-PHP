<?php

$errors = "";
$my_email = "faconicolas@gmail.com";

if (empty($_POST['firstName'])  ||
    empty($_POST['lastName'])   ||
    empty($_POST['email'])      ||
    empty($_POST['zip'])        ||
    empty($_POST['city'])       ||
    empty($_POST['request'])    ||
    empty($_POST['number'])     ||
    empty($_POST['street'])     ||
    empty($_POST['message'])
) $errors = "fields required empties.";

$headers = 'From: '.$my_email."\r\n".
    'Reply-To: '.$my_email."\r\n" .
    'X-Mailer: PHP/' . phpversion();

$lName = $_POST['lastName'];
$email_address = $_POST['email'];
$message = $_POST['message'];
$fName = $_POST['firstName'];
$zip = $_POST['zip'];
$request = $_POST['request'];
$number = $_POST['number'];
$city = $_POST['city'];
$street = $_POST['street'];
$game = $_POST['game'];

if (!preg_match(
    "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",
    $email_address))
{
    $errors .= "\n Error: Invalid email address";
}

if (empty($errors)) {
$subject = "Contact form submission: $fName $lName";
$body = "You have received a new message: \r\n".
    "by: $fName $lName , $email_address , $number $street , $city $zip \r\n".
    "request: $request \r\n".
    (empty($game) ? "" : "game: $game \r\n").
    "message: $message";

    mail($my_email, $subject, $body, $headers);
    require_once('index.php');
}
