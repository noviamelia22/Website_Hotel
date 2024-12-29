<html>
<head>
    <title>Delete BOOK</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        include("koneksi.php");

        if(isset($_GET['room_id'])) {
            $room_id = $_GET['room_id'];
            $query_hapus = "DELETE FROM room WHERE room_id='$room_id'";
            $hapus = $conn->query($query_hapus);

            if($hapus){
                echo "<div class='alert alert-success'>DATA BERHASIL DIHAPUS</div>";
                echo "<button class='btn btn-primary' onclick=\"window.location.href='room.php'\">KEMBALI</button>";
            }
            else {
                echo "<div class='alert alert-danger'>DATA GAGAL DIHAPUS</div>";
            }
        }
        ?>
    </div>
</body>
</html>
