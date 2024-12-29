<?php
include("koneksi.php");

// Menghitung selisih hari
function calculateDays($start, $end) {
    $startDate = new DateTime($start);
    $endDate = new DateTime($end);

    $diff = $endDate->diff($startDate);
    $diffInDays = $diff->days;

    return $diffInDays;
}

// Menampilkan Book Data
function displayBookData($book_id, $customer_id, $room_id, $checkin, $checkout, $jumlah, $total, $book_description)
{
    // Mengambil room_name berdasarkan room_id
    global $conn;
    $query_room = $conn->query("SELECT room_name FROM room WHERE room_id = '$room_id'");
    $data_room = $query_room->fetch_assoc();
    $room_name = $data_room['room_name'];

    echo "<div class='alert alert-success'>Data Berhasil Disimpan</div>";
    echo "<table class='table table-bordered'>
            <tr>
                <th>BOOK ID</th>
                <th>CUSTOMER ID</th>
                <th>ROOM NAME</th>
                <th>CHECK-IN</th>
                <th>CHECK-OUT</th>
                <th>JUMLAH</th>
                <th>TOTAL</th>
                <th>BOOK DESCRIPTION</th>
            </tr>
            <tr>
                <td>" . $book_id . "</td>
                <td>" . $customer_id . "</td>
                <td>" . $room_name . "</td>
                <td>" . $checkin . "</td>
                <td>" . $checkout . "</td>
                <td>" . $jumlah . "</td>
                <td>" . $total . "</td>
                <td>" . $book_description . "</td>
            </tr>
        </table>";
}

// Tambahkan data room ke dalam tabel room
$query_insert_room = "INSERT INTO room (room_id, room_name, room_price, room_description)
                      VALUES 
                      ('R00001', 'Aeron', '1500000', 'Bed king size, shower and bathroom, internet, value valley, Max. Occupancy 3A(Adults)'),
                      ('R00002', 'Azalea', '1750000', 'Bed King Size, Shower And Bathroom, Internet, Value Valley, Max. Occupancy 3A(Adults)'),
                      ('R00003', 'Beach Walk', '1810000', 'Bed King Size, Shower And Bathroom, Internet, Value Valley, Max. Occupancy 3A(Adults)'),
                      ('R00004', 'Breeze', '1500000', 'Bed King Size, Shower And Bathroom, Internet, Value Valley, Max. Occupancy 4A(Adults)')";

$conn->query($query_insert_room);

if (isset($_POST['simpan'])) {
    $customer_id = $_POST['customer_id'];
    $room_id = $_POST['room_id'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $book_description = $_POST['book_description'];

    // Hitung jumlah dan total
    $diffInDays = calculateDays($checkin, $checkout);
    $jumlah = $diffInDays; // variabel $jumlah diisi dengan nilai selisih hari
    $query_room = $conn->query("SELECT room_price FROM room WHERE room_id = '$room_id'");
    $data_room = $query_room->fetch_assoc();
    $room_price = $data_room['room_price'];
    $total = $room_price * $diffInDays;

    // Generate Book ID
    $query_last_book = $conn->query("SELECT book_id FROM book ORDER BY book_id DESC LIMIT 1");
    $last_book = $query_last_book->fetch_assoc();
    $last_book_id = $last_book['book_id'];
    $last_book_number = intval(substr($last_book_id, 1));
    $new_book_number = $last_book_number + 1;
    $new_book_id = 'B' . str_pad($new_book_number, 5, '0', STR_PAD_LEFT);

    // Simpan data book beserta jumlah dan total ke dalam database
    $query_simpan = "INSERT INTO book (book_id, customer_id, room_id, checkin, checkout, jumlah, total, book_description)
                     VALUES ('$new_book_id', '$customer_id', '$room_id', '$checkin', '$checkout', '$jumlah', '$total', '$book_description')";

    $simpan = $conn->query($query_simpan);

    // Menampilkan hasil inputan jika simpan berhasil
    if ($simpan) {
        displayBookData($new_book_id, $customer_id, $room_id, $checkin, $checkout, $jumlah, $total, $book_description);
        echo "<div class='text-center'>"; // Tambahkan div dengan class 'text-center' untuk membuat tombol menjadi ditengahkan
        echo "<a href='index.php' class='btn btn-primary'>Back</a>";
    } else {
        echo "<div class='alert alert-danger'>Data Gagal Disimpan</div>";
    }
}
?>


<!-- Form input data book -->
<html>

<head>
    <title>Input Data Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php
                if (isset($_POST['simpan'])) {
                    // Tidak perlu menampilkan inputan kembali setelah proses simpan
                } else {
                    ?>
                    <form action="" method="post">
                        <?php
                        // Tampilkan nomor book_id saat ini
                        $query_last_book = $conn->query("SELECT book_id FROM book ORDER BY book_id DESC LIMIT 1");
                        $last_book = $query_last_book->fetch_assoc();
                        $last_book_id = $last_book['book_id'];
                        $last_book_number = intval(substr($last_book_id, 1));
                        $new_book_number = $last_book_number + 1;
                        $new_book_id = 'B' . str_pad($new_book_number, 5, '0', STR_PAD_LEFT);
                        ?>
                        <label>Book ID</label><br>
                        <input type="text" name="book_id" class="form-control" value="<?php echo $new_book_id; ?>"
                            readonly><br>
                        <label>Customer ID</label> <br>
                        <input type="text" name="customer_id" class="form-control"><br>
                        <label>Room Name</label> <br>
                        <select name="room_id" class="form-control">
                            <?php
                            $query_rooms = $conn->query("SELECT room_id, room_name FROM room");
                            while ($row = $query_rooms->fetch_assoc()) {
                                echo "<option value='" . $row['room_id'] . "'>" . $row['room_name'] . "</option>";
                            }
                            ?>
                        </select><br>
                        <label>Check-in</label> <br>
                        <input type="datetime-local" name="checkin" class="form-control"><br>
                        <label>Check-out</label> <br>
                        <input type="datetime-local" name="checkout" class="form-control"><br>
                        <label>Book Description</label> <br>
                        <input type="text" name="book_description" class="form-control"><br>
                        <br>
                        <input type="submit" name="simpan" value="Save" class="btn btn-primary">
                        <a href="book.php" class="btn btn-primary">Back</a>
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
