<?php
$servername = "localhost";
$username = "root";
$password ="";
$dbname = "hotel";
$conn = new mysqli ($servername,$username,$password,$dbname);

//atau
//$conn = new mysqli("localhost","root","","pmudinusdb");

//if($conn->connect_error){
    //echo "koneksi gagal";
//}
//else{
//    echo "koneksi berhasil";
//}

?>