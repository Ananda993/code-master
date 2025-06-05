<?php
session_start();
// Koneksi ke database (jika diperlukan di halaman ini di masa depan, saat ini tidak)
// Anda dapat mengaktifkan ini jika ada data dinamis yang perlu dimuat di landing page.
// $conn = new mysqli("localhost", "root", "", "codemaster");
// if ($conn->connect_error) {
//     die("Koneksi gagal: " . $conn->connect_error);
// }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeMaster - Kursus Pemrograman Privat Terbaik</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Untuk ikon -->
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
                <li><a href="index.php#hero" class="active">Beranda</a></li>
                <li><a href="index.php#about">Tentang Kami</a></li>
                <li><a href="index.php#services">Layanan</a></li>
                <li><a href="index.php#features">Mengapa Kami?</a></li>
                <li><a href="contact.php">Kontak</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="index.php#booking-section">Pesan Kursus</a></li>
                    <li><a href="logout.php" class="button-style-outline">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="button-style-outline">Login</a></li>
                    <li><a href="register.php" class="button-style">Daftar</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>

    <main>
        <!-- Hero Section - Landing Page Utama -->
        <section id="hero" class="hero">
            <div class="container">
                <h1>Kuasi Dunia Koding dengan CodeMaster!</h1>
                <p>Bimbingan privat intensif dan personal untuk meraih keahlian pemrograman impian Anda.</p>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="register.php" class="btn btn-primary">Mulai Belajar Sekarang</a>
                <?php else: ?>
                    <a href="#booking-section" class="btn btn-primary">Pesan Kursus Sekarang</a>
                <?php endif; ?>
            </div>
        </section>

        <!-- About Us Section -->
        <section id="about" class="about-section container">
            <h2 class="section-title">Tentang CodeMaster</h2>
            <div class="about-content">
                <div class="about-image">
                    <img src="tim.jpg" alt="Tim CodeMaster">
                </div>
                <div class="about-text">
                    <p><strong>CodeMaster</strong> adalah platform kursus pemrograman privat terkemuka yang didedikasikan untuk membantu individu dari berbagai latar belakang menguasai keterampilan koding.</p>
                    <p>Kami percaya bahwa setiap orang memiliki potensi untuk menjadi seorang programmer hebat, dan dengan bimbingan yang tepat, Anda bisa mencapai tujuan tersebut. Mentor-mentor kami adalah praktisi industri berpengalaman yang siap berbagi pengetahuan dan pengalaman nyata.</p>
                    <p>Fokus kami adalah pembelajaran yang personal dan interaktif, memastikan Anda mendapatkan perhatian penuh dan kurikulum yang disesuaikan dengan gaya belajar serta tujuan karier Anda.</p>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="services-section">
            <div class="container">
                <h2 class="section-title">Layanan Kami</h2>
                <div class="services-grid">
                    <div class="service-item">
                        <div class="icon"><i class="fas fa-laptop-code"></i></div>
                        <h3>Kursus Privat 1-on-1</h3>
                        <p>Dapatkan perhatian penuh dari mentor dengan sesi belajar yang disesuaikan secara individual.</p>
                    </div>
                    <div class="service-item">
                        <div class="icon"><i class="fas fa-project-diagram"></i></div>
                        <h3>Bimbingan Proyek</h3>
                        <p>Kami membantu Anda membangun proyek nyata untuk portofolio yang kuat dan menunjang karier.</p>
                    </div>
                    <div class="service-item">
                        <div class="icon"><i class="fas fa-file-code"></i></div>
                        <h3>Review Kode</h3>
                        <p>Dapatkan umpan balik konstruktif terhadap kode Anda dari para ahli.</p>
                    </div>
                    <div class="service-item">
                        <div class="icon"><i class="fas fa-users-cog"></i></div>
                        <h3>Konsultasi Karir Tech</h3>
                        <p>Dapatkan saran dan arahan tentang jalur karir terbaik di industri teknologi.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section (Pindah ke bawah, tetap ditampilkan) -->
        <section id="features" class="features-section">
            <div class="container">
                <h2 class="section-title">Mengapa Memilih CodeMaster?</h2>
                <div class="features-grid">
                    <div class="feature-item">
                        <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
                        <h3>Mentor Berpengalaman</h3>
                        <p>Belajar dari praktisi industri yang ahli di bidangnya.</p>
                    </div>
                    <div class="feature-item">
                        <div class="icon"><i class="fas fa-cogs"></i></div>
                        <h3>Kurikulum Fleksibel</h3>
                        <p>Materi disesuaikan dengan kecepatan dan target belajar Anda.</p>
                    </div>
                    <div class="feature-item">
                        <div class="icon"><i class="fas fa-clock"></i></div>
                        <h3>Jadwal Fleksibel</h3>
                        <p>Atur jadwal belajar yang paling sesuai untuk Anda.</p>
                    </div>
                     <div class="feature-item">
                        <div class="icon"><i class="fas fa-lightbulb"></i></div>
                        <h3>Proyek Praktis</h3>
                        <p>Terapkan ilmu dengan mengerjakan proyek nyata dan membangun portofolio.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Booking Section (Hanya tampil jika user sudah login) -->
        <section id="booking-section" class="container">
            <?php if (isset($_SESSION['user_id'])): ?>
                <h2 class="section-title">Pesan Sesi Kursus Anda</h2>
                <div class="booking-form-container">
                    <div id="bookingMessage" class="message hidden" role="alert"></div>
                    <form id="bookingForm" action="book.php" method="POST">
                        <div class="form-group">
                            <label for="language">Bahasa Pemrograman</label>
                            <select id="language" name="language" class="form-control" required>
                                <option value="">Pilih bahasa</option>
                                <option value="Python">Python</option>
                                <option value="JavaScript">JavaScript</option>
                                <option value="Java">Java</option>
                                <option value="PHP">PHP</option>
                                <option value="C++">C++</option>
                                <option value="Ruby">Ruby</option>
                                <option value="Go">Go</option>
                                <option value="Swift">Swift</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Tanggal Pilihan</label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="time">Waktu Pilihan</label>
                            <input type="time" id="time" name="time" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="notes">Catatan Tambahan (Opsional)</label>
                            <textarea id="notes" name="notes" rows="4" class="form-control" placeholder="cth: 'Saya butuh bantuan terkait web scraping Python' atau 'Fokus pada OOP Java'"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">Pesan Kursus Sekarang</button>
                    </form>
                </div>
            <?php else: ?>
                <!-- Konten alternatif jika belum login -->
                <h2 class="section-title">Siap Memulai? Pesan Kursus Sekarang!</h2>
                <div class="form-card text-center">
                    <p>Untuk memesan sesi kursus privat, Anda perlu masuk atau mendaftar terlebih dahulu.</p>
                    <p>Jelajahi berbagai bahasa pemrograman yang kami tawarkan dan mulailah perjalanan koding Anda bersama CodeMaster!</p>
                    <div style="margin-top: 1.5rem;">
                        <a href="login.php" class="btn btn-primary" style="margin-right: 10px;">Login</a>
                        <a href="register.php" class="btn btn-secondary">Daftar</a>
                    </div>
                </div>
            <?php endif; ?>
        </section>

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
