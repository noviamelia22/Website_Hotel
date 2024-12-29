<?php
include("koneksi.php");
?>

<html>
<head>
    <title>Update Data Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php
                if (isset($_GET['book_id'])) {
                    $book_id = $_GET['book_id'];
                    $sql = "SELECT * FROM book WHERE book_id='$book_id'";
                    $query_cek = $conn->query($sql);
                    $data_cek = $query_cek->fetch_assoc();

                    if (isset($_POST['simpan'])) {
                        $book_id_baru = $_POST['book_id'];
                        $customer_id = $_POST['customer_id'];
                        $room_id = $_POST['room_id'];
                        $checkin = $_POST['checkin'];
                        $checkout = $_POST['checkout'];
                        $book_description = $_POST['book_description'];

                        $sql = "UPDATE book SET book_id='$book_id_baru', customer_id='$customer_id', room_id='$room_id',
                                checkin='$checkin', checkout='$checkout', book_description='$book_description' WHERE book_id='$book_id'";

                        $query = $conn->query($sql);
                        if ($query) {
                            echo "<div class='alert alert-success'>Data Berhasil Disimpan</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Data Gagal Disimpan</div>";
                        }
                    }

                    if ($data_cek['book_id'] != NULL) {
                        ?>
                        <form action="" method="post">
                            <label>Book ID</label> <br>
                            <input type="text" name="book_id" class="form-control"
                                   value="<?php echo $data_cek['book_id']; ?>"> <br>
                            <label>Customer ID</label> <br>
                            <input type="text" name="customer_id" class="form-control"
                                   value="<?php echo $data_cek['customer_id']; ?>"> <br>
                            <label>Room ID</label> <br>
                            <input type="text" name="room_id" class="form-control"
                                   value="<?php echo $data_cek['room_id']; ?>"> <br>
                            <label>Check-in</label> <br>
                            <input type="datetime-local" name="checkin" class="form-control"
                                   value="<?php echo $data_cek['checkin']; ?>"> <br>
                            <label>Check-out</label> <br>
                            <input type="datetime-local" name="checkout" class="form-control"
                                   value="<?php echo $data_cek['checkout']; ?>"> <br>
                            <label>Book Description</label> <br>
                            <textarea class="form-control"
                                      name="book_description"><?php echo $data_cek['book_description']; ?></textarea>
                            <br>
                            <input type="submit" name="simpan" value="Save" class="btn btn-primary">
                            <a href="book.php" class="btn btn-primary">Back</a>
                        </form>
                        <?php
                    } else {
                        echo "Book ID tidak ditemukan";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
