<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <div class="container">
        <h2 class="form-title">User Login</h2>
        <form method="post" action="login_process.php" class="form">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" required>
                    <button type="button" id="togglePassword" class="toggle-password">Show</button>
                </div>
            </div>
            <button type="submit" class="btn"><a href="services.php">Login</a></button>
            <p class="form-footer">New user? <a href="register.php">Register here</a></p>
        </form>
    </div>
    <script>
        const togglePassword = document.getElementById("togglePassword");
        const passwordInput = document.getElementById("password");

        togglePassword.addEventListener("click", () => {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
            togglePassword.textContent = type === "password" ? "Show" : "Hide";
        });
    </script>
</body>
</html>
