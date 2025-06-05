<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error_message = '';
$success_message = '';

if (isset($_GET['success'])) {
    $success_message = htmlspecialchars($_GET['success']);
}
if (isset($_GET['error'])) { // Tambahan untuk menangani error dari redirect lain jika ada
    $error_message = htmlspecialchars($_GET['error']);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sebaiknya ganti dengan file koneksi terpisah
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "codemaster";
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        // Jangan tampilkan error koneksi detail ke user di produksi
        // error_log("Koneksi database gagal: " . $conn->connect_error);
        $error_message = "Terjadi masalah pada server. Silakan coba lagi nanti.";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            $error_message = "Email dan password tidak boleh kosong.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Format email tidak valid.";
        } else {
            $stmt = $conn->prepare("SELECT id, password, name FROM users WHERE email = ?");
            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($id, $hashed_password, $name);
                    $stmt->fetch();
                    if (password_verify($password, $hashed_password)) {
                        $_SESSION['user_id'] = $id;
                        $_SESSION['user_name'] = $name; // Simpan nama pengguna di sesi
                        header("Location: dashboard.php?login_success=1");
                        exit();
                    } else {
                        $error_message = "Email atau password salah!";
                    }
                } else {
                    $error_message = "Email atau password salah!";
                }
                $stmt->close();
            } else {
                // error_log("Statement prepare gagal: " . $conn->error);
                $error_message = "Terjadi kesalahan. Silakan coba lagi.";
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
    <title>Login - CodeMaster</title>
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
                <li><a href="register.php">Daftar</a></li>
            </ul>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="form-card">
                <h2>Login Akun</h2>

                <?php if (!empty($success_message)): ?>
                    <div id="successMessage" class="message message-success"><?php echo $success_message; ?></div>
                <?php endif; ?>
                <?php if (!empty($error_message)): ?>
                    <div id="errorMessage" class="message message-error"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <form action="login.php" method="POST" id="loginForm">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <p class="form-alternative-link">
                    Belum punya akun? <a href="register.php">Daftar di sini</a>
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
