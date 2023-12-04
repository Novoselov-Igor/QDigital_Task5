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
    $delete = $pdo->prepare('DELETE FROM tasks WHERE user_id = :userId');
    $delete->execute(['userId' => (int)$userId]);
} else {
    $delete = $pdo->prepare('DELETE FROM tasks WHERE user_id = ? AND id = ?');
    $delete->execute([$userId, $taskId]);
}

header('Location: ../index.php');