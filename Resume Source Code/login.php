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
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Login — Resume Portal</title>


<link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">

<style>
:root{
    --navy: #061633;
    --accent: #0f4c81;
    --card: #ffffff;
    --muted: #d3d6db;
    --soft-shadow: rgba(0,0,0,0.22);
    --glass: rgba(255,255,255,0.06);
}


* { box-sizing: border-box; }
html,body { height:100%; margin:0; font-family: "Segoe UI", Tahoma, sans-serif; -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale; color:#04263b; }


body {
    background: radial-gradient(circle at 10% 10%, rgba(11,76,129,0.14), transparent 8%),
                radial-gradient(circle at 90% 80%, rgba(11,95,154,0.10), transparent 12%),
                linear-gradient(160deg, #071733 0%, #0b2948 35%, #04223b 100%);
    overflow-y: auto;
}


body::before, body::after {
    content: "";
    position: fixed;
    pointer-events: none;
    filter: blur(40px);
    opacity: 0.55;
    z-index: 0;
}
body::before {
    width: 420px;
    height: 420px;
    left: -80px;
    top: -60px;
    background: radial-gradient(circle at 30% 30%, rgba(15,76,129,0.64), rgba(15,76,129,0.24) 40%, transparent 65%);
    transform: rotate(-12deg);
}
body::after {
    width: 540px;
    height: 360px;
    right: -110px;
    bottom: -40px;
    background: radial-gradient(circle at 60% 40%, rgba(11,95,154,0.5), rgba(11,95,154,0.22) 45%, transparent 70%);
    transform: rotate(8deg);
}


.background-pattern {
    position: fixed;
    inset: 0;
    background-image: linear-gradient(135deg, rgba(255,255,255,0.015) 1px, transparent 1px);
    background-size: 24px 24px;
    z-index: 0;
}


.wrap {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px 20px;
    position: relative;
    z-index: 1; 
}


.card {
    width: 420px;
    border-radius: 14px;
    overflow: hidden;
    background: linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
    backdrop-filter: blur(6px) saturate(1.02);
    box-shadow: 0 18px 50px var(--soft-shadow);
    border: 1px solid rgba(255,255,255,0.04);
    position: relative;
}


.card .band {
    background: linear-gradient(90deg, var(--accent), #0b5f9a);
    padding: 28px 22px;
    display:flex;
    align-items:center;
    gap: 14px;
    justify-content: center;
    position: relative;
}


.brand-icon {
    width: 78px;
    height: 78px;
    border-radius: 50%;
    background: rgba(255,255,255,0.12);
    display:flex;
    align-items:center;
    justify-content:center;
    color: #fff;
    font-size: 36px;
    border: 2px solid rgba(255,255,255,0.08);
    box-shadow: 0 8px 22px rgba(0,0,0,0.18);
}


.brand-text {
    color: #fff;
    text-align: left;
}
.brand-text .title {
    font-family: "Georgia", "Times New Roman", serif;
    font-size: 20px;
    font-weight:700;
    line-height:1;
}
.brand-text .subtitle {
    font-size: 12px;
    opacity: 0.95;
    letter-spacing: 1px;
    margin-top: 6px;
}


.inner {
    padding: 22px 22px 28px 22px;
    background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
}


.inner::before {
    content: "";
    position: absolute;
    width: 160px;
    height: 160px;
    right: -40px;
    top: -60px;
    background: radial-gradient(circle, rgba(15,76,129,0.06) 0%, rgba(15,76,129,0.02) 40%, transparent 60%);
    transform: rotate(8deg);
    z-index: 0;
}


h2 { margin:0 0 8px; font-size:18px; color:#fff; text-align:left; }
.form-row { margin-bottom:12px; position: relative; z-index:1; }
label { display:block; font-weight:600; font-size:13px; color: #dcebf9; margin-bottom:6px; }
input[type="text"], input[type="password"] {
    width:100%; padding:10px 12px; border-radius:8px; border: none;
    background: rgba(255,255,255,0.08); color:#fff;
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.02);
    font-size:14px; outline:none;
    transition: box-shadow .12s ease, transform .08s ease;
}
input::placeholder { color: rgba(255,255,255,0.6); }
input:focus { box-shadow: 0 6px 18px rgba(11,95,154,0.18); transform: translateY(-1px); }


.actions {
    display:flex; align-items:center; justify-content:space-between; gap:12px;
    margin-top:8px;
}
button.primary {
    background: linear-gradient(180deg, #1b73b8, #0e5a9a);
    color:#fff; border:none; padding:10px 16px; border-radius:10px;
    font-weight:700; cursor:pointer; box-shadow: 0 12px 28px rgba(11,95,154,0.18);
    transition: transform .08s ease;
}
button.primary:active { transform: translateY(1px); }
.hint { color: rgba(255,255,255,0.85); font-size:13px; }


.error {
    margin-top:12px;
    padding:10px 12px;
    background: rgba(255,210,210,0.08);
    border-left: 4px solid rgba(235,90,90,0.22);
    color: #ffd2d2;
    border-radius:6px;
    font-size:13px;
}


.card .side-deco {
    position:absolute;
    left:-42px;
    top:50%;
    transform: translateY(-50%);
    width:86px;
    height:86px;
    border-radius:18px;
    background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01));
    border: 1px solid rgba(255,255,255,0.03);
    display:flex;
    align-items:center;
    justify-content:center;
    color: rgba(255,255,255,0.85);
    font-size:34px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.18);
}


.footer-note { margin-top:14px; font-size:12px; color: rgba(255,255,255,0.68); text-align:center; }


@media (max-width:460px) {
    .card { width: 100%; border-radius: 12px; }
    .brand-text { display:none; }
    .brand-icon { width:64px; height:64px; font-size:28px; }
    .card .side-deco { display:none; }
    .inner::before { display:none; }
}


input:focus, button:focus, a:focus { outline: 3px solid rgba(15,76,129,0.18); outline-offset: 2px; }
</style>

<body>
    <div class="background-pattern" aria-hidden="true"></div>

    <div class="wrap">
        <div class="card" role="region" aria-label="Login">
            <div class="band">
                <div class="brand-icon"><i class="ri-profile-line"></i></div>
                <div class="brand-text" aria-hidden="false">
                    <div class="title">JUSTINE PAGDONSOLAN</div>
                    <div class="subtitle">Resume Portal</div>
                </div>

                <!-- decorative side icon -->
                <div class="side-deco" aria-hidden="true"><i class="ri-lock-2-line"></i></div>
            </div>

            <div class="inner">
                <h2 style="color:#fff;">Sign in to view resume</h2>

                <form method="post" action="login.php" novalidate>
                    <div class="form-row">
                        <label for="username">Username</label>
                        <input id="username" name="username" type="text" value="<?php echo $old['username']; ?>" required placeholder="Enter username" autocomplete="username" inputmode="text">
                    </div>

                    <div class="form-row">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" required placeholder="Enter password" autocomplete="current-password">
                    </div>

                    <div class="actions">
                        <div class="hint">Use <b>student</b> / <b>1234</b></div>
                        <button id="login-btn" class="primary" type="submit">Login</button>
                    </div>

                    <?php if ($error !== ""): ?>
                        <div class="error" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>

                    <div class="footer-note">This demo uses sample credentials. For production, use HTTPS and hashed passwords.</div>
                </form>
            </div>
        </div>
    </div>

<script>
    
    function onInputChange(){
        const u = document.getElementById('username').value.trim();
        const p = document.getElementById('password').value;
        document.getElementById('login-btn').disabled = (u === '' || p === '');
    }
    document.addEventListener('DOMContentLoaded', function(){
        const u = document.getElementById('username');
        const p = document.getElementById('password');
        u.addEventListener('input', onInputChange);
        p.addEventListener('input', onInputChange);
        onInputChange();
    });
</script>
</body>
</html>
