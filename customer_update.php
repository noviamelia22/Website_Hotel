<?php
include("koneksi.php");
?>

<html>
<head>
    <title>Update Data Customer</title>
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
            <div class="col-md-6">
                <a href="customer.php" class="btn btn-primary">Back</a>
                <?php
                if (isset($_GET['customer_id'])) {
                    $customer_id = $_GET['customer_id'];
                    $sql = "SELECT * FROM customer WHERE customer_id='$customer_id'";
                    $query_cek = $conn->query($sql);
                    $data_cek = $query_cek->fetch_assoc();

                    if (isset($_POST['simpan'])) {
                        $customer_id_baru = $_POST['customer_id'];
                        $customer_name = $_POST['customer_name'];
                        $customer_address = $_POST['customer_address'];
                        $customer_phone = $_POST['customer_phone'];
                        $customer_datereg = $_POST['customer_datereg'];

                        $sql = "UPDATE customer SET customer_id='$customer_id_baru', customer_name='$customer_name', customer_address='$customer_address',
                                customer_phone='$customer_phone', customer_datereg='$customer_datereg' WHERE customer_id='$customer_id'";

                        $query = $conn->query($sql);
                        if ($query) {
                            echo "<div class='alert alert-success'>Data Berhasil Disimpan</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Data Gagal Disimpan</div>";
                        }
                    }

                    if ($data_cek['customer_id'] != NULL) {
                        ?>
                        <form action="" method="post">
                            <label>Customer ID</label> <br>
                            <input type="text" name="customer_id" class="form-control"
                                   value="<?php echo $data_cek['customer_id']; ?>"> <br>
                            <label>Customer Name</label> <br>
                            <input type="text" name="customer_name" class="form-control"
                                   value="<?php echo $data_cek['customer_name']; ?>"> <br>
                            <label>Customer Address</label> <br>
                            <textarea class="form-control"
                                      name="customer_address"><?php echo $data_cek['customer_address']; ?></textarea> <br>
                            <label>Customer Phone</label> <br>
                            <input type="text" name="customer_phone" class="form-control"
                                   value="<?php echo $data_cek['customer_phone']; ?>"> <br>
                            <label>Customer Date Registered</label> <br>
                            <input type="date" name="customer_datereg" class="form-control"
                                   value="<?php echo $data_cek['customer_datereg']; ?>"> <br>
                            <input type="submit" name="simpan" value="SIMPAN DATA" class="btn btn-primary">
                        </form>
                        <?php
                    } else {
                        echo "Customer ID tidak ditemukan";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
