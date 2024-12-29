<?php 
	include("koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Room</title>

        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="css.css">

        <!-- custom js file link  -->
        <script src="js/script.js" defer></script>

        <style>
            body {
                background-color: rgb(187, 66, 66);
            }

            /*Footer Style*/
            .footer .credit{
                text-align: center;
                padding: 1.5rem;
                margin-top: 1.5rem;
                padding-top: 2.5rem;
                font-size: 2rem;
                color: #000;
                border-top: .1rem solid #000;
            }

            .footer .credit span{
                color: white;
            }


        </style>
        <style>
            /* CSS for table */

            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
                border-collapse: collapse;
                table-layout: fixed;
            }
            .table-container {
              width: 80%;
              overflow-x: auto;
            }

            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
            }

            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
            }

            .table tbody+tbody {
                border-top: 2px solid #dee2e6;
            }

            .table-sm th,
            .table-sm td {
                padding: 0.3rem;
            }

            .table-bordered {
                border: 1px solid #dee2e6;
            }

            .table-bordered th,
            .table-bordered td {
                border: 1px solid #dee2e6;
            }

            .table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(0, 0, 0, 0.05);
            }

            .table-hover tbody tr:hover {
                background-color: rgba(0, 0, 0, 0.075);
            }

        </style>

        <style>
            table th,
            table td {
                font-size: 13px; /* Ukuran font diperbesar */
            }


        </style>




    </head>

    <body>
        
            <!-- header section starts  -->

            <div id="menu-btn" class="fas fa-bars"></div>

            <header class="header">

                <a href="#" class="logo"> <i class="fas fa-hotel"></i> The Royal Hotel</a>

                <nav class="navbar">
                    <a href="index.php"> <i class="fas fa-angle-right"></i> home </a>
                    <a href="#about"> <i class="fas fa-angle-right"></i> book </a>
                    <a href="#courses"> <i class="fas fa-angle-right"></i> customer</a>
                    <a href="#pricing"> <i class="fas fa-angle-right"></i> room </a>
                    <a href="#contact"> <i class="fas fa-angle-right"></i> laporan </a>
                </nav>

                <div class="share">
                    <span style="color: white; font-size: 20px;"><a href="lap.php" class="fas fa-user"></a> <br> Login</span>
                </div>

            </header>

            <!-- header section ends -->

            <!-- home section starts  -->

            <section class="home" id="home">

                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <form action="" method="get">
                                    <div class="input-group">
                                        <input type="text" name="room" class="form-control" placeholder="Search Room">
                                        <div class="input-group-append">
                                            <input type="submit" name="search" value="Search" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                            </div>
                                <div class="col-4">
                                    <a href="room_input.php" class="btn btn-primary">Input Data ROOM</a>
                                </div>
                        </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>ROOM ID</th>
                            <th>ROOM NAME</th>
                            <th>ROOM PRICE</th>
                            <th>ROOM FACILITY</th>
                            <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $syarat = "";
                            if (isset($_GET['room']) && $_GET['room'] != "semua"){
                            $syarat = " WHERE room_id = '$_GET[room]'";
                            }
                            
                            $no = 1;
                            $query = $conn->query("SELECT * FROM room $syarat  ORDER BY room_name ASC");
                            while ($data = $query->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?=$data['room_id'];?></td>
                                <td><?=$data['room_name'];?></td>
                                <td><?=$data['room_price'];?></td>
                                <td><?=$data['room_facility'];?></td>
                                <td>
                                <a href="room_update.php?room_id=<?= $data['room_id']; ?>" class="btn btn-primary">Edit</a>
                                <a href="room_delete.php?room_id=<?= $data['room_id']; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php 
                            $no++;
                            } ?>
                        </tbody>
                    </table>
            </div>

            </section>

            <!-- home section ends -->


            <!-- about section starts  -->

            <section class="about" id="about">
                    <div class="container">
                    <div class="row">
                    <div class="col-4">
                        <form action="" method="get">
                        <div class="input-group">
                            <input type="text" name="book" class="form-control" placeholder="Search Book">
                            <div class="input-group-append">
                            <input type="submit" name="search" value="Search" class="btn btn-primary">
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="col-4">
                        <a href="book_input.php" class="btn btn-primary">Input Data BOOK</a>
                    </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>BOOK ID</th>
                                <th>CUSTOMER ID</th>
                                <th>ROOM ID</th>
                                <th>CHECKIN</th>
                                <th>CHECKOUT</th>
                                <th>TOTAL</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $syarat = "";
                                if (isset($_GET['book']) && $_GET['book'] != "semua"){
                                    $syarat = " WHERE book_id = '$_GET[book]'";
                                }

                                $no = 1;
                                $query = $conn->query("SELECT * FROM book $syarat  ORDER BY book_id ASC");
                                while ($data = $query->fetch_assoc()){
                            ?>

                            <tr>
                                <td><?=$data['book_id'];?></td>
                                    <td><?=$data['customer_id'];?></td>
                                    <td><?=$data['room_id'];?></td>
                                    <td><?=$data['checkin'];?></td>
                                    <td><?=$data['checkout'];?></td>
                                    <td><?=$data['total'];?></td>
                                </td>

                                <td>
                                    <a href="book_update.php?book_id=<?= $data['book_id']; ?>" class="btn btn-primary">Edit</a>
                                    <a href="book_delete.php?book_id=<?= $data['book_id']; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>

                            <?php 
                                $no++;
                                } ?>
                        </tbody>
                    </table>
            </section>

            <!-- about section ends -->

            <!-- facility section starts  -->

            <section class="courses" id="courses">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <form action="" method="get">
                                    <div class="input-group">
                                        <input type="text" name="customer" class="form-control" placeholder="Search Customer">
                                        <div class="input-group-append">
                                        <input type="submit" name="search" value="Search" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-4">
                                <a href="customer_input.php" class="btn btn-primary">Input Data Customer</a>
                            </div>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Name Customer</th>
                                    <th>Customer Address</th>
                                    <th>Customer Phone</th>
                                    <th>Customer Data Registration</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $syarat = "";
                                if (isset($_GET['customer'])){
                                    $search = $_GET['customer'];
                                    $syarat = " WHERE customer_name LIKE '%$search%'";
                                }

                                $no = 1;
                                $query = $conn->query("SELECT * FROM customer $syarat ORDER BY customer_name ASC");
                                while ($data = $query->fetch_assoc()){
                                ?>
                                <tr>
                                    <td><?=$data['customer_id'];?></td>
                                    <td><?=$data['customer_name'];?></td>
                                    <td><?=$data['customer_address'];?></td>
                                    <td><?=$data['customer_phone'];?></td>
                                    <td><?=$data['customer_datereg'];?></td>
                                    <td>
                                        <a href="customer_update.php?customer_id=<?= $data['customer_id']; ?>" class="btn btn-primary">Edit</a>
                                        <a href="customer_delete.php?customer_id=<?= $data['customer_id']; ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php 
                                    $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
            </section>

            <!-- courses section ends -->

            <!-- room section starts  -->

            <section class="pricing" id="pricing">

                <div class="container">
                    <div class="row">
                        <div class="col-4">
                            <form action="" method="get">
                                <div class="input-group">
                                    <select name="bulan" class="form-control"> <!-- select dropdown -->
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>

                                    <select name="tahun" class="form-control">
                                        <?php
                                        $currentYear = date("Y");// menggunakan fungsi date
                                        for ($i = $currentYear; $i >= 2000; $i--) {// dimulai dari tahun saat ini ($currentYear) dan berlangsung hingga tahun 2000.
                                            echo "<option value='$i'>$i</option>";
                                        }
                                        ?>
                                    </select>

                                    <div class="input-group-append">
                                        <input type="submit" name="filter" value="Filter" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                <section class="laporan" id="laporan">
                    <center><h2>DATA LAPORAN</h2><center>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>BOOK ID</th>
                                <th>CUSTOMER NAME</th>
                                <th>ROOM NAME</th>
                                <th>ROOM PRICE</th>
                                <th>CHECKIN</th>
                                <th>CHECKOUT</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_GET['filter'])) {
                                $bulan = $_GET['bulan'];
                                $tahun = $_GET['tahun'];

                                $query = $conn->query("SELECT b.book_id, c.customer_name, r.room_name, r.room_price, b.checkin, b.checkout
                                FROM book b
                                INNER JOIN customer c ON b.customer_id = c.customer_id
                                INNER JOIN room r ON b.room_id = r.room_id
                                WHERE MONTH(b.checkin) = '$bulan' AND YEAR(b.checkin) = '$tahun' OR MONTH(b.checkout) = '$bulan' AND YEAR(b.checkout) = '$tahun'
                                ORDER BY b.book_id ASC");
                            } else {
                                $query = $conn->query("SELECT b.book_id, c.customer_name, r.room_name, r.room_price, b.checkin, b.checkout
                                FROM book b
                                INNER JOIN customer c ON b.customer_id = c.customer_id
                                INNER JOIN room r ON b.room_id = r.room_id
                                ORDER BY b.book_id ASC");
                            }

                            while ($data = $query->fetch_assoc()) {
                            ?>

                        
                            <tr>
                                <td><?=$no;?></td>
                                <td><?= $data['book_id']; ?></td>
                                <td><?= $data['customer_name']; ?></td>
                                <td><?= $data['room_name']; ?></td>
                                <td><?= $data['room_price']; ?></td>
                                <td><?= $data['checkin']; ?></td>
                                <td><?= $data['checkout']; ?></td>
                            </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </section>

            </section>

            <!-- pricing section ends -->

            <!-- footer section start -->

                <section class="footer">
                        <div class="credit">created by<span> Novi Amelia Kristanti</span>| all right reserved</div>
                </section>
            <!-- footer section ends -->
    </body>
</html>