<?php
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