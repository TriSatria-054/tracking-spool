<?php 

$conn = mysqli_connect("localhost", "root", "", "tugaslogintwt9"); //3307

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}

function tambah_spool($data, $imageString){
    global $conn;
    $imageString = $imageString;
    $test_package = htmlspecialchars($data['test_package']);
    $p_id = htmlspecialchars($data['p_id']);
    $subsystem_name = htmlspecialchars($data['subsystem_name']);
    $line_number = htmlspecialchars($data['line_number']);
    $material = htmlspecialchars($data['material']);
    $area = htmlspecialchars($data['area']);
    $contractor = htmlspecialchars($data['contractor']);

    //upload gambar
    // $gambar = upload();
    // if(!$gambar){
    //     return false;
    // }
    

    $query = "INSERT INTO spool (qrcode, test_package, p_id, subsystem_name, line_number, material, area, contractor) VALUES ('$imageString', '$test_package', '$p_id','$subsystem_name', '$line_number', '$material', '$area', '$contractor')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);


    // Assuming 'login_email' is stored in $_SESSION

    // // Insert the article into the database
    // // Make sure to sanitize the input to prevent SQL injection
    // // Your database connection should be established beforehand
    // // Adjust the SQL query based on your table structure
    // $stmt = $pdo->prepare("INSERT INTO article (title, content, user_email) VALUES (?, ?, ?)");
    // $stmt->execute([$title, $content, $email]);

    // // Check for successful insertion
    // if ($stmt->rowCount() > 0) {
    //     echo "Article uploaded successfully.";
    // } else {
    //     echo "Failed to upload the article.";
    // }
      
}

function tambahUser(){
    global $conn;
    $email =  $_SESSION['login_email'];
    $username =  ucwords($_SESSION['login_givenName'] . " " .$_SESSION['login_familyName']);
    $profile_picture =  $_SESSION['login_picture'];
    $query = "INSERT INTO userinfo (user_email, username, profile_picture) VALUES ('$email', '$username', '$profile_picture')";

// cek username sudah ada atau belum 
    $result = mysqli_query($conn, "SELECT user_email FROM userinfo WHERE user_email = '$email'");

    if(mysqli_fetch_assoc($result)){
        return false;
    }

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM spool WHERE id = $id");
    return mysqli_affected_rows($conn);
}


function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFIle = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah tidak ada gambar yang diupload
    if($error === 4){
        echo "<script>
                alert('pilih gambar terlebih dahulu!);
              </script>";
        return false;

    }

    //cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'mp4', 'webm', 'ogg'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
                alert('yang anda upload bukan gambar!);
              </script>";
        return false;
    }

    //cek jika ukurannya terlalu besar
    if($ukuranFIle > 100000000){
        echo "<script>
                alert('ukuran gambar terlalu besar!);
              </script>";
        return false;
    }

    //lolos pengecekan, gambar siap diupload
    // generate nama gambar baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;


}

function ubah($data, $imageString){
    global $conn;

    $id = $data["id"];
    $imageString = $imageString;
    $test_package = htmlspecialchars($data['test_package']);
    $p_id = htmlspecialchars($data['p_id']);
    $subsystem_name = htmlspecialchars($data['subsystem_name']);
    $line_number = htmlspecialchars($data['line_number']);
    $material = htmlspecialchars($data['material']);
    $area = htmlspecialchars($data['area']);
    $contractor = htmlspecialchars($data['contractor']);

    //cek apakah user pilih gambar baru atau tidak
    // if($_FILES['gambar']['error'] === 4){
    //     $gambar = $gambarLama;
    // } else{
    //     $gambar = upload();
    // }

    $query = "UPDATE spool SET
                qrcode = '$imageString',
                test_package = '$test_package',
                p_id = '$p_id',
                subsystem_name = '$subsystem_name',
                line_number = '$line_number',
                material = '$material',
                area = '$area',
                contractor = '$contractor'
            WHERE id = $id
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function cari($keyword){
    // SELECT DISTINCT article.id, article.title, article.content, article.gambar, userinfo.username, userinfo.profile_picture
    //       FROM article
    //       INNER JOIN userinfo ON article.user_email = userinfo.user_email

    //tambahkan ke versi 2
    $query = "SELECT DISTINCT move_spool.id, move_spool.line_number, move_spool.status, move_spool.material, move_spool.area, move_spool.contractor, move_spool.created_at, move_spool.is_installed, userinfo.id AS user_id, userinfo.username, userinfo.profile_picture
          FROM move_spool
          INNER JOIN userinfo ON move_spool.user_id = userinfo.id
          WHERE move_spool.id IN (
              SELECT move_spool.id
              FROM move_spool
              WHERE userinfo.username LIKE '%$keyword%'
                 OR move_spool.line_number LIKE '%$keyword%'
                 OR move_spool.status LIKE '%$keyword%'
                 OR move_spool.created_at LIKE '%$keyword%'
                 OR move_spool.material LIKE '%$keyword%'
                 OR move_spool.area LIKE '%$keyword%'
                 OR move_spool.contractor LIKE '%$keyword%'
                 OR (move_spool.is_installed = 1 AND '$keyword' = 'installed')
          )";

    return query($query);
}

function move_spool($user_id, $line_number, $material, $area, $contractor){
    global $conn;
    $user_id = $user_id;
    $line_number = htmlspecialchars($line_number);
    $material = htmlspecialchars($material);
    $area = htmlspecialchars($area);
    $contractor = htmlspecialchars($contractor);

    //upload gambar
    // $gambar = upload();
    // if(!$gambar){
    //     return false;
    // }
    

    $query = "INSERT INTO move_spool (user_id, line_number, material, area, contractor) VALUES ('$user_id', '$line_number', '$material', '$area', '$contractor')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);


    
      
}

function install_spool($user_id, $line_number, $status,$material, $area, $contractor, $created_at){
    global $conn;
    $user_id = $user_id;
    $line_number = htmlspecialchars($line_number);
    $status = $status;
    $material = htmlspecialchars($material);
    $area = htmlspecialchars($area);
    $contractor = htmlspecialchars($contractor);
    $created_at = $created_at;

    //upload gambar
    // $gambar = upload();
    // if(!$gambar){
    //     return false;
    // }
    

    $query = "INSERT INTO install_spool (user_id, line_number, status, material, area, contractor, created_at) VALUES ('$user_id', '$line_number', '$status','$material', '$area', '$contractor', '$created_at')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);


    
      
}

function registrasi($data){
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $email =  strtolower(stripslashes($data["email"]));
    $password = mysqli_escape_string($conn, $data["password"]);
    $password2 = mysqli_escape_string($conn, $data["password2"]);
    $profile_picture = "https://toppng.com//public/uploads/preview/circled-user-icon-user-pro-icon-11553397069rpnu1bqqup.png";

    // cek username sudah ada atau belum 
    $result = mysqli_query($conn, "SELECT user_email FROM userinfo WHERE user_email = '$email'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('user sudah terdaftar');
                </script>";
        return false;
    }

    //cek konfirmasi password
    if( $password !== $password2){
        echo "<script>
                alert('konfirmasi password tidak sesuai!')
                </script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO userinfo (username, user_email, password, profile_picture) VALUES('$username', '$email', '$password', '$profile_picture')");

    return mysqli_affected_rows($conn);
}





?>