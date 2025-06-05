<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error_message = '';
$success_message = ''; // Jarang digunakan di register karena langsung redirect

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sebaiknya ganti dengan file koneksi terpisah
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "codemaster";
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        // error_log("Koneksi database gagal: " . $conn->connect_error);
        $error_message = "Terjadi masalah pada server. Silakan coba lagi nanti.";
    } else {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validasi dasar
        if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
            $error_message = "Semua kolom wajib diisi.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Format email tidak valid.";
        } elseif (strlen($password) < 6) {
            $error_message = "Password minimal harus 6 karakter.";
        } elseif ($password !== $confirm_password) {
            $error_message = "Password dan konfirmasi password tidak cocok.";
        } else {
            // Cek apakah email sudah ada
            $stmt_check = $conn->prepare("SELECT id FROM users WHERE email = ?");
            if ($stmt_check) {
                $stmt_check->bind_param("s", $email);
                $stmt_check->execute();
                $stmt_check->store_result();

                if ($stmt_check->num_rows > 0) {
                    $error_message = "Email sudah terdaftar. Silakan gunakan email lain.";
                } else {
                    // Email belum ada, lanjutkan registrasi
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $stmt_insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                    if ($stmt_insert) {
                        $stmt_insert->bind_param("sss", $name, $email, $hashed_password);
                        if ($stmt_insert->execute()) {
                            header("Location: login.php?success=" . urlencode("Registrasi berhasil! Silakan login."));
                            exit();
                        } else {
                            // error_log("Eksekusi statement insert gagal: " . $stmt_insert->error);
                            $error_message = "Registrasi gagal. Terjadi kesalahan.";
                        }
                        $stmt_insert->close();
                    } else {
                         // error_log("Prepare statement insert gagal: " . $conn->error);
                         $error_message = "Terjadi kesalahan internal. Silakan coba lagi.";
                    }
                }
                $stmt_check->close();
            } else {
                 // error_log("Prepare statement check gagal: " . $conn->error);
                 $error_message = "Terjadi kesalahan internal. Silakan coba lagi.";
            }
        }
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - CodeMaster</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="scripts.js" defer></script>
</head>
<body>
    <header class="navbar">
        <div class="container">
            <a href="index.php" class="nav-brand">CodeMaster</a>
            <button class="nav-toggle" id="navToggle" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-links" id="navLinks">
                <li><a href="index.php">Beranda</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="form-card">
                <h2>Buat Akun Baru</h2>

                <?php if (!empty($error_message)): ?>
                    <div id="errorMessage" class="message message-error"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <form action="register.php" method="POST" id="registerForm">
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                </form>
                <p class="form-alternative-link">
                    Sudah punya akun? <a href="login.php">Login di sini</a>
                </p>
            </div>
        </div>
    </main>

    <footer class="footer">
    <div class="container">
        <p>&copy; <?php echo date("Y"); ?> CodeMaster. Hak Cipta Dilindungi.</p>
        <p>
            <a href="contact.php">Hubungi Kami</a> |
            <a href="#">Kebijakan Privasi</a> |
            <a href="#">Ketentuan Layanan</a>
        </p>
    </div>
</footer>
</body>
</html>
