<?php include '../connection.php';

      session_start();
    if  (@$_SESSION['akses_level'] == "petugas"){
      echo "<script> alert('Anda harus login sebagai admin user terlebih dahulu untuk mengakses module');
            window.location = 'login.php';</script>";
      exit;
    }
      include '../layout/header.php';
      include '../layout/nav_admin.php';



?>
<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Data Penilaian
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Penilaian</a></li>
        <li class="active">Data penilaian</li>
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
            <a href="penilaian_add.php" class="btn btn-primary btn-sm">
             <i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>   
            
          </div>

            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama alternatif</th>
                  <th>Nama kriteria</th>
                  <th>Nilai</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php
$querypenilaian = mysqli_query($connect, "SELECT * FROM nilai_seleksi");
$no=0; while ($datapenilaian = mysqli_fetch_array($querypenilaian))
  { 
    
    $queryalternatif = mysqli_query($connect, "SELECT * FROM alternatif_supplier WHERE id_supplier ='$datapenilaian[id_supplier]'");
    $dataalternatif = mysqli_fetch_array($queryalternatif);
    $querykriteria = mysqli_query($connect, "SELECT * FROM kriteria WHERE id_kriteria ='$datapenilaian[id_kriteria]'");
    $datakriteria = mysqli_fetch_array($querykriteria);$no++ ?>


              <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $dataalternatif['nama_supplier']?></td>
                  <td><?php echo $datakriteria['nama_kriteria']?></td>
                  <td><?php echo $datapenilaian['nilai']?></td>
                  <td>
                    <a href="penilaian_edit.php?id_nilai=<?php echo $datapenilaian['id_nilai']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> edit</a>
                    <a href="penilaian_delete.php?id_nilai=<?php echo $datapenilaian['id_nilai']; ?>" class="btn btn-danger btn-sm"
                    onclick="return confirm('yakin ingin menghapus data ini ?')"><i class="fa fa-trash-o"></i> hapus</a>
                  </td>
              </tr>
<?php }?>    

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
