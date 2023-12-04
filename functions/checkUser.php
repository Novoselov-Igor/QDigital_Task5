<?php
$pdo = require_once '../config/connect.php';
require 'auth.php';

if(isset($_POST['login'])) {
    $login = trim($_POST['login']);
} else {
    $login = "";
}

if(isset($_POST['password'])) {
    $password = trim($_POST['password']);
} else {
    $password = "";
}

$error = '';
if ($login === '') {
    echo 'Введите ваш логин.';
    exit;
} elseif ($password === null) {
    echo 'Введите пароль.';
    exit;
} elseif (strlen($password) < 6) {
    echo "Пароль слишком короткий.\nПароль должен содержать минимум 6 символов.";
    exit;
}

$check = $pdo->prepare("SELECT * FROM users WHERE `login` = :login");
$check->execute(['login' => $login]);
if ($check->rowCount() > 0) {
    auth($pdo, $login, $password);
} else {
    $insert = $pdo->prepare("INSERT INTO users (login, password) VALUES (?, ?)");
    $insert->execute([$login, password_hash($password, PASSWORD_DEFAULT)]);

    auth($pdo, $login, $password);
}

header('Location: /');


