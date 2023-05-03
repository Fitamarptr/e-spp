<?php
session_start();

// Data user
$users = [
    [
        'username' => 'admin',
        'password' => 'password',
        'role' => 'admin',
        'redirect' => 'View/dashboard.php'
    ],
    [
        'username' => 'staff',
        'password' => 'password',
        'role' => 'staff',
        'redirect' => 'View/dashboard.php'
    ],
    [
        'username' => 'fazry',
        'password' => 'password',
        'role' => 'user',
        'redirect' => 'View/dashboard.php'
    ]
];

// Jika form login disubmit
if (isset($_POST['login'])) {
    // Validasi input
    $errors = [];
    if (empty($_POST['username'])) {
        $errors[] = 'Username harus diisi';
    }
    if (empty($_POST['password'])) {
        $errors[] = 'Password harus diisi';
    }

    // Jika tidak ada error, cek apakah user terdaftar
    if (empty($errors)) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        foreach ($users as $user) {
            if ($user['username'] == $username && $user['password'] == $password) {
                // User terdaftar, simpan data user ke session
                $_SESSION['user'] = $user;
                // Redirect ke halaman sesuai role
                header('Location: ' . $user['redirect']);
                exit;
            }
        }

        // User tidak terdaftar
        $errors[] = 'Username atau password salah';
    }
}

?>


<!doctype html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="login.css">
</head>
<body>

<?php if (!empty($errors)): ?>
        <div style="color: red;">
            <?php foreach ($errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form action="" method="post">
        <div class="section">
            <div class="container">
                <div class="row full-height justify-content-center">
                    <div class="col-12 text-center align-self-center py-5">
                        <div class="section pb-5 pt-5 pt-sm-2 text-center">
                            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
                            <div class="card-3d-wrap mx-auto">
                                <div class="card-3d-wrapper">
                                    <div class="card-front">
                                        <div class="center-wrap">
                                            <div class="section text-center">
                                                <h4 class="mb-4 pb-3">Log In</h4>
                                                <div class="form-group">
                                                    <input type="username" class="form-style" placeholder="username"  name="username">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>	
                                                <div class="form-group mt-2">
                                                    <input type="password" class="form-style" placeholder="Password" name="password">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <button class="btn mt-4" type="submit" name="login">Login</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>