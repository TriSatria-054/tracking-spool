<?php 
session_start();

if((!isset($_SESSION['ucode']) || (isset($_SESSION['ucode']) && empty($_SESSION['ucode']))) && !isset($_SESSION['login'])){
    if(strstr($_SERVER['PHP_SELF'], 'login.php') === false)
    header('location:login.php');
}

require 'functions.php';

$id = $_GET['id'];
$from = $_GET['from'];

$move_spool = query("SELECT * FROM move_spool WHERE id = '$id'");


if(isset($_POST["tambah"])){
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE move_spool SET status = '$status' WHERE id = '$id'");
    echo "
            <script>
                alert('data berhasil ditambahkan');
                document.location.href = '". ($from == 'spool_control' ? 'spool_control.php' : 'move_spool.php') ."';
            </script>



        ";
}

 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Status</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                    <a class="nav-link" href="feed.php">Home</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="feed.php?logout">Logout</a>
                </li> -->
            </ul>
            <ul class="navbar-nav ml-auto">
                
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?= $_SESSION['login_picture'] ?>" alt="Profile Picture" class="rounded-circle" width="30" height="30">
                            <?= $_SESSION['login_givenName'] . $_SESSION['login_familyName'] ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="feed.php?logout">Logout</a>
                        </div>
                    </li>
                
            </ul>
        </div>
    </nav>



<div class="container my-5">
    
    <div class="row">
        <div class="col-lg-5 col-md-7 col-sm-12 mx-auto">
            <div class="card rounded-0">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- <input type="hidden" name="qrcode" value="<?= $imageString ?>"> -->
                        <div class="mb-3">Add Status</div>
                        <div class="mb-3">
                            <label for="status" class="form-label">status</label>
                            <input type="text" class="form-control" id="status" name="status" required>
                        </div>
                        
                        
                        <!-- <div class="mb-3">
                            <label for="gambar">Image: </label>
                            <input type="file" name="gambar" id="gambar" required>
                        </div> -->
                        <button type="submit" class="btn btn-primary rounded-0" name="tambah">Add Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>