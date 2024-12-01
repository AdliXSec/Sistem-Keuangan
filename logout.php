<?php
// Mulai sesi jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hapus semua data sesi
$_SESSION = [];

// Hancurkan sesi
session_unset();
session_destroy();

// Redirect pengguna ke halaman login atau halaman lain
header("Location: login.php");
exit;
