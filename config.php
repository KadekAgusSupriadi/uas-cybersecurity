<?php
$koneksi = mysqli_connect("localhost","root","","uas_vuln");
if(!$koneksi) die("DB error");

define("SECURE_MODE", false);
session_start();

/* ==============================
   RESET BRUTEFORCE SAAT RENTAN
   ============================== */
if (!SECURE_MODE) {
    unset($_SESSION['fail']);
    unset($_SESSION['lock']);
}
?>

<!-- false = RENTAN (SQLi + Bruteforce + Upload Rentan) -->
<!-- true  = AMAN   (Prepared + Hash + Anti-Bruteforce + Upload Aman) -->