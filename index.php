<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
session_start();
if (!isset($_SESSION['id_user'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web dengan Tailwind CSS</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
  * {
    margin: 0;
    padding: 0;
  }
</style>
<body class="container mx-auto bg-blue-500 text-black min-h-screen font-[sans-serif]">
  <!-- Header -->
  <?php
      $id_user = $_SESSION['id_user'];
      $saldo = $koneksi->query("SELECT * FROM user WHERE id_user = '$id_user'");
      $row = $saldo->fetch_assoc();
      ?>
  <header class="bg-blue-500 text-white p-2">
    <div class="container mx-auto flex justify-between items-center">
      <h3 class="text-xl font-bold">Hi! <?=$_SESSION['name_user']?></h3>
      <!-- profile -->
      <div class="relative">
        <button id="openpopup" type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
          <img src="img/<?php if($row['image_user'] == '-'){echo 'user.png';}else{echo 'profile/'.$row['image_user'];}?>" class="w-10 h-10 rounded-full" alt="">
        </button>
        <div id="popup" class="container opacity-0 pointer-events-none absolute right-0 z-30 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none transition-opacity duration-300" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
            <!-- Active: "bg-gray-100 outline-none", Not Active: "" -->
             <div class="container py-2 px-4" id="closepopup">
             <svg xmlns="http://www.w3.org/2000/svg" style="color: black;" width="25px" height="25px" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
              <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
            </svg>
             </div>
            
             <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
            <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
            
            
        </div>
      </div>
      
    </div>
  </header>

  <!-- Main Content -->
  <main class="container opacity-80 mx-auto absolute z-20 mt-4 p-4">
    <div class="bg-white shadow-md rounded-lg p-4">
      <h2 class="text-xl font-semibold mb-2 text-center">Sisa Uang Kamu</h2>
      <h2 class="text-2xl font-[monospace] mb-[40px]">Rp <?php echo number_format($row['saldo_user'], 0, ',', '.'); ?></h2>
      <div class="flex justify-center gap-8">
        <div class="flex flex-col items-center">
          <button id="transaksi"><svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
          </svg></button>
          <!-- <p class="text-center">Tambah</p> -->
        </div>
        <div class="flex flex-col items-center">
          <button id="transaksikurang"><svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" fill="currentColor" class="bi bi-dash-square-fill" viewBox="0 0 16 16">
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm2.5 7.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1"/>
          </svg></button>
          <!-- <p class="text-center">Pengeluaran</p> -->
        </div>
        <div class="flex flex-col items-center">
          <button id="catatan"><svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
          </svg></button>
          <!-- <p class="text-center">Edit</p> -->
        </div>
        <!-- <div class="flex flex-col items-center">
          <a href=""><button type="button"><svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" fill="currentColor" class="bi bi-journal-check" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
          </svg></button></a>

        </div> -->
      </div>
      <!-- <a href="#" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Learn More</a> -->
    </div>
  </main>
  <div id="formtransaksikurang" class="opacity-0 pointer-events-none container absolute z-40 mt-[35px] p-4 transition-opacity duration-300">
        <div class="bg-white rounded-lg shadow-md p-4">
        <div class="py-2 px-4">
             <svg xmlns="http://www.w3.org/2000/svg" id="closetransaksikurang" style="color: black;" width="25px" height="25px" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
              <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
            </svg>
          <h2 class="text-center text-2xl font-semibold mb-4">Tambah Transaksi</h2>
          <form action="" method="post">
            <div class="mb-4">
            <label for="website-admin" class="block mb-2 text-sm font-medium text-dark">Saldo</label>
            <div class="flex">
                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" class="bi bi-dash-square-fill" viewBox="0 0 16 16">
                  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm2.5 7.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1"/>
                </svg>
                </span>
                <input type="number" name="saldo" id="website-admin" class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1000">
            </div>
            </div>
            <!-- <div class="mb-4">
              <label for="password" class="block text-dark font-semibold mb-2">Password:</label>
              <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" value="12345678">
            </div> -->
            <div class="mb-4">
              <label for="message" class="block mb-2 text-sm font-medium text-black">Your message</label>
              <textarea id="message" name="keterangan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
            </div>
            <div class="mb-4 flex">
                <button name="submittransaksikurang" class="w-full shadow-xl py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">Save</button>
            </div>
            </form>
            <?php
            if (isset($_POST['submittransaksikurang'])) {
              $id_user = $_SESSION['id_user'];
              $saldo = $_POST['saldo'];
              $keterangan = $_POST['keterangan'];
              $tanggal = date("d-m-Y");

              $select = $koneksi->query("SELECT * FROM user WHERE id_user = '$id_user'");
              $row = $select->fetch_assoc();
              $saldobaru = $row['saldo_user'] - $saldo;

              $query = $koneksi->query("INSERT INTO transaksi(id_user, saldo_transaksi, keterangan_transaksi, tanggal_transaksi, jenis_transaksi) VALUES('$id_user', '$saldo', '$keterangan', '$tanggal', '-')");
              if ($query) {
                $koneksi->query("UPDATE user SET saldo_user = '$saldobaru' WHERE id_user = '$id_user'");
                echo '<script>alert("Data Berhasil di tambah")</script>';
                echo '<script>window.location.href = "index.php";</script>';
                exit;
              }

            }
            ?>
        </div>
      </div>
    </div>
  <div id="formtransaksi" class="opacity-0 pointer-events-none container absolute z-40 mt-[35px] p-4 transition-opacity duration-300">
        <div class="bg-white rounded-lg shadow-md p-4">
        <div class="py-2 px-4">
             <svg xmlns="http://www.w3.org/2000/svg" id="closetransaksi" style="color: black;" width="25px" height="25px" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
              <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
            </svg>
          <h2 class="text-center text-2xl font-semibold mb-4">Tambah Transaksi</h2>
          <form action="" method="post">
            <div class="mb-4">
            <label for="website-admin" class="block mb-2 text-sm font-medium text-dark">Saldo</label>
            <div class="flex">
                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
                </span>
                <input type="number" name="saldo" id="website-admin" class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1000">
            </div>
            </div>
            <!-- <div class="mb-4">
              <label for="password" class="block text-dark font-semibold mb-2">Password:</label>
              <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" value="12345678">
            </div> -->
            <div class="mb-4">
              <label for="message" class="block mb-2 text-sm font-medium text-black">Your message</label>
              <textarea id="message" name="keterangan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
            </div>
            <div class="mb-4 flex">
                <button name="submittransaksi" class="w-full shadow-xl py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">Save</button>
            </div>
            </form>
            <?php
            if (isset($_POST['submittransaksi'])) {
              $id_user = $_SESSION['id_user'];
              $saldo = $_POST['saldo'];
              $keterangan = $_POST['keterangan'];
              $tanggal = date("d-m-Y");

              $select = $koneksi->query("SELECT * FROM user WHERE id_user = '$id_user'");
              $row = $select->fetch_assoc();
              $saldobaru = $row['saldo_user'] + $saldo;

              $query = $koneksi->query("INSERT INTO transaksi(id_user, saldo_transaksi, keterangan_transaksi, tanggal_transaksi, jenis_transaksi) VALUES('$id_user', '$saldo', '$keterangan', '$tanggal', '+')");
              if ($query) {
                $koneksi->query("UPDATE user SET saldo_user = '$saldobaru' WHERE id_user = '$id_user'");
                echo '<script>alert("Data Berhasil di tambah")</script>';
                echo '<script>window.location.href = "index.php";</script>';
                exit;
              }

            }
            ?>
        </div>
      </div>
    </div>
    <div id="formcatatan" class="opacity-0 pointer-events-none container absolute z-40 mt-[35px] p-4 transition-opacity duration-300">
        <div class="bg-white rounded-lg shadow-md p-4">
        <div class="py-2 px-4">
             <svg xmlns="http://www.w3.org/2000/svg" id="closecatatan" style="color: black;" width="25px" height="25px" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
              <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
            </svg>
          <h2 class="text-center text-2xl font-semibold mb-4">Tambah catatan</h2>
          <form action="" method="post">
            <div class="mb-4">
            <label for="website-admin" class="block mb-2 text-sm font-medium text-dark">Judul</label>
            <div class="flex">
                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                </svg>
                </span>
                <input type="text" id="website-admin" name="judul" class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Catatan 1">
            </div>
            </div>
            <div class="mb-4">
              <label for="message" class="block mb-2 text-sm font-medium text-black">Your message</label>
              <textarea id="message" name="catatan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
            </div>
          
            <div class="mb-4 flex">
                <button name="submitcatatan" class="w-full shadow-xl py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">Save</button>
            </div>
            </form>
            <?php
            if (isset($_POST['submitcatatan'])) {
              $id_user = $_SESSION['id_user'];
              $judul = $_POST['judul'];
              $keterangan = $_POST['catatan'];
              $tanggal = date("d-m-Y");

              // $select = $koneksi->query("SELECT * FROM user WHERE id_user = '$id_user'");
              // $row = $select->fetch_assoc();
              // $saldobaru = $row['saldo_user'] + $saldo;

              $query = $koneksi->query("INSERT INTO catatan(id_user, judul_catatan, catatan, tanggal_catatan) VALUES('$id_user', '$judul', '$keterangan', '$tanggal')");
              if ($query) {
                // $koneksi->query("UPDATE user SET saldo_user = '$saldobaru' WHERE id_user = '$id_user'");
                echo '<script>alert("Data Berhasil di tambah")</script>';
                echo '<script>window.location.href = "index.php";</script>';
                exit;
              }

            }
            ?>
        </div>
      </div>
    </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="mt-[130px] mx-auto"><path fill="#ffffff" fill-opacity="1" d="M0,256L18.5,245.3C36.9,235,74,213,111,208C147.7,203,185,213,222,234.7C258.5,256,295,288,332,272C369.2,256,406,192,443,149.3C480,107,517,85,554,106.7C590.8,128,628,192,665,213.3C701.5,235,738,213,775,192C812.3,171,849,149,886,138.7C923.1,128,960,128,997,154.7C1033.8,181,1071,235,1108,213.3C1144.6,192,1182,96,1218,58.7C1255.4,21,1292,43,1329,69.3C1366.2,96,1403,128,1422,144L1440,160L1440,320L1421.5,320C1403.1,320,1366,320,1329,320C1292.3,320,1255,320,1218,320C1181.5,320,1145,320,1108,320C1070.8,320,1034,320,997,320C960,320,923,320,886,320C849.2,320,812,320,775,320C738.5,320,702,320,665,320C627.7,320,591,320,554,320C516.9,320,480,320,443,320C406.2,320,369,320,332,320C295.4,320,258,320,222,320C184.6,320,148,320,111,320C73.8,320,37,320,18,320L0,320Z"></path></svg>
  <div class="bg-white text-black p-4 gap-4  h-auto">
    <div class="p-2">
      <!-- menu -->
      <div class="flex flex-col pb-8">
        <div class="flex text-black gap-1">
          <a href="#" class="text-blue-500 hover:text-blue-800"><p>Transaksi</p></a>
          <p>|</p>
          <a href="#" class="text-blue-500 hover:text-blue-800"><p>Catatan</p></a>
        </div>
        <!-- <hr class="h-[0.1rem] w-[130px] bg-gray-500"> -->
      </div>
      <h2 class="text-xl text-center font-semibold mb-7">Catatan Harian</h2>
      <div class="overflow-x-auto h-[350px]">
      <div class="flex space-x-4">
        <!-- Card 1 -->
         <?php
         $querycatatan = $koneksi->query("SELECT * FROM catatan WHERE id_user = '$id_user'");
         if (mysqli_num_rows($querycatatan) > 0) {
          while ($rowcatatan = $querycatatan->fetch_assoc()) {
          ?>
        <div class="w-[200px] bg-blue-100 shadow-md rounded-lg p-4">
          <a href="hapus.php?jenis=catatan&id=<?=$rowcatatan['id_catatan']?>" class="pb-2">
          <svg xmlns="http://www.w3.org/2000/svg" style="color: red;" width="18px" height="18px" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
              <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
          </svg>
          </a>
          <h2 class="text-lg font-semibold text-center"><?=$rowcatatan['judul_catatan']?></h2>
          <p class="text-sm text-gray-600 text-center font-[cursive]">
            <?=$rowcatatan['catatan']?>
          </p>
          <p class="pt-6 text-sm text-gray-600 text-center">
            <?=$rowcatatan['tanggal_catatan']?>
          </p>
        </div>
        <?php
            }
         } else {
        ?>
        <h2 class="text-lg text-center font-semibold text-red-400">Kamu belum memiliki catatan</h2>
        <?php
         }
         ?>
        
      </div>
    </div>

      <h2 class="text-xl text-center font-semibold mb-7 mt-7">Riwayat Transaksi</h2>
      <div class="relative overflow-x-auto overflow-y-auto h-[300px]">
        <table class="w-full text-sm text-left rtl:text-right text-dark">
            <!-- <thead class="text-xs text-dark uppercase">
                <tr>
                  <th scope="col" class="py-3">
                    
                  </th>
                    <th scope="col" class="px-6 py-3">
                        
                    </th>
                    <th scope="col" class="px-6 py-3">
                        
                    </th>
                    <th scope="col" class="px-6 py-3">
                        
                    </th>
                    <th scope="col" class="px-6 py-3">
                        
                    </th>
                </tr>
            </thead> -->
            <tbody>
              <?php
              $querytransaksi = $koneksi->query("SELECT * FROM transaksi WHERE id_user = '$id_user' ORDER BY id_transaksi DESC");
              if (mysqli_num_rows($querytransaksi) > 0) {
                while ($rowtransaksi = $querytransaksi->fetch_assoc()) {
              ?>
            <tr class="border-b hover:bg-blue-200">
                  <th class="text-blue">
                    <?php
                    if ($rowtransaksi['jenis_transaksi'] == '+') {
                    ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" style="color: green;" fill="currentColor" class="bi bi-bookmark-plus-fill" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m6.5-11a.5.5 0 0 0-1 0V6H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V7H10a.5.5 0 0 0 0-1H8.5z"/>
                    </svg>
                    <?php
                    } else {
                    ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" style="color: red;" fill="currentColor" class="bi bi-bookmark-dash-fill" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5M6 6a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z"/>
                    </svg>
                    <?php
                    }
                    ?>
                  </th>
                    <th scope="row" class="<?php if($rowtransaksi['jenis_transaksi'] == '+'){echo 'text-green-400';}else{echo 'text-red-400';}?> px-6 py-4 font-medium text-dark whitespace-nowrap">
                        Rp <?php echo number_format($rowtransaksi['saldo_transaksi'], 0, ',', '.'); ?>
                    </th>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?=$rowtransaksi['keterangan_transaksi']?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?=$rowtransaksi['tanggal_transaksi']?>
                    </td>
                    <td class="px-6 py-4">
                      <a href="hapus.php?jenis=transaksi&id=<?=$rowtransaksi['id_transaksi']?>">
                      <svg xmlns="http://www.w3.org/2000/svg" style="color: red;" width="20px" height="20px" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                      </svg>
                      </a>
                    </td>
                </tr>
                <?php
                  }
                } else {
                ?>
                <h2 class="text-lg text-center font-semibold text-red-400">Kamu belum memiliki riwayat transaksi</h2>
                <?php
                }
                ?>
                
                <!-- <tr class="border-b hover:bg-blue-200">
                <th class="text-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8"/>
                    </svg>
                  </th>
                    <th scope="row" class="px-6 py-4 font-medium text-dark whitespace-nowrap">
                        Rp 10.000
                    </th>
                    <td class="px-6 py-4">
                        e3f34f 3f3f34 434334f 34f3f34f 34f3
                    </td>
                    <td class="px-6 py-4">
                        Laptop PC
                    </td>
                    <td class="px-6 py-4">
                        $1999
                    </td>
                </tr>
                <tr class="border-b hover:bg-blue-200">
                <th class="text-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8"/>
                    </svg>
                  </th>
                    <th scope="row" class="px-6 py-4 font-medium text-dark whitespace-nowrap">
                        Rp 13.000
                    </th>
                    <td class="px-6 py-4">
                        Black
                    </td>
                    <td class="px-6 py-4">
                        Accessories
                    </td>
                    <td class="px-6 py-4">
                        $99
                    </td>
                </tr> -->
            </tbody>
        </table>
      </div>
    </div>
  </div>
  

  <!-- Footer -->
  <footer class="container bg-gray-800 text-white p-4 absolute">
    <div class="container mx-auto text-center">
      <p>&copy; 2024 Catatan Kamu. All rights reserved.</p>
    </div>
  </footer>

  <script>
    const openPopup = document.getElementById("openpopup");
    const closePopup = document.getElementById("closepopup");
    const popup = document.getElementById("popup");

    const transaksi = document.getElementById("transaksi");
    const closetransaksi = document.getElementById("closetransaksi");
    const formtransaksi = document.getElementById("formtransaksi");
    
    const transaksikurang = document.getElementById("transaksikurang");
    const closetransaksikurang = document.getElementById("closetransaksikurang");
    const formtransaksikurang = document.getElementById("formtransaksikurang");

    const catatan = document.getElementById("catatan");
    const closecatatan = document.getElementById("closecatatan");
    const formcatatan = document.getElementById("formcatatan");

    // Fungsi untuk membuka pop-up
    openPopup.addEventListener("click", () => {
      popup.classList.remove("opacity-0", "pointer-events-none");
    });

    transaksi.addEventListener("click", () => {
      formtransaksi.classList.remove("opacity-0", "pointer-events-none");
    });

    transaksikurang.addEventListener("click", () => {
      formtransaksikurang.classList.remove("opacity-0", "pointer-events-none");
    });

    catatan.addEventListener("click", () => {
      formcatatan.classList.remove("opacity-0", "pointer-events-none");
    });

    // Fungsi untuk menutup pop-up
    const closePopupFunction = () => {
      popup.classList.add("opacity-0", "pointer-events-none");
    };

    const closeTransaksi = () => {
      formtransaksi.classList.add("opacity-0", "pointer-events-none");
    };

    const closeTransaksiKurang = () => {
      formtransaksikurang.classList.add("opacity-0", "pointer-events-none");
    };

    const closeCatatan = () => {
      formcatatan.classList.add("opacity-0", "pointer-events-none");
    };

    closePopup.addEventListener("click", closePopupFunction);
    closetransaksi.addEventListener("click", closeTransaksi);
    closetransaksikurang.addEventListener("click", closeTransaksiKurang);
    closecatatan.addEventListener("click", closeCatatan);

    // Klik di luar konten pop-up (overlay)
    popup.addEventListener("click", (event) => {
      if (event.target === popup) { // Pastikan kliknya di area overlay, bukan di konten
        closePopupFunction();
      }
    });
  </script>
</body>
</html>
