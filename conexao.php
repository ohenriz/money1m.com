
<?php
$host = 'localhost';
$db = 'money1m';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
    exit;
}
?>
