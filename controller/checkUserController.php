<?php
$pdo = require_once '../config/connect.php';

$login = strtolower(trim($_POST['login']));
$password = trim($_POST['password']);

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

function auth($pdo, $login, $password)
{
    $userDB = $pdo->prepare("SELECT * FROM users WHERE `login` = :login");
    $userDB->execute(['login' => $login]);
    $user = $userDB->fetch(PDO::FETCH_ASSOC);

    if (password_verify($password, $user['password'])) {
        if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
            $newHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $userCheck = $pdo->prepare('UPDATE users SET `password` = :password WHERE `login` = :login');
            $userCheck->execute(['email' => $login, 'password' => $newHash,]);
        }
        setcookie('userId', $user['id'], time() + 360000, '/');
    }
}

