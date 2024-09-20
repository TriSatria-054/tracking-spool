<?php 

session_start();

// if(!isset($_SESSION['ucode']) || (isset($_SESSION['ucode']) && empty($_SESSION['ucode']))){
//     if(strstr($_SERVER['PHP_SELF'], 'login.php') === false)
//     header('location:login.php');
// }

require 'functions.php';
// Include the qrlib file 
include 'phpqrcode/qrlib.php';

//ambil data di url
$id = $_GET['id'];

//query data spool berdasarkan id
$spool = query("SELECT * FROM spool WHERE id = $id")[0];


//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST['submit'])){
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

	//cek apakah data berhasil diubah atau tidak
	if(ubah($_POST, $imageString) > 0){
		echo "
			<script>
				alert('data berhasil diubah');
				document.location.href = 'database_spool.php';
			</script>



		";
	} else{
		echo "
			<script>
				alert('data gagal diubah!');
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
	<title></title>
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

	<div class="container my-5">
    <div class="row">
        <div class="col-lg-5 col-md-7 col-sm-12 mx-auto">
            <div class="card rounded-0">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                    	<input type="hidden" name="id" value="<?= $spool["id"]; ?>">
                        <!-- <input type="hidden" name="qrcode" value="<?= $imageString ?>"> -->
                        <div class="mb-3">Add Spool</div>
                        <div class="mb-3">
                            <label for="test_package" class="form-label">test_package</label>
                            <input type="text" class="form-control" id="test_package" name="test_package" required value="<?= $spool["test_package"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="p_id" class="form-label">p&id</label>
                            <input type="text" class="form-control" id="p_id" name="p_id" required value="<?= $spool["p_id"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="subsystem_name" class="form-label">subsystem_name</label>
                            <input type="text" class="form-control" id="subsystem_name" name="subsystem_name" required value="<?= $spool["subsystem_name"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="line_number" class="form-label">line_number</label>
                            <input type="text" class="form-control" id="line_number" name="line_number" required value="<?= $spool["line_number"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="material" class="form-label">material</label>
                            <input type="text" class="form-control" id="material" name="material" required value="<?= $spool["material"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="area" class="form-label">area</label>
                            <input type="text" class="form-control" id="area" name="area" required value="<?= $spool["area"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="contractor" class="form-label">contractor</label>
                            <input type="text" class="form-control" id="contractor" name="contractor" required value="<?= $spool["contractor"]; ?>">
                        </div>
                        
                        <!-- <div class="mb-3">
                            <label for="gambar">Image: </label>
                            <input type="file" name="gambar" id="gambar" required>
                        </div> -->
                        <button type="submit" class="btn btn-primary rounded-0" name="submit">Ubah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>