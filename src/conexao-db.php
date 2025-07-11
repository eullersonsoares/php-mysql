<?php

$pdo = new PDO("mysql:host=193.203.175.140;dbname=u516427637_php_mysql;charset=utf8mb4", "u516427637_php_mysql_eslp", "c=2>4oIy4T");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);