<?php

require_once '../config/connect.php';

setcookie('userId', null, -1, '/');
header('Location: /');