<?php 
session_start();

if((!isset($_SESSION['ucode']) || (isset($_SESSION['ucode']) && empty($_SESSION['ucode']))) && !isset($_SESSION['login'])){
    if(strstr($_SERVER['PHP_SELF'], 'login.php') === false)
    header('location:login.php');
}

require 'functions.php';

// Updated SQL query to fetch total spools from both install_spool and move_spool tables
$query = "
    SELECT DATE(created_at) as date, 
           SUM(total_spools) as total_spools,
           SUM(installed_spools) as installed_spools,
           SUM(moved_spools) as moved_spools
    FROM (
        SELECT DATE(created_at) as created_at, COUNT(*) as total_spools, COUNT(*) as installed_spools, 0 as moved_spools
        FROM install_spool
        GROUP BY DATE(created_at)
        UNION ALL
        SELECT DATE(created_at) as created_at, COUNT(*) as total_spools, 0 as installed_spools, COUNT(*) as moved_spools
        FROM move_spool
        GROUP BY DATE(created_at)
    ) as combined
    GROUP BY DATE(created_at)
    ORDER BY DATE(created_at) ASC
";
$result = mysqli_query($conn, $query);

$total_spools = [];
$installed_spools = [];
$moved_spools = [];
$dates = [];

while ($row = mysqli_fetch_assoc($result)) {
    $total_spools[] = (int)$row['total_spools'];
    $installed_spools[] = (int)$row['installed_spools'];
    $moved_spools[] = (int)$row['moved_spools'];
    $dates[] = date('d-m-y', strtotime($row['date']));
}

$total_sum_spools = array_sum($total_spools);
$total_installed_spools = array_sum($installed_spools);
$total_moved_spools = array_sum($moved_spools);

$installed_percentage = $total_sum_spools ? ($total_installed_spools / $total_sum_spools) * 100 : 0;
$moved_percentage = $total_sum_spools ? ($total_moved_spools / $total_sum_spools) * 100 : 0;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Progress</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    </div>

    <div class="container my-5">
        <canvas id="sCurveChart" width="400" height="200"></canvas>
        <p class="mt-3">Installed Spools = <?= number_format($installed_percentage, 2) ?>%</p>
        <p>Moved Spools = <?= number_format($moved_percentage, 2) ?>%</p>
    </div>

    <script>
        var ctx = document.getElementById('sCurveChart').getContext('2d');
        var installedSpools = <?php echo json_encode($installed_spools); ?>;
        var movedSpools = <?php echo json_encode($moved_spools); ?>;
        var dates = <?php echo json_encode($dates); ?>;
        
        var sCurveChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Installed Spools',
                    data: installedSpools,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0)',
                    fill: false,
                    tension: 0.1
                },
                {
                    label: 'Moved Spools',
                    data: movedSpools,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0)',
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Dates'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Spools'
                        },
                        min: 0,
                        max: Math.max(...installedSpools, ...movedSpools) + 50 // Adding a buffer for better visualization
                    }
                }
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
