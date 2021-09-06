<?php include '../connection.php';

    session_start();
    if  (@$_SESSION['akses_level'] == "admin"){
      echo "<script> alert('Anda harus login sebagai admin user terlebih dahulu untuk mengakses module');
            window.location = 'login.php';</script>";
      exit;
    }
      include '../layout/header.php';
      include '../layout/nav_petugas.php';

$query   = mysqli_query($connect, "SELECT * FROM alternatif_supplier");
$results = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<section class="content-header">
      <h1>
        Data Supplier
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Alternatif supplier</a></li>
        <li class="active">Data supplier</li>
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
            <a href="alternatif_add.php" class="btn btn-primary btn-sm">
             <i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>   
            <a href="alternatif_laporan.php" class="btn btn-danger btn-sm">
             <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</a>    
            <a href="alternatif_print.php" target="_blank" class="btn btn-success btn-sm">
             <i class="fa fa-print" aria-hidden="true"></i> Print</a>
          </div>

            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama supplier</th>
                  <th>Alamat</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Action</th>
                  
        
                </tr>
                </thead>
                <tbody>
              <?php  $no=0; foreach($results as $results): $no++ ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $results['nama_supplier']?></td>
                  <td><?php echo $results['alamat'] ?></td>
                  <td><?php echo $results['phone'] ?></td>
                  <td><?php echo $results['email']?></td>
     
                  <td>
                    <a href="alternatif_edit.php?id_supplier=<?php echo $results['id_supplier'];?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> edit</a>
                    <a href="alternatif_delete.php?id_supplier=<?php echo $results['id_supplier'];?>" class="btn btn-danger btn-sm"
                    onclick="return confirm('yakin ingin menghapus data ini ?')"><i class="fa fa-trash-o"></i> hapus</a>
                  </td>
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
