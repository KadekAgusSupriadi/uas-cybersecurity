<?php
require_once 'config.php';

$user = $_POST['username'];
$pass = $_POST['password'];

if (SECURE_MODE) {
    if (!isset($_SESSION['fail'])) $_SESSION['fail'] = 0;
    if (!isset($_SESSION['lock'])) $_SESSION['lock'] = 0;

    if (time() < $_SESSION['lock']) {
        $sisa = $_SESSION['lock'] - time();
        die("Terlalu banyak percobaan login. Tunggu $sisa detik.");
    }
}


/* ===== RENTAN ===== */
if (!SECURE_MODE) {
    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $q = mysqli_query($koneksi,$sql);

    if (mysqli_num_rows($q) > 0) {
        $data = mysqli_fetch_assoc($q);
        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['username'];
        header("Location: dashboard.php");
    } else {
        echo "Login gagal";
    }
    exit;
}

/* ===== SECURE ===== */
$stmt = mysqli_prepare(
    $koneksi,
    "SELECT * FROM users WHERE username=? AND password=?"
);
mysqli_stmt_bind_param($stmt,"ss",$user,$pass);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($res) > 0) {
    $data = mysqli_fetch_assoc($res);
    $_SESSION['login'] = true;
    $_SESSION['username'] = $data['username'];
    $_SESSION['fail'] = 0;
    header("Location: dashboard.php");
}
 else {
    $_SESSION['fail']++;

    if ($_SESSION['fail'] >= 3) {
        $_SESSION['lock'] = time() + 200;
        $_SESSION['fail'] = 0;
        header("Location: login.php?lock=1");
        exit;
    }
    echo "Login gagal";
}

