<?php

require_once __DIR__ . '/../helpers/session.php';

if (!isset($_SESSION['user'])) {
    header('Location: /vite-gourmand/public/login.php');
    exit();
}