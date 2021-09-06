<?php include '../connection.php';

      session_start();
  if  (@$_SESSION['akses_level'] == "admin"){
      echo "<script> alert('Anda harus login sebagai admin user terlebih dahulu untuk mengakses module');
            window.location = 'login.php';</script>";
      exit;
    }
      include '../layout/header.php';
      include '../layout/nav_petugas.php';

$query   = mysqli_query($connect, "SELECT * FROM kriteria");
$results = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Data Kriteria
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Kriteria</a></li>
        <li class="active">Data kriteria</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">


      
      <div class="box box-primary box-solid">
      
        
        <!-- /.box-header -->
        <div class="box-body">

        <div style="padding-bottom: 10px;">
          <a href="kriteria_laporan.php" class="btn btn-danger btn-sm">
           <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</a>
          <a href="kriteria_print.php" target="_blank" class="btn btn-primary btn-sm">
           <i class="fa fa-print" aria-hidden="true"></i> Print</a>
          
               
          </div>



         

            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                 
                  <th>Nama kriteria</th>
                 <th>Kaidah</th>
                  <th>Bobot</th>
                 
                  <th>Tipe preferensi</th>
                  <th>p</th>
                  <th>q</th>
                  
                  
                </tr>
                </thead>
                <tbody>
          <?php $no=0; foreach ($results as $key => $results): $no++ ?>
                <tr>
                  <td><?php echo $no ?></td>
                 
                  <td><?php echo $results['nama_kriteria'];?></td>
                  <td><?php echo $results['kaidah'];?></td>
                  <td><?php echo $results['bobot'];?></td>
                  <td><?php echo $results['tipe_preferensi'];?></td>
                  <td><?php echo $results['p'];?></td>
                  <td><?php echo $results['q'];?></td>
          
                </tr>
            <?php endforeach ?>

                </tbody>
                
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>


<?php include '../layout/footer.php' ?>