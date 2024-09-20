<?php 
session_start();

if((!isset($_SESSION['ucode']) || (isset($_SESSION['ucode']) && empty($_SESSION['ucode']))) && !isset($_SESSION['login'])){
    if(strstr($_SERVER['PHP_SELF'], 'login.php') === false)
    header('location:login.php');
}

require 'functions.php';

$id = $_GET['id'];
$user_id=$_GET['user_id'];
$line_number = $_GET['line_number'];
$material = $_GET['material'];
$area = $_GET['area'];
$contractor = $_GET['contractor'];

$created_at = date('Y-m-d H:i:s', strtotime(urldecode($_GET['created_at'])));
$from = $_GET['from'];

$is_installed = true;



if(isset($_GET['id'])){
    mysqli_query($conn, "UPDATE move_spool SET is_installed = '$is_installed' WHERE id = '$id'");

    if(install_spool($user_id, $line_number, $is_installed, $material, $area, $contractor, $created_at) > 0){
        echo "
            <script>
                alert('data berhasil ditambahkan');
                document.location.href = '". ($from == 'spool_control' ? 'spool_control.php' : 'move_spool.php') ."';
            </script>



        ";
    } else{
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = '". ($from == 'spool_control' ? 'spool_control.php' : 'move_spool.php') ."';
            </script>


        ";
    }
}

 ?>
