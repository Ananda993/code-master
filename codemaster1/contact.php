<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - CodeMaster</title>
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
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="index.php#booking-section">Pesan Kursus</a></li>
                    <li><a href="logout.php" class="button-style-outline">Logout</a></li>
                <?php else: ?>
                    <li><a href="index.php#features">Fitur</a></li>
                    <li><a href="login.php" class="button-style-outline">Login</a></li>
                    <li><a href="register.php" class="button-style">Daftar</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="contact-card">
                <h2>Hubungi Kami</h2>
                <p>Untuk informasi lebih lanjut, silakan hubungi tim kami:</p>
                
                <div class="contact-list">
                    <div class="contact-item">
                        <h3>Ni Kadek Dwi Puspita Sari</h3>
                        <p><i class="fas fa-envelope"></i> Email: <a href="mailto:dwipuspit@codemaster.com">dwipuspit@codemaster.com</a></p>
                    </div>
                    <div class="contact-item">
                        <h3>Ni Luh Putu Eka Mulianingsih</h3>
                        <p><i class="fas fa-envelope"></i> Email: <a href="mailto:putuekamulia@codemaster.com">putuekamulia@codemaster.com</a></p>
                    </div>
                    <div class="contact-item">
                        <h3>Ni Nyoman Trisna Yanti</h3>
                        <p><i class="fas fa-envelope"></i> Email: <a href="mailto:trisnayanti@codemaster.com">trisnayanti@codemaster.com</a></p>
                    </div>
                    <div class="contact-item">
                        <h3>Ni Putu Laksmi Priya Dewi Dasi</h3>
                        <p><i class="fas fa-envelope"></i> Email: <a href="mailto:laksmipriya@codemaster.com">laksmipriya@codemaster.com</a></p>
                    </div>
                </div>
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
