<?php
$pdo = require_once '../config/connect.php';

$pdo->exec('CREATE table IF NOT EXISTS users (
    id INT PRIMARY KEY  AUTO_INCREMENT,
    login VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)
    ');