<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_name = isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Pengguna';
$success_message = '';
$error_message = '';

// Pesan setelah login sukses
if (isset($_GET['login_success'])) {
    $success_message = "Selamat datang kembali, " . $user_name . "!";
}
// Pesan setelah booking sukses (dari book.php)
if (isset($_GET['booking_status']) && $_GET['booking_status'] === 'success') {
    $success_message = "Pemesanan kursus Anda telah berhasil ditambahkan!";
}

// Ambil data booking
$bookings = [];
$db_host = "localhost"; $db_user = "root"; $db_pass = ""; $db_name = "codemaster";
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    $error_message = "Tidak dapat memuat data pemesanan saat ini.";
} else {
    // Query modified to remove 'notes' column if it doesn't exist
    $stmt = $conn->prepare("SELECT id, language, date, time FROM bookings WHERE user_id = ? ORDER BY date DESC, time DESC");
    if ($stmt) {
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $bookings = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    } else {
        $error_message = "Gagal memuat riwayat pemesanan.";
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CodeMaster</title>
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
                <li><a href="index.php#booking-section">Pesan Kursus Baru</a></li>
                <li><a href="logout.php" class="button-style-outline">Logout</a></li>
            </ul>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="dashboard-header">
                <h1>Dashboard Anda</h1>
                <p>Selamat datang, <?php echo $user_name; ?>! Kelola jadwal kursus Anda di sini.</p>
            </div>

            <?php if (!empty($success_message)): ?>
                <div id="successMessage" class="message message-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <?php if (!empty($error_message)): ?>
                <div id="errorMessage" class="message message-error"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <h2 style="margin-bottom: 1.5rem;">Riwayat Pemesanan Kursus</h2>
            <?php if (empty($bookings)): ?>
                <div class="no-bookings">
                    <p>Anda belum memiliki pemesanan kursus.</p>
                    <a href="index.php#booking-section" class="btn btn-primary" style="margin-top:1rem;">Pesan Kursus Sekarang</a>
                </div>
            <?php else: ?>
                <div class="bookings-container">
                    <?php foreach ($bookings as $booking): ?>
                        <div class="booking-card">
                            <h3><?php echo htmlspecialchars($booking['language']); ?></h3>
                            <p><strong>Tanggal:</strong> <?php echo htmlspecialchars(date("d M Y", strtotime($booking['date']))); ?></p>
                            <p><strong>Waktu:</strong> <?php echo htmlspecialchars(date("H:i", strtotime($booking['time']))); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
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
