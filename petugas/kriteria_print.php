<?php include '../connection.php';

$query   = mysqli_query($connect, "SELECT * FROM kriteria");
$results = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>
<head>

    <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>


        <h2>Data Kriteria </h2></br>
      

        <table class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>No.</th>
            <th>Nama kriteria</th>
            <th>Kaidah</th>
            <th>Bobot</th>
            <th>Tipe preferensi</th>
            <th>q</th>
            <th>p</th>  
          </tr>
          </thead>
          <tbody>
        <?php  $no=0; foreach($results as $results): $no++ ?>
          <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $results['nama_kriteria']?></td>
            <td><?php echo $results['kaidah'] ?></td>
            <td><?php echo $results['bobot'] ?></td>
            <td><?php echo $results['tipe_preferensi']?></td>
            <td><?php echo $results['q']?></td>
            <td><?php echo $results['p']?></td>
          </tr>
         <?php endforeach ?>
          </tbody>
          
        </table>
      <script> window.print(); </script>