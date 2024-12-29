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

        if(isset($_GET['book_id'])) {
            $book_id = $_GET['book_id'];
            $query_hapus = "DELETE FROM book WHERE book_id='$book_id'";
            $hapus = $conn->query($query_hapus);

            if($hapus){
                echo "<div class='alert alert-success'>DATA BERHASIL DIHAPUS</div>";
                echo "<button class='btn btn-primary' onclick=\"window.location.href='book.php'\">KEMBALI</button>";
            }
            else {
                echo "<div class='alert alert-danger'>DATA GAGAL DIHAPUS</div>";
            }
        }
        ?>
    </div>
</body>
</html>
