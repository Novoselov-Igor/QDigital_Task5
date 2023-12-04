<?php
$pdo = require_once '../config/connect.php';
require 'validatePost.php';

$taskId = validatePostData('taskId');
if (isset($_COOKIE['userId'])) {
    $userId = trim($_COOKIE['userId']);
} else {
    $userId = '';
}

if ($userId === ''){
    die('Непредвиденная ошибка');
}

if ($taskId === '') {
    $ready = $pdo->prepare('UPDATE tasks SET status = 1 WHERE user_id = :userId');
    $ready->execute(['userId' => (int)$userId]);
} else {
    $ready = $pdo->prepare('SELECT * FROM tasks WHERE user_id = ? AND id = ?');
    $ready->execute([$userId, $taskId]);
    $status = $ready->fetch(PDO::FETCH_ASSOC);

    if ($status['status']) {
        $ready = $pdo->prepare('UPDATE tasks SET status = 0 WHERE user_id = ? AND id = ?');
    } else {
        $ready = $pdo->prepare('UPDATE tasks SET status = 1 WHERE user_id = ? AND id = ?');
    }
    $ready->execute([$userId, $taskId]);
}

header('Location: ../index.php');

