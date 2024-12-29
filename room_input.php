<?php
include("koneksi.php");
?>

<html>
<head>
    <title>Input Data Room</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        .success {
            background-color: #a3e6be;
            margin-top: 10px;
        }
        
        .error {
            background-color: #e6a3a3;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <?php
                if (isset($_POST['simpan'])) {
                    $room_id = $_POST['room_id'];
                    $room_name = $_POST['room_name'];
                    $room_price = $_POST['room_price'];
                    $room_facility = $_POST['room_facility'];

                    $query_simpan = "INSERT INTO room (room_id, room_name, room_price, room_facility)
                    VALUES ('$room_id', '$room_name', '$room_price', '$room_facility')";
                    
                    $simpan = $conn->query($query_simpan);
                    if ($simpan) {
                        echo "<div class='alert alert-success success'>Data Berhasil Disimpan</div>";
                    } else {
                        echo "<div class='alert alert-danger error'>Data Gagal Disimpan</div>";
                    }
                }
                ?>
                <form action="" method="post">
                    <label>ID Room</label> <br>
                    <input type="text" name="room_id" class="form-control"><br>
                    <label>Nama Room</label> <br>
                    <input type="text" name="room_name" class="form-control"><br>
                    <label>Harga Room</label> <br>
                    <input type="text" name="room_price" class="form-control"><br>
                    <label>Fasilitas Room</label> <br>
                    <textarea class="form-control" name="room_facility"></textarea>
                    <br>
                    <input type="submit" name="simpan" value="Save" class="btn btn-primary">
                    <a href="room.php" class="btn btn-primary">Back</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
