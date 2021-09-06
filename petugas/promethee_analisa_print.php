<?php include_once '../analisa.php';

?>
<head>

    <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
        <h2>Ranking Supplier</h2></br>
      
    <table id="example1" class="table table-bordered table-striped">
      <thead>
       <tr>
         <th>No.</th>
         <th>Alternatif</th>
         <th>Nilai</th>   
         <th>Ranking</th>
      </tr>
      </thead>
      <tbody>
<?php $no=0;for ($i=0;$i<count($net_flow_rangking);$i++){ $no++ ?>
     <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $alternatif_rangking[$i]; ?></td>
        <td><?php echo $net_flow_rangking[$i]; ?></td>
        <td><?php echo ($i+1);?></td>                            
      </tr>
<?php }?> 
      </tbody>
    </table>
      
      <script> window.print(); </script>