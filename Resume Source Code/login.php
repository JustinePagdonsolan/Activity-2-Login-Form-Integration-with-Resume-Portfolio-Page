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
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        :root{
            --navy: #061633;
            --accent: #0f4c81;
            --card: #ffffff;
            --muted: #d3d6db;
            --text-dark: #061633;
        }

        html,body{
            height:100%;
            margin:0;
            font-family: "Segoe UI", "Helvetica Neue", Arial, sans-serif;
            background: linear-gradient(180deg, var(--navy) 0%, #052032 100%);
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
            color: #04263b;
        }

        .wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px;
            box-sizing: border-box;
        }

        .card {
            width: 380px;
            background: var(--card);
            border-radius: 10px;
            box-shadow: 0 14px 40px rgba(2,18,36,0.35);
            overflow: hidden;
            position: relative;
        }

        .card .band {
            height: 92px;
            background: linear-gradient(90deg, var(--accent), #0b5f9a);
            display:flex;
            align-items:center;
            justify-content:center;
            color: #fff;
            flex-direction: column;
            padding: 12px 16px;
        }
        .band .brand {
            font-family: "Georgia", "Times New Roman", serif;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.6px;
        }
        .band .subtitle {
            font-size: 12px;
            opacity: 0.95;
            margin-top:4px;
            text-transform:uppercase;
            letter-spacing:1px;
        }

        .card .inner {
            padding: 20px 24px 28px 24px;
        }

        label {
            display:block;
            margin-bottom:6px;
            font-weight:600;
            color: #083049;
            font-size: 13px;
        }

        input[type="text"], input[type="password"]{
            width:100%;
            padding:10px 12px;
            margin-bottom:14px;
            border-radius:6px;
            border:1px solid #d9dde3;
            box-sizing:border-box;
            font-size:14px;
            outline: none;
            transition: box-shadow .15s ease, border-color .15s ease;
        }
        input[type="text"]:focus, input[type="password"]:focus{
            box-shadow: 0 4px 14px rgba(15,76,129,0.12);
            border-color: var(--accent);
        }

        .actions {
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;
        }

        button.primary {
            background: linear-gradient(180deg,var(--accent), #0b5f9a);
            color:#fff;
            border:none;
            padding:10px 16px;
            border-radius:8px;
            cursor:pointer;
            font-weight:600;
            box-shadow: 0 8px 22px rgba(11,95,154,0.14);
            transition: transform .08s ease, box-shadow .08s ease;
        }
        button.primary:active { transform: translateY(1px); }
        button.primary:disabled { opacity: 0.6; cursor:not-allowed; }

        .hint {
            font-size:13px;
            color:#6b7b88;
        }

        .error {
            margin-top:12px;
            padding:10px 12px;
            background: #fff3f3;
            border: 1px solid #f0c6c6;
            color: #8b1d1d;
            border-radius:6px;
            font-size:13px;
        }

        .footer-note {
            margin-top:14px;
            font-size:12px;
            color:#8aa0b3;
            text-align:center;
        }

        /* small mobile tweak */
        @media (max-width:420px){
            .card { width: 100%; }
            .band { height: 86px; }
        }
    </style>
    <script>
        // small client-side helper: enable/disable login button if fields empty
        function onInputChange(){
            const u = document.getElementById('username').value.trim();
            const p = document.getElementById('password').value;
            document.getElementById('login-btn').disabled = (u === '' || p === '');
        }
        window.addEventListener('DOMContentLoaded', function(){
            document.getElementById('username').addEventListener('input', onInputChange);
            document.getElementById('password').addEventListener('input', onInputChange);
            onInputChange();
        });
    </script>
</head>
<body>
    <div class="wrap">
        <div class="card" role="main" aria-labelledby="login-title">
            <div class="band" aria-hidden="false">
                <div class="brand">JUSTINE PAGDONSOLAN</div>
                <div class="subtitle">Resume Portal</div>
            </div>

            <div class="inner">
                <h2 id="login-title" style="margin:0 0 12px 0; font-size:18px; color:#04263b;">Sign in</h2>

                <form method="post" action="login.php" novalidate>
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" value="<?php echo $old['username']; ?>" required autocomplete="username" inputmode="text">

                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password">

                    <div class="actions" style="margin-top:6px;">
                        <div class="hint">Use <b>student</b> / <b>1234</b></div>
                        <button id="login-btn" class="primary" type="submit">Login</button>
                    </div>

                    <?php if ($error !== ""): ?>
                        <div class="error" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>

                    <div class="footer-note">This page is for demo purposes. In production, use HTTPS and hashed passwords.</div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

