<?php 

    session_start();
    if  (@$_SESSION['akses_level'] == "admin"){
      echo "<script> alert('Anda harus login sebagai admin user terlebih dahulu untuk mengakses module');
            window.location = 'login.php';</script>";
      exit;
    }
      include '../layout/header.php';
      include '../layout/nav_petugas.php'; ?>
      <!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Tambah Alternatif
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">alternatif</a></li>
        <li class="active">Input Data alternatif</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-7">
      
      <div class="box box-primary box-solid">
        
        <!-- /.box-header -->
        <div class="box-body">

       <form class="form-horizontal" method="post" action="alternatif_insert.php">
         
         
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama supplier</label>
              <div class="col-sm-8">
                <input type="text" name="nama_supplier" class="form-control" placeholder="nama supplier" required>
              </div>
           </div>


            <div class="form-group">
              <label class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-8">
                <input type="text" name="alamat" class="form-control" placeholder="alamat" required>
              </div>
           </div>

           <div class="form-group">
              <label class="col-sm-2 control-label">Phone</label>
              <div class="col-sm-8">
                <input type="text" name="phone" class="form-control" placeholder="phone" required>
              </div>
           </div>

           <div class="form-group">
              <label class="col-sm-2 control-label">Email</label>
              <div class="col-sm-8">
                <input type="email" name="email" class="form-control" placeholder="email" required>
              </div>
           </div>

            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-8">
                <button class="btn btn-primary" type="submit" name="submit">
                <i class="fa fa-save"></i> Simpan</button>
                <a href="alternatif.php" class="btn btn-danger">
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