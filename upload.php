<?php
// Direktori target untuk menyimpan file yang di-upload
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Memeriksa apakah file adalah gambar asli atau bukan
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File adalah gambar - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.<br>";
        $uploadOk = 0;
    }
}

// Memeriksa apakah file sudah ada
if (file_exists($target_file)) {
    echo "Maaf, file sudah ada.<br>";
    $uploadOk = 0;
}

// Membatasi ukuran file (misal 500KB)
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Maaf, ukuran file terlalu besar.<br>";
    $uploadOk = 0;
}

// Mengizinkan tipe file tertentu saja
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.<br>";
    $uploadOk = 0;
}

// Memeriksa apakah $uploadOk bernilai 0 karena kesalahan
if ($uploadOk == 0) {
    echo "Maaf, file Anda tidak dapat di-upload.<br>";
} else {
    // Jika tidak ada kesalahan, upload file
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "File " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " berhasil di-upload.<br>";
    } else {
        echo "Maaf, terjadi kesalahan saat meng-upload file.<br>";
    }
}
?>
