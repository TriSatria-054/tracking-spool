<?php 
session_start();

if((!isset($_SESSION['ucode']) || (isset($_SESSION['ucode']) && empty($_SESSION['ucode']))) && !isset($_SESSION['login'])){
    if(strstr($_SERVER['PHP_SELF'], 'login.php') === false)
    header('location:login.php');
}

require 'functions.php';
$spools = query("SELECT * FROM spool");
$user = query("SELECT * FROM userinfo WHERE user_email = '{$_SESSION['login_email']}'")[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
    <!-- Bootstrap CSS -->
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
                <li class="nav-item"><a class="nav-link" href="move_spool.php">Move Spool</a></li>
                <li class="nav-item"><a class="nav-link" href="install_spool.php">Install Spool</a></li>
                <li class="nav-item"><a class="nav-link" href="spool_control.php">Spool Control</a></li>
                <li class="nav-item"><a class="nav-link" href="progress.php">Progress</a></li>
                <li class="nav-item"><a class="nav-link" href="database_spool.php">Database</a></li>
                <li class="nav-item"><a class="nav-link" href="feed.php">Home</a></li>
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

    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-md-12">
                <form class="form-inline my-2 my-lg-0" action="move_spool.php" method="post">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search..." aria-label="Search" name="keyword" id="keyword">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="cari">Search</button>
                </form>
            </div>
        </div>
        <br>
        <?php if($user['role'] == 'admin'): ?>
        <button class="btn btn-primary mb-3" onclick="window.location.href='tambah_spool.php'">Generate</button>
        <?php endif ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                    	<th>QR Code</th>
                        <th>Test Package</th>
                        <th>P&ID</th>
                        <th>Subsystem Name</th>
                        <th>Line Number</th>
                        <th>Material</th>
                        <th>Area</th>
                        <th>Contractor</th>
                        <?php if($user['role'] == 'admin'): ?>
                        <th>Aksi</th>
                        <?php endif ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($spools as $index => $row): ?>
                        <tr>
                            <td><?= $index+1 ?></td>
                        	<td>
                             
                              <img src="data:image/png;base64,<?= $row['qrcode'] ?>" alt="QR Code">
                            </td>
                            <td><?= $row['test_package'] ?></td>
                            <td><?= $row['p_id'] ?></td>
                            <td><?= $row['subsystem_name'] ?></td>
                            <td>
                                <?php
                                $line_numbers = explode(',', $row['line_number']);
                                
                                foreach ($line_numbers as $line_number) :?>
                                    <div>
                                        <?= $line_number ?>
                                    </div>
                                <?php endforeach ?>
                            </td>
                            <td><?= $row['material'] ?></td>
                            <td><?= $row['area'] ?></td>
                            <td><?= $row['contractor'] ?></td>
                            <?php if($user['role'] == 'admin'): ?>
                            <td>
                                <a class="dropdown-item" href="ubah.php?id=<?= $row["id"]; ?>">
                                    <button type="button" class="btn btn-primary">Edit</button>
                                </a>

                                <a class="dropdown-item" href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </a>

                            </td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
