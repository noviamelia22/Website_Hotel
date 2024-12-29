<?php
include("koneksi.php");

// Mendapatkan nilai maksimum customer_id saat ini
$query_max_id = "SELECT MAX(SUBSTRING(customer_id, 2)) AS max_id FROM customer";
$result_max_id = $conn->query($query_max_id);
$row_max_id = $result_max_id->fetch_assoc();
$max_id = $row_max_id['max_id'];

// Membangkitkan Customer ID baru dengan menambahkan 1 pada nilai maksimum
$new_id = 'C' . str_pad(($max_id + 1), 5, '0', STR_PAD_LEFT);

if (isset($_POST['simpan'])) {
    $customer_name = $_POST['customer_name'];
    $customer_address = $_POST['customer_address'];
    $customer_phone = $_POST['customer_phone'];
    $customer_datereg = $_POST['customer_datereg'];

    // Menyimpan data customer ke database
    $query_simpan = "INSERT INTO customer (customer_id, customer_name, customer_address, customer_phone, customer_datereg)
                    VALUES ('$new_id', '$customer_name', '$customer_address', '$customer_phone', '$customer_datereg')";

    $simpan = $conn->query($query_simpan);

    //if ($simpan) {
        //echo "<div class='alert alert-success success'>Data Berhasil Disimpan</div>";
    //} else {
        //echo "<div class='alert alert-danger error'>Data Gagal Disimpan</div>";
    //}
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
                    $customer_name = $_POST['customer_name'];
                    $customer_address = $_POST['customer_address'];
                    $customer_phone = $_POST['customer_phone'];
                    $customer_datereg = $_POST['customer_datereg'];

                    $query_simpan = "INSERT INTO customer (customer_name, customer_address, customer_phone, customer_datereg)
                    VALUES ('$customer_name', '$customer_address', '$customer_phone', '$customer_datereg')";

                    $simpan = $conn->query($query_simpan);
                    if ($simpan) {
                        echo "<div class='alert alert-success success'>Data Berhasil Disimpan</div>";
                    } else {
                        echo "<div class='alert alert-danger error'>Data Gagal Disimpan</div>";
                    }
                }
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
                        <a href="customer.php" class="btn btn-primary">Back</a>
                    </form>

            </div>
        </div>
    </div>
</body>
</html>