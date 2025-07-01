<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$login_count = $_SESSION['login_count'] ?? 1;

$register_success = '';
$register_error = '';
$setting_success = '';
$setting_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nama'], $_POST['umur'])) {
        $new_user = trim($_POST['nama']);
        $new_pass = trim($_POST['umur']);
        if ($new_user && $new_pass) {
            $register_success = "Pengguna <strong>" . htmlspecialchars($new_user) . "</strong> berhasil didaftarkan (simulasi).";
        } else {
            $register_error = "Semua field harus diisi.";
        }
    }

    if (isset($_POST['new_username'], $_POST['new_password'])) {
        $newuser = trim($_POST['new_username']);
        $newpass = trim($_POST['new_password']);
        if ($newuser && $newpass) {
            $_SESSION['username'] = $newuser;
            $username = $newuser;
            $setting_success = "Username & Password berhasil diubah (simulasi).";
        } else {
            $setting_error = "Form setting tidak boleh kosong.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #83a4d4, #b6fbff);
            margin: 0;
            padding: 2rem;
        }
        .container {
            background: white;
            max-width: 600px;
            margin: auto;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #333;
        }
        .success {
            color: green;
            background: #e0ffe0;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 1rem;
        }
        .error {
            color: red;
            background: #ffe0e0;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-top: 1rem;
        }
        input[type="text"], input[type="number"], input[type="password"] {
            width: 100%;
            padding: 0.5rem;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 1rem;
            padding: 0.6rem 1.2rem;
            border: none;
            background-color: #4e8cff;
            color: white;
            border-radius: 8px;
            cursor: pointer;
        }
        a.logout {
            display: inline-block;
            margin-top: 1rem;
            color: red;
            text-decoration: none;
        }
        hr {
            margin: 2rem 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎉 Selamat Datang!</h1>
        <p>👋 Halo, <strong><?= htmlspecialchars($username) ?></strong></p>
        <p>🔁 Ini adalah login Anda yang ke-<strong><?= $login_count ?></strong></p>

        <hr>

        <h2>📝 Pendaftaran Pengguna</h2>
        <?php if ($register_success) : ?>
            <div class="success"><?= $register_success ?></div>
        <?php elseif ($register_error) : ?>
            <div class="error"><?= $register_error ?></div>
        <?php endif; ?>

        <form method="post">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" required>

            <label for="umur">Umur</label>
            <input type="number" id="umur" name="umur" required>

            <button type="submit">Daftar</button>
        </form>

        <hr>

        <h2>⚙️ Ganti Username & Password (Simulasi)</h2>
        <?php if ($setting_success) : ?>
            <div class="success"><?= $setting_success ?></div>
        <?php elseif ($setting_error) : ?>
            <div class="error"><?= $setting_error ?></div>
        <?php endif; ?>

        <form method="post">
            <label for="new_username">Username Baru</label>
            <input type="text" id="new_username" name="new_username" required>

            <label for="new_password">Password Baru</label>
            <input type="password" id="new_password" name="new_password" required>

            <button type="submit">Simpan</button>
        </form>

        <a class="logout" href="logout.php">🚪 Logout</a>
    </div>
</body>
</html>