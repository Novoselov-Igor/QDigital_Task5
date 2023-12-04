<?php
$pdo = require_once '../config/connect.php';
require 'validatePost.php';

$task = validatePostData('task');

if (isset($_COOKIE['userId'])) {
    $userId = trim($_COOKIE['userId']);
} else {
    $userId = '';
}

if ($task === '') {
    die('Введите название задачи');
}
if ($userId === ''){
    die('Непредвиденная ошибка');
}

$insert = $pdo->prepare("INSERT INTO tasks (user_id, description, status) VALUES (?, ?, 0)");
$insert->execute([$userId, $task]);

header('Location: ../index.php');