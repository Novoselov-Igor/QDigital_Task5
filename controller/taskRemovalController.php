<?php
$pdo = require_once '../config/connect.php';

$taskId = trim($_POST['taskId']);
$userId = trim($_POST['userId']);

if ($taskId === '') {
    $delete = $pdo->prepare('DELETE FROM tasks WHERE user_id = :userId');
    $delete->execute(['userId' => (int)$userId]);
} else {
    $delete = $pdo->prepare('DELETE FROM tasks WHERE id = :taskId');
    $delete->execute(['taskId' => (int)$taskId]);
}

header('Location: ../index.php');