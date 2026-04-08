<?php
/**
 * Guard de sesión — redirige al landing si no hay sesión activa.
 */
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../');
    exit;
}
