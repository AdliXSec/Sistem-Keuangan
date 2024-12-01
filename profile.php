<?php
include 'config.php';
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
<body class="container mx-auto bg-blue-500 text-black min-h-screen">
  <!-- Header -->
  <?php
   $id_user = $_SESSION['id_user'];
   $user = $koneksi->query("SELECT * FROM user WHERE id_user = '$id_user'");
   $row = $user->fetch_assoc();
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
            
             <a href="index.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">home</a>
            <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
            
            
        </div>
      </div>
      
    </div>
  </header>

  <!-- Main Content -->
   
  <main class="container opacity-80 mx-auto absolute z-20 mt-4 p-4">
    <div class="bg-white shadow-md rounded-lg p-4">
      <h2 class="text-xl font-semibold mb-2 text-center pb-4">Profile Kamu</h2>
      <div class="flex justify-center gap-2 pb-4">
      <img src="img/<?php if($row['image_user'] == '-'){echo 'user.png';}else{echo 'profile/'.$row['image_user'];}?>?>" alt="" class="w-[70px] h-[70px] rounded-full">
        <div class="flex flex-col">
        <h2 class="text-base font-semibold ml-2"><?=$row['name_user']?></h2>
        <h3 class="text-base font-semibold ml-2"><?=$row['email_user']?></h3>
        </div>
      </div>
      <h2 class="text-xl mb-2 text-center pb-4">
        <span class="font-semibold">Saldo Kamu</span> <span class="font-[monospace]">Rp <?php echo number_format($row['saldo_user'], 0, ',', '.'); ?></span>
      </h2>
      <div class="flex justify-center gap-8">
        
        <div class="flex flex-col items-center">
          <button id="openform" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
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
  <div id="formpopup" class="opacity-0 pointer-events-none container absolute z-40 mt-[35px] p-4 transition-opacity duration-300">
        <div class="bg-white rounded-lg shadow-md p-4">
        <div class="py-2 px-4">
             <svg xmlns="http://www.w3.org/2000/svg" id="closeform" style="color: black;" width="25px" height="25px" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
              <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
            </svg>
          <h2 class="text-center text-2xl font-semibold mb-4">Edit Profile</h2>
          <form method="post" enctype="multipart/form-data">
            <div class="mb-4">
            <label for="website-admin" class="block mb-2 text-sm font-medium text-dark">Username</label>
            <div class="flex">
                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                </svg>
                </span>
                <input type="text" name="username" id="website-admin" class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Bonnie Green">
            </div>
            </div>
            <div class="mb-4">
            <label for="email-address-icon" class="block mb-2 text-sm font-medium text-dark">Your Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                    <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                    <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                </svg>
                </div>
                <input type="text" name="usermail" id="email-address-icon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com">
            </div>
            </div>
            <!-- <div class="mb-4">
              <label for="password" class="block text-dark font-semibold mb-2">Password:</label>
              <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" value="12345678">
            </div> -->
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-dark" for="user_avatar">Upload file</label>
                <input name="photo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer dark:text-gray-400 focus:outline-none bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file">
            </div>
            <div class="mb-4 flex">
                <button name="submit" class="w-full shadow-xl py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">Save Profile</button>
            </div>
            </form>
            <?php
            if (isset($_POST['submit'])) {
                $nama = $_POST['username'];
                $email = $_POST['usermail'];
                $photoName = '-';
                if (empty($nama) || empty($email)) {
                    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                        $photo = $_FILES['photo'];
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                
                        // Validasi tipe file
                        if (!in_array($photo['type'], $allowedTypes)) {
                            die("Hanya file gambar (JPEG, PNG, GIF) yang diperbolehkan.");
                        }
                
                        // Menentukan nama dan lokasi file upload
                        $uploadDir = 'img/profile/';
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }
                
                        $photoName = uniqid('photo_', true) . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
                        $uploadPath = $uploadDir . $photoName;
                
                        // Pindahkan file ke direktori upload
                        if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
                            die("Gagal mengupload foto.");
                        }
                        $queryupdate = $koneksi->query("UPDATE user SET image_user = '$photoName' WHERE id_user = '$id_user'");
                        if ($queryupdate) {
                            echo '<script>alert("Data Berhasil di tambah")</script>';
                            echo '<script>window.location.href = "profile.php";</script>';
                            exit;
                        }
                    } else {
                        
                        echo '<script>alert("Data Berhasil di tambah")</script>';
                        echo '<script>window.location.href = "profile.php";</script>';
                        exit;
                        
                    }
                } else {
                    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                        $photo = $_FILES['photo'];
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                
                        // Validasi tipe file
                        if (!in_array($photo['type'], $allowedTypes)) {
                            die("Hanya file gambar (JPEG, PNG, GIF) yang diperbolehkan.");
                        }
                
                        // Menentukan nama dan lokasi file upload
                        $uploadDir = 'img/profile/';
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }
                
                        $photoName = uniqid('photo_', true) . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
                        $uploadPath = $uploadDir . $photoName;
                
                        // Pindahkan file ke direktori upload
                        if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
                            die("Gagal mengupload foto.");
                        }
                        $queryupdate = $koneksi->query("UPDATE user SET name_user = '$nama', email_user = '$email', image_user = '$photoName' WHERE id_user = '$id_user'");
                        if ($queryupdate) {
                            echo '<script>alert("Data Berhasil di tambah")</script>';
                            echo '<script>window.location.href = "profile.php";</script>';
                            exit;
                        }
                    } else {
                        $queryupdate = $koneksi->query("UPDATE user SET name_user = '$nama', email_user = '$email' WHERE id_user = '$id_user'");
                        if ($queryupdate) {
                            echo '<script>alert("Data Berhasil di tambah")</script>';
                            echo '<script>window.location.href = "profile.php";</script>';
                            exit;
                        }
                    }
                }
            }
            ?>
        </div>
      </div>
    </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="mt-[130px] mx-auto"><path fill="#ffffff" fill-opacity="1" d="M0,256L18.5,245.3C36.9,235,74,213,111,208C147.7,203,185,213,222,234.7C258.5,256,295,288,332,272C369.2,256,406,192,443,149.3C480,107,517,85,554,106.7C590.8,128,628,192,665,213.3C701.5,235,738,213,775,192C812.3,171,849,149,886,138.7C923.1,128,960,128,997,154.7C1033.8,181,1071,235,1108,213.3C1144.6,192,1182,96,1218,58.7C1255.4,21,1292,43,1329,69.3C1366.2,96,1403,128,1422,144L1440,160L1440,320L1421.5,320C1403.1,320,1366,320,1329,320C1292.3,320,1255,320,1218,320C1181.5,320,1145,320,1108,320C1070.8,320,1034,320,997,320C960,320,923,320,886,320C849.2,320,812,320,775,320C738.5,320,702,320,665,320C627.7,320,591,320,554,320C516.9,320,480,320,443,320C406.2,320,369,320,332,320C295.4,320,258,320,222,320C184.6,320,148,320,111,320C73.8,320,37,320,18,320L0,320Z"></path></svg>
  <div class="bg-white text-black p-4 gap-4 h-[650px]">
    <div class="p-2">
      
      
      
    </div>
  </div>
  

  <!-- Footer -->
  <footer class="container bg-gray-800 text-white p-4 absolute buttom-0">
    <div class="container mx-auto text-center">
      <p>&copy; 2024 Catatan Kamu. All rights reserved.</p>
    </div>
  </footer>

  <script>
    const openPopup = document.getElementById("openpopup");
    const closePopup = document.getElementById("closepopup");
    const popup = document.getElementById("popup");
    const formpopup = document.getElementById("formpopup");
    const closeform = document.getElementById("closeform");
    const openform = document.getElementById("openform");

    // Fungsi untuk membuka pop-up
    openPopup.addEventListener("click", () => {
      popup.classList.remove("opacity-0", "pointer-events-none");
      // popup.firstElementChild.classList.remove("scale-95");
      // popup.firstElementChild.classList.add("scale-100");
    });

    // Fungsi untuk menutup pop-up
    const closePopupFunction = () => {
      popup.classList.add("opacity-0", "pointer-events-none");
      // popupContent.classList.add("scale-95");
      // popupContent.classList.remove("scale-100");
    };

    closePopup.addEventListener("click", closePopupFunction);

    // Klik di luar konten pop-up (overlay)
    popup.addEventListener("click", (event) => {
      if (event.target === popup) { // Pastikan kliknya di area overlay, bukan di konten
        closePopupFunction();
      }
    });

    // Fungsi untuk membuka pop-up
    openform.addEventListener("click", () => {
      formpopup.classList.remove("opacity-0", "pointer-events-none");
      // popup.firstElementChild.classList.remove("scale-95");
      // popup.firstElementChild.classList.add("scale-100");
    });

    // Fungsi untuk menutup pop-up
    const closeFormPopupFunction = () => {
      formpopup.classList.add("opacity-0", "pointer-events-none");
      // popupContent.classList.add("scale-95");
      // popupContent.classList.remove("scale-100");
    };

    closeform.addEventListener("click", closeFormPopupFunction);
  </script>
</body>
</html>
