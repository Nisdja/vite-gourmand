<?php

require_once __DIR__ . '/auth.php';

if (
    $_SESSION['user']['role'] !== 'employe'
    && $_SESSION['user']['role'] !== 'administrateur'
) {
    header('Location: /vite-gourmand/public/login.php');
    exit();
}