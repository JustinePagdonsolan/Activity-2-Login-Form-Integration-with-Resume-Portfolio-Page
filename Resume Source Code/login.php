<?php
session_start();

// If already logged in, go straight to resume
if (isset($_SESSION['username'])) {
    header("Location: resume_protected.php");
    exit();
}

$error = "";
$old = ['username' => ''];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Trim and collect
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Keep old values for convenience (not password)
    $old['username'] = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

    // Validation: required
    if ($username === '' || $password === '') {
        $error = "All fields are required.";
    }
    // Validation: username allowed chars (alphanumeric + _ and -)
    elseif (!preg_match('/^[A-Za-z0-9_\-]+$/', $username)) {
        $error = "Username may only contain letters, numbers, underscore and dash.";
    }
    // Validation: password minimum length
    elseif (strlen($password) < 4) {
        $error = "Password must be at least 4 characters.";
    } else {
        // -- Authentication (sample hardcoded credentials) --
        // Replace this block with DB lookup or hashed password check in a real app
        $validUsername = "student";
        $validPassword = "1234";

        if ($username === $validUsername && $password === $validPassword) {
            // Success: save session and redirect
            $_SESSION['username'] = $username;
            // Regenerate session id for security
            session_regenerate_id(true);
            header("Location: resume_protected.php");
            exit();
        } else {
            $error = "Invalid login credentials.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .container { width: 360px; margin: 90px auto; padding: 22px; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        label { display:block; margin-bottom:6px; font-weight:600; }
        input[type="text"], input[type="password"] { width:100%; padding:8px; margin-bottom:12px; box-sizing: border-box; border:1px solid #ccc; border-radius:4px; }
        button { padding:10px 16px; border:none; background:#333; color:#fff; border-radius:4px; cursor:pointer; }
        .error { color: #b00020; margin-top:10px; }
        .hint { font-size:13px; color:#555; margin-top:8px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="post" action="login.php" novalidate>
            <label for="username">Username</label>
            <input id="username" name="username" type="text" value="<?php echo $old['username']; ?>" required>

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>

            <button type="submit">Login</button>
        </form>

        <?php if ($error !== ""): ?>
            <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php else: ?>
            <p class="hint">Sample credentials: <b>student</b> / <b>1234</b></p>
        <?php endif; ?>
    </div>
</body>
</html>

