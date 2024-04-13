<?php
require_once('db.php');

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM user_datubase WHERE email = '$email' AND password = '$password'";

$result = $connection->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        // Iegūstam lietotāja ID no rezultāta rindas
        $user_row = $result->fetch_assoc();
        $user_id = $user_row['id'];

        // Pārbaudam, vai sesija jau ir sākusies
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Ievieto lietotāja ID sesijā
        $_SESSION['user_id'] = $user_id;

        header("Location: Entry_start.php");
        exit;
    } else {
        echo "<script>alert('Lietotājs nav atrasts'); window.location='login.html';</script>";
        exit;
    }
} else {
    echo "Error: " . $connection->error;
    exit;
}
?>
