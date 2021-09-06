<?php include '../connection.php';

$query   = mysqli_query($connect, "SELECT * FROM user");
$results = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>
<head>

    <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>

        <h2>Data User</h2></br>
    
        <table class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>No.</th>
            <th>Nama lengkap</th>
            <th>Username</th>
            <th>Akses level</th>
            <th>Phone</th>
            <th>Email</th>
          </tr>
          </thead>
          <tbody>
        <?php  $no=0; foreach($results as $results): $no++ ?>
          <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $results['nama_lengkap']?></td>
            <td><?php echo $results['username'] ?></td>
            <td><?php echo $results['akses_level'] ?></td>
            <td><?php echo $results['phone']?></td>
            <td><?php echo $results['email']?></td>
          </tr>
         <?php endforeach ?>
          </tbody>
          
        </table>
      <script> window.print(); </script>