<?php
session_start();
include 'config.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}

$file_name = $_FILES['file']['name'];
$tmp       = $_FILES['file']['tmp_name'];

/*
|--------------------------------------------------------------------------
| MODE RENTAN
|--------------------------------------------------------------------------
| Tidak ada validasi apa pun (RCE)
*/
if (SECURE_MODE === false) {

    move_uploaded_file($tmp, "uploads/" . $file_name);
    echo "Upload berhasil (RENTAN)<br>";
    echo "Akses file: <a href='uploads/$file_name'>$file_name</a>";

}
/*
|--------------------------------------------------------------------------
| MODE AMAN
|--------------------------------------------------------------------------
| Whitelist ekstensi + rename
*/
else {

    $allowed = ['jpg','png','jpeg'];
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        die("File tidak diizinkan (MODE AMAN)");
    }

    $new_name = uniqid() . "." . $ext;
    move_uploaded_file($tmp, "uploads/" . $new_name);

    echo "Upload berhasil (AMAN)<br>";
    echo "Nama file: $new_name";
}
?>
