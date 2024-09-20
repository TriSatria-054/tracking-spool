<?php 

session_start();

// Check if the user is logged in
if((isset($_SESSION['ucode']) && !empty($_SESSION['ucode'])) || isset($_SESSION['login'])) {
    // Redirect to feed.php
    header('Location: feed.php');
    exit; // Ensure that no further code is executed after redirection
}

require 'functions.php';




 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPMS</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
       body {
            background-color: #f8f9fa;
            color: #212529;
        }

        .feature {
            margin-bottom: 30px;
        }

        .feature h3 {
            margin-top: 20px;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .logo {
            max-width: 100%;
            height: 50px;
        }

        
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="feed.php">SPMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                
                <li class="nav-item">
                    <a class="nav-link" href="move_spool.php">Move Spool</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="install_spool.php">Install Spool</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="spool_control.php">Spool Control</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="progress.php">Progress</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="database_spool.php">Database</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>

<div class="container mt-4">
    <br>
    <div class="row">
            <div class="col-md-12">
                <form class="form-inline my-2 my-lg-0" action="move_spool.php" method="post">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search..." aria-label="Search" name="keyword" id="keyword">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="cari">Search</button>
                </form>
            </div>
        </div>
        
        <div class="logo-container">
            <img src="src/logo.png" alt="Logo" class="logo">
        </div>
        
        
        <div class="jumbotron mt-4">
            <h1 class="display-4">Welcome to SPMS - Spool Pipe Management System</h1>
            <p class="lead">SPMS is a web application to help manage industrial projects. Here are some of its key features:</p>
            <hr class="my-4">
            <ul class="list-unstyled">
                <li class="feature">
                    <h3>Move Spool</h3>
                    <p>Manage spools that have been scanned into the system. Keep track of their movement and assign installation location status.</p>
                </li>
                <li class="feature">
                    <h3>Install Spool</h3>
                    <p>Once a spool is moved, it can be installed in its final location.</p>
                </li>
                <li class="feature">
                    <h3>Spool Control</h3>
                    <p>Keep track of all spools and their status throughout the project.</p>
                </li>
                <li class="feature">
                    <h3>Progress</h3>
                    <p>See the project's progress with a visual representation of spool installations over time.</p>
                </li>
                <li class="feature">
                    <h3>Database</h3>
                    <p>Access a database of all spools, including their specifications.</p>
                </li>
                <li class="feature">
                    <h3>Login</h3>
                    <p>Securely log in to the system using Google authentication or a standard username/password.</p>
                </li>
            </ul>
            <a class="btn btn-primary btn-lg" href="login.php" role="button">Get Started</a>
        </div>
    </div>
    


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>








