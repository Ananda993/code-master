CodeMaster: Kursus Pemrograman Privat Terbaik
Selamat datang di repositori proyek CodeMaster! Ini adalah aplikasi web sederhana yang dirancang untuk membantu Anda mengelola kursus pemrograman privat Anda. Baik Anda seorang mentor yang ingin mengatur jadwal, atau seorang siswa yang mencari bimbingan personal, CodeMaster hadir untuk mempermudah prosesnya.

✨ Apa itu CodeMaster?
CodeMaster adalah platform kursus privat yang menghubungkan para pembelajar dengan mentor pemrograman berpengalaman. Kami menyediakan lingkungan yang personal dan fleksibel agar Anda bisa belajar koding sesuai kebutuhan dan kecepatan Anda sendiri.

Kenapa CodeMaster?

Pembelajaran Personal: Dapatkan fokus penuh dari mentor dalam sesi 1-on-1.

Kurikulum Fleksibel: Materi belajar disesuaikan dengan tujuan dan tingkat keahlian Anda.

Jadwal Sesuka Hati: Atur waktu belajar yang paling cocok dengan jadwal sibuk Anda.

Proyek Nyata: Terapkan ilmu Anda dengan mengerjakan proyek praktis dan bangun portofolio Anda.

🚀 Fitur-fitur Utama
Pendaftaran & Login Pengguna: Buat akun baru atau masuk ke akun yang sudah ada dengan mudah.

Dashboard Pengguna: Lihat riwayat pemesanan kursus Anda dalam satu tempat.

Pemesanan Kursus Privat: Pilih bahasa pemrograman, tanggal, dan waktu yang Anda inginkan untuk sesi belajar.

Landing Page Informatif: Halaman depan yang menjelaskan tentang CodeMaster, layanan, dan mengapa harus memilih kami.

Halaman Kontak: Informasi kontak untuk menghubungi tim CodeMaster.

Desain Responsif: Tampilan yang menyesuaikan dengan baik di berbagai ukuran layar (desktop, tablet, mobile).

⚙️ Persyaratan Sistem
Untuk menjalankan proyek CodeMaster di komputer lokal Anda, Anda memerlukan:

Server Web: Apache atau Nginx (biasanya termasuk dalam XAMPP/MAMP/WAMP).

PHP: Versi 7.4 atau yang lebih baru.

Database: MySQL (biasanya termasuk dalam XAMPP/MAMP/WAMP).

Browser Web: Chrome, Firefox, Safari, atau Edge.

📦 Cara Instalasi dan Setup
Ikuti langkah-langkah sederhana ini untuk menjalankan CodeMaster di komputer Anda:

Unduh atau Clone Repositori Ini:
Jika Anda menggunakan Git:

git clone https://github.com/nama_pengguna_anda/codemaster.git
cd codemaster

Atau unduh file ZIP repositori dan ekstrak ke folder pilihan Anda.

Siapkan Server Web:

Jika Anda menggunakan XAMPP/MAMP/WAMP, pindahkan folder codemaster yang sudah Anda unduh/clone ke direktori htdocs (untuk XAMPP/WAMP) atau htdocs/www (untuk MAMP).

Siapkan Database MySQL:

Buka phpMyAdmin (biasanya diakses melalui http://localhost/phpmyadmin).

Buat database baru bernama codemaster.

Impor file codemaster.sql ke database yang baru Anda buat. File ini berisi struktur tabel users dan bookings yang diperlukan.

Konfigurasi Koneksi Database:

Buka file-file PHP berikut: book.php, dashboard.php, login.php, register.php.

Pastikan detail koneksi database di dalamnya ( $db_host, $db_user, $db_pass, $db_name) sesuai dengan pengaturan MySQL lokal Anda. Secara default, mereka sudah diatur untuk XAMPP (localhost, root, "", codemaster).

// Contoh di awal file PHP
$db_host = "localhost";
$db_user = "root"; // Biasanya 'root' untuk XAMPP
$db_pass = "";     // Biasanya kosong untuk XAMPP
$db_name = "codemaster";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

Akses Aplikasi:

Nyalakan server Apache dan MySQL Anda (melalui panel kontrol XAMPP/MAMP/WAMP).

Buka browser web Anda dan kunjungi: http://localhost/codemaster (atau http://localhost:8888/codemaster jika Anda menggunakan MAMP).

📝 Cara Menggunakan Aplikasi
Halaman Utama (Landing Page): Saat pertama kali mengakses index.php, Anda akan melihat halaman landing yang menjelaskan tentang CodeMaster.

Daftar Akun: Klik tombol "Daftar" untuk membuat akun pengguna baru. Isi nama, email, dan password Anda.

Login: Setelah berhasil mendaftar, Anda akan diarahkan ke halaman login. Masukkan email dan password Anda.

Dashboard: Setelah login, Anda akan masuk ke dashboard pribadi Anda, di mana Anda bisa melihat riwayat pemesanan.

Pesan Kursus:

Dari halaman utama (index.php) atau dashboard, Anda bisa menemukan bagian "Pesan Kursus".

Pilih bahasa pemrograman, tanggal, dan waktu yang Anda inginkan. Anda juga bisa menambahkan catatan tambahan.

Klik "Pesan Kursus Sekarang" untuk mengkonfirmasi pemesanan.

Logout: Klik tombol "Logout" di navigasi untuk keluar dari sesi Anda.

📁 Struktur Proyek
Proyek ini memiliki struktur file yang sederhana:

codemaster/
├── index.php         # Halaman utama (landing page & form pemesanan)
├── login.php         # Halaman login pengguna
├── register.php      # Halaman pendaftaran pengguna
├── dashboard.php     # Halaman dashboard untuk riwayat pemesanan
├── book.php          # Proses pengiriman data pemesanan ke database
├── contact.php       # Halaman informasi kontak
├── logout.php        # Proses logout pengguna
├── styles.css        # File CSS untuk semua gaya tampilan
├── scripts.js        # File JavaScript untuk interaktivitas (menu mobile, validasi form, dll.)
└── codemaster.sql    # File SQL untuk membuat database dan tabel

🤝 Kontribusi (Opsional)
Kami menyambut kontribusi dari komunitas! Jika Anda memiliki ide atau ingin meningkatkan proyek ini, silakan:

Fork repositori ini.

Buat branch baru (git checkout -b fitur/nama-fitur-baru).

Lakukan perubahan Anda.

Commit perubahan Anda (git commit -m 'Tambahkan fitur baru: ...').

Push ke branch Anda (git push origin fitur/nama-fitur-baru).

Buka Pull Request baru.

📄 Lisensi (Opsional)
Proyek ini dilisensikan di bawah Lisensi MIT.