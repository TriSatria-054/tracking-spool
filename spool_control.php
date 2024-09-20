<?php  
session_start();

if((!isset($_SESSION['ucode']) || (isset($_SESSION['ucode']) && empty($_SESSION['ucode']))) && !isset($_SESSION['login'])){
    if(strstr($_SERVER['PHP_SELF'], 'login.php') === false)
    header('location:login.php');
}

require 'functions.php';

$move_spool = query("SELECT DISTINCT move_spool.id, move_spool.line_number, move_spool.status, move_spool.material, move_spool.area, move_spool.contractor, move_spool.created_at, move_spool.is_installed, userinfo.id AS user_id, userinfo.username, userinfo.profile_picture
          FROM move_spool
          INNER JOIN userinfo ON move_spool.user_id = userinfo.id");

$install_spool = query("SELECT DISTINCT install_spool.id, install_spool.line_number, install_spool.status, install_spool.material, install_spool.area, install_spool.contractor, install_spool.created_at, userinfo.id AS user_id, userinfo.username, userinfo.profile_picture
          FROM install_spool
          INNER JOIN userinfo ON install_spool.user_id = userinfo.id");
$user_id = query("SELECT * FROM userinfo WHERE user_email = '{$_SESSION['login_email']}'")[0]['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spool Control</title>
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
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        
                        <th>No.</th>
                        <th>Line Number</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>PIC Name</th>
                        <th>Material</th>
                        <th>Area</th>
                        <th>Contractor</th>
                        <th>Install</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($move_spool as $index => $row): ?>
                        <tr>
                            
                            <td><?= $index+1 ?></td>
                            <td>
                                <?php
                                $line_numbers = explode(',', $row['line_number']);
                                
                                foreach ($line_numbers as $line_number) :?>
                                    <div>
                                        <?= $line_number ?>
                                    </div>
                                <?php endforeach ?>
                            </td>
                            <?php if(empty($row['status'])): ?>
                                <td>
                                <a href="add_status.php?id=<?= $row['id'] ?>&from=spool_control">
                                <button type="button" class="btn btn-primary" name="add_status">Add Status</button>
                                </a>
                                </td>
                                

                            <?php else: ?>
                                <td><?= $row['status'] ?></td>
                            <?php endif ?>
                            
                            <td><?= $row['created_at'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['material'] ?></td>
                            <td><?= $row['area'] ?></td>
                            <td><?= $row['contractor'] ?></td>
                            <?php if($row['is_installed']): ?>
                                <td>installed</td>
                            <?php else: ?>
                                <td>
                                    <a href="install.php?id=<?= $row['id'] ?>&user_id=<?= $user_id ?>&line_number=<?= $row['line_number'] ?>&material=<?= $row['material'] ?>&area=<?= $row['area'] ?>&contractor=<?= $row['contractor'] ?>&created_at=<?= $row['created_at'] ?>&from=spool_control">
                                        <button type="button" class="btn btn-primary" name="install">Install</button>
                                    </a>
                                </td>
                            <?php endif ?>
                            
                        </tr>
                    <?php endforeach ?>
                    <?php foreach($install_spool as $index => $row): ?>
                        <tr>
                            
                            <td><?= $index+1 ?></td>
                            <td>
                                <?php
                                $line_numbers = explode(',', $row['line_number']);
                                
                                foreach ($line_numbers as $line_number) :?>
                                    <div>
                                        <?= $line_number ?>
                                    </div>
                                <?php endforeach ?>
                            </td>
                            <?php if($row['status']): ?>
                                <td>
                                Installed
                                </td>
                                

                            <?php else: ?>
                                Not Installed
                            <?php endif ?>
                            
                            <td><?= $row['created_at'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['material'] ?></td>
                            <td><?= $row['area'] ?></td>
                            <td><?= $row['contractor'] ?></td>
                            
                            
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
