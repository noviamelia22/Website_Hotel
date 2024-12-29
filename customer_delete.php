<html>
<head>
    <title>Delete Customer</title>
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

        if(isset($_GET['customer_id'])) {
            $customer_id = $_GET['customer_id'];
            $query_hapus = "DELETE FROM customer WHERE customer_id='$customer_id'";
            $hapus = $conn->query($query_hapus);

            if($hapus){
                echo "<div class='alert alert-success'>DATA BERHASIL DIHAPUS</div>";
                echo "<button class='btn btn-primary' onclick=\"window.location.href='customer.php'\">KEMBALI</button>";
            }
            else {
                echo "<div class='alert alert-danger'>DATA GAGAL DIHAPUS</div>";
            }
        }
        ?>
    </div>
</body>
</html>
