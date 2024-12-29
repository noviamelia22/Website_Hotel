<?php
include("koneksi.php");
?>

<html>
<head>
    <title>Update Data Room</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php
                if(isset($_GET['room_id'])) {
                    $room_id = $_GET['room_id'];
                    $sql = "SELECT * FROM room WHERE room_id='$room_id'";
                    $query_cek = $conn->query($sql);
                    $data_cek = $query_cek->fetch_assoc();

                    if(isset($_POST['simpan'])){
                        $room_id_baru = $_POST['room_id'];
                        $room_name = $_POST['room_name'];
                        $room_price = $_POST['room_price'];
                        $room_facility = $_POST['room_facility'];

                        $sql = "UPDATE room SET room_id='$room_id_baru', room_name='$room_name', room_price='$room_price',
                        room_facility='$room_facility' WHERE room_id='$room_id'";

                        $query =$conn->query($sql);
                        if($query){
                            echo "<div class='alert alert-success success'>Data Berhasil Disimpan</div>";
                        } else {
                            echo "<div class='alert alert-danger error'>Data Gagal Disimpan</div>";
                        }

                    }

                    if($data_cek['room_id'] != NULL) {
                        ?>
                        <form action="" method="post">
                            <label>Room ID</label> <br>
                            <input type="text" name="room_id" class="form-control" value="<?php echo $data_cek['room_id']; ?>"> <br>
                            <label>Room Name</label> <br>
                            <input type="text" name="room_name" class="form-control" value="<?php echo $data_cek['room_name']; ?>"> <br>
                            <label>Room PRICE</label> <br>
                            <input type="text" name="room_price" class="form-control" value="<?php echo $data_cek['room_price']; ?>"> <br>
                            <label>ROOM FACILITY</label> <br>
                            <textarea class="form-control" name="room_facility"><?php echo $data_cek['room_facility']; ?></textarea>
                            <br>
                            <input type="submit" name="simpan" value="Save" class="btn btn-primary">
                            <a href="room.php" class="btn btn-primary">Back</a>
                        </form>
                        <?php
                    } else {
                        echo "Room ID tidak ditemukan";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
