<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=" . urlencode("Anda harus login untuk melakukan pemesanan."));
    exit();
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: index.php");
    exit();
}

// Database configuration
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "codemaster";

// Establish database connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    header("Location: index.php?booking_status=error_db#booking-section");
    exit();
}

// Validate and sanitize input
$language = isset($_POST['language']) ? trim($conn->real_escape_string($_POST['language'])) : '';
$date = isset($_POST['date']) ? trim($conn->real_escape_string($_POST['date'])) : '';
$time = isset($_POST['time']) ? trim($conn->real_escape_string($_POST['time'])) : '';
$notes = isset($_POST['notes']) ? trim($conn->real_escape_string($_POST['notes'])) : '';
$user_id = $_SESSION['user_id'];

// Basic validation
if (empty($language) || empty($date) || empty($time)) {
    header("Location: index.php?booking_status=error_incomplete#booking-section");
    exit();
}

// Date validation
$selected_datetime = strtotime($date . ' ' . $time);
$current_datetime = time();

if ($selected_datetime === false) {
    header("Location: index.php?booking_status=error_invalid_date#booking-section");
    exit();
}

if ($selected_datetime < $current_datetime) {
    header("Location: index.php?booking_status=error_past_date#booking-section");
    exit();
}

// Prepare and execute the insert statement
$stmt = $conn->prepare("INSERT INTO bookings (user_id, language, date, time, notes) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    error_log("Prepare failed: " . $conn->error);
    header("Location: index.php?booking_status=error_statement#booking-section");
    exit();
}

$stmt->bind_param("issss", $user_id, $language, $date, $time, $notes);

if (!$stmt->execute()) {
    error_log("Execute failed: " . $stmt->error);
    header("Location: index.php?booking_status=error_failed#booking-section");
    $stmt->close();
    $conn->close();
    exit();
}

// Success - redirect to dashboard
$stmt->close();
$conn->close();
header("Location: dashboard.php?booking_status=success");
exit();
?>
