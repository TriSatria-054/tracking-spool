<?php 

require 'functions.php';

$line_number = $_GET['line_number'];
$spool = query("SELECT * FROM spool WHERE line_number = '$line_number'")[0];



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
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
            </ul>
        </div>
    </nav>

<form>
    <table>
        <tr>
            <th>Line Number</th>
        </tr>
        <tr>
            <td><?= $spool['line_number'] ?></td>
        </tr>
    </table>
</form>

    
</body>
</html>








