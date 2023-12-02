<?php
$pdo = require_once '../config/connect.php';

$userId = trim($_POST['userId']);
$task = trim($_POST['task']);

if ($task === '') {
    die('Введите название задачи');
}

$insert = $pdo->prepare("INSERT INTO tasks (user_id, description, status) VALUES (?, ?, 0)");
$insert->execute([$userId, $task]);

header('Location: ../index.php');