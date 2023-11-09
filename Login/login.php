<?php
require_once '../database/db.php';
$conexion = new PDO('mysql:host=db.fmesasc.com;dbname=daw2', 'daw2', 'Gimbernat');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    echo "email: " . $email . '<br>';
    echo "password: " . $password . '<br>';
    checkUser($conexion, $email, $password);

    //redirect a algún lado

}


?>