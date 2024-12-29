<?php
include("koneksi.php");

// Mendapatkan nilai maksimum customer_id saat ini
$query_max_id = "SELECT MAX(SUBSTRING(customer_id, 2)) AS max_id FROM customer"; //mengambil nilai maksimum dari kolom customer_id pada tabel customer di basis data.
$result_max_id = $conn->query($query_max_id);// untuk menjalankan SQL $query_max_id menggunakan objek koneksi database $conn 
$row_max_id = $result_max_id->fetch_assoc(); // mengambil hasil query
$max_id = $row_max_id['max_id']; // mengambil nilai maksimum customer id ke row max_id

// membentuk customer baru
$new_id = 'C' . str_pad(($max_id + 1), 5, '0', STR_PAD_LEFT);// menambahkan 1 pada nilai maksimum sebelumnya
                                                            // str menambahkan angka 0 didepan nilai customer id panjang 5 karakter

if (isset($_POST['simpan'])) {
    $customer_name = $_POST['customer_name'];
    $customer_address = $_POST['customer_address'];
    $customer_phone = $_POST['customer_phone'];
    $customer_datereg = $_POST['customer_datereg'];

    // Menyimpan data customer ke database
    $query_simpan = "INSERT INTO customer (customer_id, customer_name, customer_address, customer_phone, customer_datereg)
                    VALUES ('$new_id', '$customer_name', '$customer_address', '$customer_phone', '$customer_datereg')";

    $simpan = $conn->query($query_simpan);// menjalankan simpan

    //menampilkan pesan berhasil atau gagal
    if ($simpan) {
        echo "<div class='alert alert-success success'>Data Berhasil Disimpan</div>";
        echo "<table class='table table-bordered'>
                <tr>
                    <th>CUSTOMER ID</th>
                    <th>CUSTOMER NAME</th>
                    <th>CUSTOMER ADDRESS</th>
                    <th>CUSTOMER PHONE</th>
                    <th>DATE REGISTRATION</th>
                </tr>
                <tr>
                    <td>" . $new_id . "</td>
                    <td>" . $customer_name . "</td>
                    <td>" . $customer_address . "</td>
                    <td>" . $customer_phone . "</td>
                    <td>" . $customer_datereg . "</td>
                </tr>
            </table>";
            echo "<div class='text-center'>";
            echo "<a href='lap.php' class='btn btn-primary me-2'>Back</a>"; // Menambahkan class 'me-2' untuk memberikan jarak sebesar 2 unit (default Bootstrap spacing) antara tombol
            echo "<a href='bo.php' class='btn btn-primary'>Next</a>";
            echo "</div>";
            ;
    } else {
        echo "<div class='alert alert-danger error'>Data Gagal Disimpan</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Data Customer</title>
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
                    // Tidak perlu menampilkan inputan kembali setelah proses simpan
                } else {
                ?>
                <form action="" method="post">
                    <label>CUSTOMER ID</label><br>
                    <input type="text" name="customer_id" class="form-control" value="<?php echo $new_id; ?>" readonly><br>
                    <label>CUSTOMER NAME</label><br>
                    <input type="text" name="customer_name" class="form-control"><br>
                    <label>CUSTOMER ADDRESS</label><br>
                    <input type="text" name="customer_address" class="form-control"><br>
                    <label>CUSTOMER PHONE</label><br>
                    <input type="text" name="customer_phone" class="form-control"><br>
                    <label>DATE REGISTRATION</label><br>
                    <input type="datetime-local" name="customer_datereg" class="form-control"><br>
                    <br>

                    <input type="submit" name="simpan" value="Save" class="btn btn-primary">
                    <a href="index.php" class="btn btn-primary">Back</a>
                </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
