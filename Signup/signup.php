<?php
require_once '../database/db.php';
$conexion = new PDO('mysql:host=db.fmesasc.com;dbname=daw2', 'daw2', 'Gimbernat');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    echo "username: " . $username . '<br>';
    echo "email: " . $email . '<br>';
    echo "password: " . $password . '<br>';

    if (doesUserExist($conexion, $username, $email)) {
        echo "<br> USER EXISTS ALREADY <br>";
    } else {
        echo "Adding user to database...";
        addUser($conexion, $username, $password, $email);
    }
    //redirect a algún lado

}


?>