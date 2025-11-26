<?php
$host = "localhost";
$db = "gestorpro"; // Nome do banco que criamos acima
$user = "root";
$pass = ""; // Sua senha do banco (geralmente vazia no XAMPP)

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>