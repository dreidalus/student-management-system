<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>

    <!-- Bootstrap CSS for styling the navbar -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles (optional) -->
    <style>
        .navbar-brand {
            font-weight: bold;
        }
        .navbar-nav {
            margin-left: auto;
        }
    </style>
</head>
<body>
    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?= site_url('/') ?>">Student Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('dashboard') ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('courses') ?>">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('students') ?>">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('attendance') ?>">Attendance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('grades') ?>">Grades</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Optional: Add some space between the navbar and the content -->
    <div class="container mt-3">
