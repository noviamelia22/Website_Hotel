<?php
include("koneksi.php");
?>

<html>
<head>
  <title>Laporan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS file link -->
  <link rel="stylesheet" href="style.css">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="images/aboutus.png"alt="Bootstrap" width="100" height="80">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="book.php">Book</a>
          </li>
        <li class="nav-item">
        <a class="nav-link" href="customer.php">Customer</a>
        </li>
          <li class="nav-item">
            <a class="nav-link" href="room.php">Room</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="laporan.php">Laporan</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br>
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


  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
