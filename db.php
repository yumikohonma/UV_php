<?php
$host = 'localhost';      
$db   = 'unionvoice';
$user = 'root';           // DBユーザー
$pass = 'root';               // ←パスワード

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
    exit('DB接続失敗: ' . $e->getMessage());
}
?>
