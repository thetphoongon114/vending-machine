<?php

function isAuth() {
    if (!isset($_SESSION['email']) && !isset($_SESSION['role'])) {
        return false;
        exit();
    }

    return true;
}

function checkAdmin() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
        return false;
        exit();
    }

    return true;
}