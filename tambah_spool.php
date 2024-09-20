<?php 

session_start();

if((!isset($_SESSION['ucode']) || (isset($_SESSION['ucode']) && empty($_SESSION['ucode']))) && !isset($_SESSION['login'])){
    if(strstr($_SERVER['PHP_SELF'], 'login.php') === false)
    header('location:login.php');
}

require 'functions.php';
// Include the qrlib file 
include 'phpqrcode/qrlib.php';


if(isset($_POST["tambah"])){
    $line_number = $_POST['line_number'];
    $material = $_POST['material'];
    $area = $_POST['area'];
    $contractor = $_POST['contractor'];
    // $text variable has data for QR 
    $text = "http://localhost/phpdasar/jasa_web/tugaslogintwt9/tracking_pipa/move_spool.php?line_number=$line_number&material=$material&area=$area&contractor=$contractor"; 

    // Start output buffering
    ob_start();
    QRCode::png($text, null);
    $imageString = base64_encode( ob_get_contents() );
    ob_end_clean();

    if(tambah_spool($_POST, $imageString) > 0){
        echo "
            <script>
                alert('data berhasil ditambahkan');
                document.location.href = 'database_spool.php';
            </script>



        ";
    } else{
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'database_spool.php';
            </script>


        ";
    }


}


                            
 



 


 ?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Spool</title>
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
                <form class="form-inline my-2 my-lg-0" action="move_spool.php" method="post">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search..." aria-label="Search" name="keyword" id="keyword">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="cari">Search</button>
                </form>
            </div>
        </div>
        <br>
    <div class="row">
        <div class="col-lg-5 col-md-7 col-sm-12 mx-auto">
            <div class="card rounded-0">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- <input type="hidden" name="qrcode" value="<?= $imageString ?>"> -->
                        <div class="mb-3">Add Spool</div>
                        <div class="mb-3">
                            <label for="test_package" class="form-label">Test Package</label>
                            <input type="text" class="form-control" id="test_package" name="test_package" required>
                        </div>
                        <div class="mb-3">
                            <label for="p_id" class="form-label">P&ID</label>
                            <input type="text" class="form-control" id="p_id" name="p_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="subsystem_name" class="form-label">Subsystem Name</label>
                            <input type="text" class="form-control" id="subsystem_name" name="subsystem_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="line_number" class="form-label">Line Number</label>
                            <input type="text" class="form-control" id="line_number" name="line_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="material" class="form-label">Material</label>
                            <input type="text" class="form-control" id="material" name="material" required>
                        </div>
                        <div class="mb-3">
                            <label for="area" class="form-label">Area</label>
                            <input type="text" class="form-control" id="area" name="area" required>
                        </div>
                        <div class="mb-3">
                            <label for="contractor" class="form-label">Contractor</label>
                            <input type="text" class="form-control" id="contractor" name="contractor" required>
                        </div>
                        
                        <!-- <div class="mb-3">
                            <label for="gambar">Image: </label>
                            <input type="file" name="gambar" id="gambar" required>
                        </div> -->
                        <button type="submit" class="btn btn-primary rounded-0" name="tambah">Add Spool</button>
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