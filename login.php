<?php
require_once 'api/auth.php';

// Handle logout action
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $mm3Auth->logout();
    header('Location: login.php');
    exit;
}

// Check if already logged in
$auth = $mm3Auth->checkAuth();
if ($auth['logged_in']) {
    header('Location: index.php');
    exit;
}

// Handle form submission
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    if ($action === 'login') {
        $result = $mm3Auth->login($username, $password);
        if ($result['success']) {
            $redirect = $_GET['redirect'] ?? 'index.php';
            
            // Parse the redirect URL to extract just the path
            $redirectPath = parse_url($redirect, PHP_URL_PATH);
            if ($redirectPath === null) {
                $redirectPath = $redirect;
            }
            
            // Get the base directory (e.g., /mm4/)
            $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
            $scriptDir = rtrim($scriptDir, '/') . '/';
            
            // Remove the base directory from the redirect if it's duplicated
            if (strpos($redirectPath, $scriptDir) === 0) {
                $redirectPath = substr($redirectPath, strlen($scriptDir));
            }
            
            // Clean up the path
            $redirectPath = ltrim($redirectPath, '/');
            
            // If empty or just the base directory, default to index.php
            if (empty($redirectPath) || $redirectPath === '/') {
                $redirectPath = 'index.php';
            }
            
            // Ensure we're not redirecting to an external site
            if (strpos($redirectPath, '://') !== false || strpos($redirectPath, '//') === 0) {
                $redirectPath = 'index.php';
            }
            
            header('Location: ' . $redirectPath);
            exit;
        } else {
            $error = $result['message'];
        }
    } elseif ($action === 'register') {
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        if ($password !== $confirmPassword) {
            $error = 'Passwords do not match';
        } else {
            $result = $mm3Auth->register($username, $password);
            if ($result['success']) {
                $success = $result['message'] . ' You can now log in.';
            } else {
                $error = $result['message'];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MM3 Virtual Companion</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            color: #333;
            font-size: 2.5em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .logo p {
            color: #666;
            font-size: 1.1em;
        }

        .form-tabs {
            display: flex;
            margin-bottom: 30px;
            border-radius: 10px;
            overflow: hidden;
            background: #f0f0f0;
        }

        .tab-btn {
            flex: 1;
            padding: 12px;
            border: none;
            background: transparent;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .checkbox-group input {
            margin-right: 10px;
            width: auto;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-error {
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }

        .alert-success {
            background: #efe;
            color: #3c3;
            border: 1px solid #cfc;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .register-form {
            display: none;
        }

        .register-form.active {
            display: block;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }
            
            .logo h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <h1>⚔️ MM3 vCompanion</h1>
            <p>Maps, Notes, Item Calculator and Tracker</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <div class="form-tabs">
            <button type="button" class="tab-btn active" onclick="showLogin()">Login</button>
            <button type="button" class="tab-btn" onclick="showRegister()">Register</button>
        </div>

        <!-- Login Form -->
        <form method="POST" class="login-form active">
            <input type="hidden" name="action" value="login">
            
            <div class="form-group">
                <label for="login_username">Username</label>
                <input type="text" id="login_username" name="username" required 
                       value="<?= htmlspecialchars($username ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="login_password">Password</label>
                <input type="password" id="login_password" name="password" required>
            </div>


            <button type="submit" class="submit-btn">Login</button>
        </form>

        <!-- Register Form -->
        <form method="POST" class="register-form">
            <input type="hidden" name="action" value="register">
            
            <div class="form-group">
                <label for="reg_username">Username</label>
                <input type="text" id="reg_username" name="username" required 
                       minlength="2" placeholder="At least 2 characters">
            </div>

            <div class="form-group">
                <label for="reg_password">Password</label>
                <input type="password" id="reg_password" name="password" required 
                       minlength="6" placeholder="At least 6 characters">
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required 
                       minlength="6" placeholder="Repeat your password">
            </div>

            <button type="submit" class="submit-btn">Create Account</button>
        </form>
    </div>

    <script>
        function showLogin() {
            document.querySelector('.login-form').classList.add('active');
            document.querySelector('.register-form').classList.remove('active');
            document.querySelectorAll('.tab-btn')[0].classList.add('active');
            document.querySelectorAll('.tab-btn')[1].classList.remove('active');
        }

        function showRegister() {
            document.querySelector('.login-form').classList.remove('active');
            document.querySelector('.register-form').classList.add('active');
            document.querySelectorAll('.tab-btn')[0].classList.remove('active');
            document.querySelectorAll('.tab-btn')[1].classList.add('active');
        }

        // Password confirmation validation
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('reg_password').value;
            const confirm = this.value;
            
            if (confirm && password !== confirm) {
                this.setCustomValidity('Passwords do not match');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html>