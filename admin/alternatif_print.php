<?php include '../connection.php';

$query   = mysqli_query($connect, "SELECT * FROM alternatif_supplier");
$results = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>
<head>

    <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>

        <h2>Data Supplier</h2></br>
      
        <table class="table table-bordered table-striped">
          <thead>
          <tr>
            <th colspan="1">No.</th>
            <th colspan="1">Nama supplier</th>
            <th colspan="2">Phone</th>
            <th colspan="2">Alamat</th>
          </tr>
          </thead>
          <tbody>
        <?php  $no=0; foreach($results as $results): $no++ ?>
          <tr>
            <td colspan="1"><?php echo $no ?></td>
            <td colspan="1"><?php echo $results['nama_supplier']?></td>
            <td colspan="2"><?php echo $results['phone'] ?></td>
            <td colspan="2"><?php echo $results['alamat'] ?></td>
          </tr>
         <?php endforeach ?>
          </tbody>
          
        </table>
      <script> window.print(); </script>