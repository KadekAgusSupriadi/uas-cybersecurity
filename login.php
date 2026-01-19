<?php require_once 'config.php'; ?>
<h2>Login (<?= SECURE_MODE ? "SECURE" : "RENTAN"; ?>)</h2>

<?php
if (SECURE_MODE && isset($_SESSION['lock']) && time() < $_SESSION['lock']) {
    $sisa = $_SESSION['lock'] - time();
    echo "<p style='color:red'>
        Terlalu banyak percobaan login. Tunggu $sisa detik.
    </p>";
}
?>

<form method="POST" action="proses_login.php">
    Username: <input name="username"><br><br>
    Password: <input type="password" name="password"><br><br>
    <button>Login</button>
</form>
