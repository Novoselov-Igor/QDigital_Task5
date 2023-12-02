<?php
$pdo = require_once '../config/connect.php';

$pdo->exec("CREATE table IF NOT EXISTS tasks (
    id INT PRIMARY KEY  auto_increment,
    user_id INT REFERENCES users(id),
    description VARCHAR(100) NOT NULL,
    status TINYINT(1) NOT NULL
)");