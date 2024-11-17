<?php
include 'db_connect.php'; // Ensure this file establishes a connection to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validate inputs
    if (empty($username) || empty($email) || empty($password)) {
        echo "<script>alert('All fields are required!'); window.location.href='register.php';</script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!'); window.location.href='register.php';</script>";
        exit();
    }

    if (!preg_match('/^[a-zA-Z][a-zA-Z0-9_]{5,29}$/', $username)) {
        echo "<script>alert('Username must be 6-30 characters long, start with a letter, and contain only letters, numbers, and underscores.'); window.location.href='register.php';</script>";
        exit();
    }

    if (strlen($password) < 8 || !preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}/', $password)) {
        echo "<script>alert('Password must be at least 8 characters long and include uppercase, lowercase, and a number.'); window.location.href='register.php';</script>";
        exit();
    }

    // Check if the username or email already exists
    $check_user = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $check_user->bind_param("ss", $username, $email);
    $check_user->execute();
    $result = $check_user->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username or email already exists! Please choose a different one.'); window.location.href='register.php';</script>";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert new user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! Please login.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error occurred during registration. Please try again later.'); window.location.href='register.php';</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
