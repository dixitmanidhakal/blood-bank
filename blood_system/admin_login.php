<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] == 'admin' && $_POST['password'] == 'admin123') {
        $_SESSION['admin'] = true;
        header('Location: admin_dashboard.php');
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Management System - Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /* BLOOD DONATION THEME */
        :root {
            --blood-red: #DC3545;
            --dark-blood: #A41214;
            --blood-gold: #B79455;
        }
        body {
            background: linear-gradient(135deg, var(--blood-red) 0%, var(--dark-blood) 50%, #8A0302 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(220,53,69,0.4);
            border: 1px solid rgba(220,53,69,0.3);
            overflow: hidden;
        }
        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--blood-red), var(--blood-gold));
        }
        .blood-drop {
            font-size: 4rem;
            background: linear-gradient(135deg, #FFD700, var(--blood-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 0 10px rgba(183,148,85,0.5));
        }
        .btn-login {
            background: linear-gradient(135deg, var(--blood-red), var(--dark-blood));
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(220,53,69,0.4);
            transition: all 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220,53,69,0.6);
        }
        .form-control:focus {
            border-color: var(--blood-red);
            box-shadow: 0 0 0 0.2rem rgba(220,53,69,0.25);
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 p-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card login-card shadow-lg position-relative mx-auto" style="max-width: 400px;">
                    <div class="card-body p-5">
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <div class="blood-drop mb-3">
                                <i class="fas fa-tint"></i>
                            </div>
                            <h2 class="fw-bold mb-2 text-danger">BDMS Admin</h2>
                            <p class="text-muted mb-0">Blood Donation Management System</p>
                        </div>

                        <!-- Error Message -->
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i><?= $error ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Login Form -->
                        <form method="POST">
                            <div class="mb-4">
                                <label class="form-label fw-bold text-danger mb-2">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-danger">
                                        <i class="fas fa-user text-danger"></i>
                                    </span>
                                    <input type="text" class="form-control" name="username" 
                                           placeholder="Enter username" value="admin" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold text-danger mb-2">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-danger">
                                        <i class="fas fa-lock text-danger"></i>
                                    </span>
                                    <input type="password" class="form-control" name="password" 
                                           placeholder="Enter password" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-login w-100 text-white py-3 fs-6">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Enter Blood Portal
                            </button>
                        </form>

                        <!-- Demo Credentials -->
                        <div class="text-center mt-4">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Demo: admin / admin123
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
