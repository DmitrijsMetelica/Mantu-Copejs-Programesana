<?php
// Iekļaujam datu bāzes savienojumu
require_once('db_connection.php');

// Saņemam datus no formas
$uname = $_POST['reguname'];
$usname = $_POST['regusname'];
$email = $_POST['regemail'];
$password = $_POST['regpassword'];

// Izveidojam SQL vaicājumu, pielāgojot to datu bāzes nosaukumam
$sql = "INSERT INTO user_datubase (uname, usname, email, password) VALUES ('$uname', '$usname', '$email', '$password')";

// Palaist SQL vaicājumu un pārbaudīt rezultātu
if ($conn->query($sql) === TRUE) {
    echo "Jauns ieraksts veiksmīgi pievienots";
} else {
    echo "Kļūda: " . $sql . "<br>" . $conn->error;
}

// Aizveram savienojumu ar datu bāzi
$conn->close();



/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

 $uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';

?>
