<?php
include 'config.php';
session_start();
if (!isset($_SESSION['id_user'])) {
  header("Location: login.php");
  exit;
}
if (isset($_GET['jenis']) && isset($_GET['id'])) {
    $jenis = $_GET['jenis'];
    $id = $_GET['id'];

    if ($jenis == "catatan") {
        $query = $koneksi->query("DELETE FROM catatan WHERE id_catatan = '$id'");
        if ($query) {
            echo '<script>alert("Data Berhasil di hapus")</script>';
            echo '<script>window.location.href = "index.php";</script>';
            exit;
        }
    } elseif ($jenis == "transaksi") {
        $query = $koneksi->query("DELETE FROM transaksi WHERE id_transaksi = '$id'");
        if ($query) {
            echo '<script>alert("Data Berhasil di hapus")</script>';
            echo '<script>window.location.href = "index.php";</script>';
            exit;
        }
    } else {
        echo '<script>window.location.href = "index.php";</script>';
        exit;
    }
} else {
    echo '<script>window.location.href = "index.php";</script>';
    exit;
}
?>