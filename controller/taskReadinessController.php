<?php
$pdo = require_once '../config/connect.php';

$taskId = trim($_POST['taskId']);
$userId = trim($_POST['userId']);

if ($taskId === '') {
    $ready = $pdo->prepare('UPDATE tasks SET status = 1 WHERE user_id = :userId');
    $ready->execute(['userId' => (int)$userId]);
} else {
    $ready = $pdo->prepare('SELECT * FROM tasks WHERE id = :taskId');
    $ready->execute(['taskId' => (int)$taskId]);
    $status = $ready->fetch(PDO::FETCH_ASSOC);

    if($status['status']){
        $ready = $pdo->prepare('UPDATE tasks SET status = 0 WHERE id = :taskId');
        $ready->execute(['taskId' => (int)$taskId]);
    }
    else{
        $ready = $pdo->prepare('UPDATE tasks SET status = 1 WHERE id = :taskId');
        $ready->execute(['taskId' => (int)$taskId]);
    }
}

header('Location: ../index.php');

