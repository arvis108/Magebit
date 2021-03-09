<?php
$host = 'localhost';
$user = "root";
$password = 'root';
$database = "subscriptions";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e);
}
