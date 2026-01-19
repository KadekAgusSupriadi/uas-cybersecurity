<?php
require_once 'config.php';
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<h2>Dashboard</h2>

<!-- PROFIL USER -->
<div style="border:1px solid #ccc; padding:10px; width:300px;">
    <h3>Profil</h3>
    <p><b>Username:</b> <?= htmlspecialchars($_SESSION['username']); ?></p>
</div>

<hr>

<!-- FORM UPLOAD -->
<form method="POST" enctype="multipart/form-data">
    Upload file:
    <input type="file" name="file">
    <button name="upload">Upload</button>
</form>

<?php
if (isset($_POST['upload'])) {
    $file = $_FILES['file'];
    $nama = $file['name'];
    $tmp  = $file['tmp_name'];

    /* ===== MODE RENTAN ===== */
    if (!SECURE_MODE) {
        move_uploaded_file($tmp, "uploads/" . $nama);
        echo "<p style='color:red'>Upload berhasil (RENTAN): $nama</p>";
    }

    /* ===== MODE SECURE ===== */
    if (SECURE_MODE) {
        $ext = strtolower(pathinfo($nama, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if (!in_array($ext, $allowed)) {
            echo "<p style='color:red'>Format tidak diizinkan</p>";
        } else {
            $mime = mime_content_type($tmp);
            $allowed_mime = ['image/jpeg', 'image/png'];

            if (!in_array($mime, $allowed_mime)) {
                echo "<p style='color:red'>File bukan gambar</p>";
            } elseif ($file['size'] > 2 * 1024 * 1024) {
                echo "<p style='color:red'>File terlalu besar</p>";
            } else {
                $newName = uniqid() . "." . $ext;
                move_uploaded_file($tmp, "uploads/" . $newName);
                echo "<p style='color:green'>Upload gambar berhasil</p>";
            }
        }
    }
}
?>


<br>
<a href="logout.php">Logout</a>
