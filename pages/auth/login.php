<?php

include '../../config/koneksi.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $query = mysqli_query($konek, $sql);
    $cek = mysqli_num_rows($query);
    
    if ($cek > 0) {
        $data = mysqli_fetch_array($query);
        session_start();
        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = $data['username'];

        header("location: ../dashboard.php");
    } else {
        echo "<script>alert('Username atau Password anda salah!')</script>";
    }

?>