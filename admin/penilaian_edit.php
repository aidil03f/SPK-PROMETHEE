<?php include '../connection.php';

      session_start();
    if  (@$_SESSION['akses_level'] == "petugas"){
      echo "<script> alert('Anda harus login sebagai admin user terlebih dahulu untuk mengakses module');
            window.location = 'login.php';</script>";
      exit;
    }
      include '../layout/header.php';
      include '../layout/nav_admin.php';
  if (isset($_POST['button'])){
    
    Mysqli_query($connect, "UPDATE nilai_seleksi SET id_kriteria='$_POST[id_kriteria]',id_supplier='$_POST[id_supplier]',nilai='$_POST[nilai]' WHERE id_nilai='$_GET[id_nilai]'");
  
    echo "<script> alert('Data Penilaian Berhasil Diubah'); window.location = 'penilaian.php';</script>";        
    
  }

?>
<!-- echo "<script> alert('Data Penilaian Berhasil Masuk'); window.location = 'penilaian.php';</script>"; -->
<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Edit Penilaian
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">penilaian</a></li>
        <li class="active">Edit Data penilaian</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-7">
      
      <div class="box box-primary box-solid">
        
        <!-- /.box-header -->
        <div class="box-body">

     <?php
     include '../connection.php';

      $queryalternatifkriteria = mysqli_query($connect,"SELECT * FROM nilai_seleksi WHERE id_nilai='$_GET[id_nilai]'");
      $dataalternatifkriteria = mysqli_fetch_array($queryalternatifkriteria); ?>
       <form class="form-horizontal" method="post">

           <div class="form-group">
              <label class="col-sm-2 control-label">Nama supplier</label>
              <div class="col-sm-8">
          
                <select name="id_supplier" class="form-control">

                  <?php
          $queryalternatif = mysqli_query($connect,"SELECT * FROM alternatif_supplier ORDER BY id_supplier");
          while ($dataalternatif = mysqli_fetch_array($queryalternatif))
          {
        ?>
              <option value="<?php echo $dataalternatif['id_supplier']; ?>" <?php if ($dataalternatifkriteria['id_supplier'] == $dataalternatif['id_supplier']) { echo " selected"; } ?>><?php echo $dataalternatif['nama_supplier']; ?></option>
              <?php
          }
        ?>

                </select>
   
            
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Nama kriteria</label>
              <div class="col-sm-8">
                <select name="id_kriteria" class="form-control">

                <?php
          $querykriteria = mysqli_query($connect,"SELECT * FROM kriteria ORDER BY id_kriteria");
          while ($datakriteria = mysqli_fetch_array($querykriteria))
          {
        ?>
                <option value="<?php echo $datakriteria['id_kriteria']; ?>" <?php if ($dataalternatifkriteria['id_kriteria'] == $datakriteria['id_kriteria']) { echo " selected"; } ?>><?php echo $datakriteria['nama_kriteria']; ?></option>
                <?php
          }
        ?>

           
                </select>
   
            
              </div>
            </div>

            

           <div class="form-group">
              <label class="col-sm-2 control-label">Nilai</label>
              <div class="col-sm-8">
            <input type="text" name="nilai" class="form-control" value="<?php echo $dataalternatifkriteria['nilai']; ?>" required>
              </div>
           </div>    

            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-8">
                <button class="btn btn-primary" type="submit" name="button">
                <i class="fa fa-save"></i> Update</button>
                <a href="penilaian.php" class="btn btn-danger">
                <i class="fa fa-times"></i> Kembali</a>
              </div>
            </div>
            
            
       </form>

          
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