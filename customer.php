<?php
include("koneksi.php");
?>

<html>
<head>
  <title>Customer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS file link -->
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="images/aboutus.png" alt="Bootstrap" width="100" height="80">
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
        <th>No</th>
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
          <td><?=$no;?></td>
          <td><?=$data['customer_id'];?></td>
          <td><?=$data['customer_name'];?></td>
          <td><?=$data['customer_address'];?></td>
          <td><?=$data['customer_phone'];?></td>
          <td><?=$data['customer_datereg'];?></td>
          <td>
            <a href="customer_update.php?customer_id=<?= $data['customer_id']; ?>" class="btn btn-primary">Update</a>
            <a href="customer_delete.php?customer_id=<?= $data['customer_id']; ?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
      <?php 
        $no++;
      } ?>
    </tbody>
  </table>
</div>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>