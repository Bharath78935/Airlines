<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <div class="container">
        <h2 class="form-title">User Registration</h2>
        <form method="post" action="register_proccess.php" class="form">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" required>
                    <button type="button" id="togglePassword" class="toggle-password">Show</button>
                </div>
            </div>
            <button type="submit" class="btn">Register</button>
            <p class="form-footer">Already have an account? <a href="login.php">Login here</a></p>
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
