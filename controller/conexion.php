<?php

$server = "localhost";
$username = "root";         // default XAMPP username
$password = "";            // default XAMPP password is empty
$bd = "medic_eddi";        // your local database name

//creamos una conexión
$conn = mysqli_connect($server, $username, $password, $bd);
//Chequeamos la conexión
if (!$conn) {
    die("Conexión fallida:" . mysqli_connect_error());
}

// Set the character set to UTF-8MB4
mysqli_set_charset($conn, "utf8mb4");
// Set the collation to utf8mb4_general_ci
mysqli_query($conn, "SET NAMES 'utf8mb4'");
mysqli_query($conn, "SET CHARACTER SET 'utf8mb4'");
mysqli_query($conn, "SET COLLATION_CONNECTION = 'utf8mb4_general_ci'");     

// Set the time zone to Bogotá, Colombia (UTC-5)
mysqli_query($conn, "SET time_zone = '-05:00'");