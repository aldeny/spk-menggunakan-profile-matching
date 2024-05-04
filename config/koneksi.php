<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "db_ta_spk";

$konek = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$konek) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>