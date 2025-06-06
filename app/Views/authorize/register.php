<?php
    $session = \Config\Services::session();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-container {
            max-width: 450px;
            margin: 80px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h3 class="text-center mb-4">Create an Account</h3>

        <?php if ($session->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= $session->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if ($session->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= $session->getFlashdata('success') ?></div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('authorize/register') ?>">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-control">
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select>

            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Register</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <a href="<?= site_url('authorize/login') ?>">Already have an account? Login here</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
