<?php 
session_start();

require 'functions.php';

tambahUser();

if((!isset($_SESSION['ucode']) || (isset($_SESSION['ucode']) && empty($_SESSION['ucode']))) && !isset($_SESSION['login'])){
    if(strstr($_SERVER['PHP_SELF'], 'login.php') === false)
    header('location:login.php');
}

if(isset($_GET['logout'])){
    session_destroy();
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
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

        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            width: 100%;
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
                <!-- <li class="nav-item">
                    <a class="nav-link" href="feed.php?logout">Logout</a>
                </li> -->
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?= $_SESSION['login_picture'] ?>" alt="Profile Picture" class="rounded-circle" width="30" height="30">
                        <?= $_SESSION['login_givenName'] . " " . $_SESSION['login_familyName'] ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="feed.php?logout">Logout</a>
                    </div>
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
        <div class="image-container">
            <img src="src/feed_img.jpg" class="img-fluid" alt="Responsive image">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
