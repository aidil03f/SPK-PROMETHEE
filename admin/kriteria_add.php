<?php include '../connection.php';

      session_start();
  if  (@$_SESSION['akses_level'] == "petugas"){
      echo "<script> alert('Anda harus login sebagai admin user terlebih dahulu untuk mengakses module');
            window.location = 'login.php';</script>";
      exit;
    }
    include '../layout/header.php';
    include '../layout/nav_admin.php'; ?>
      <!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Tambah Kriteria
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">kriteria</a></li>
        <li class="active">Input Data Kriteria</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-7">
      
      <div class="box box-primary box-solid">
        
        <!-- /.box-header -->
        <div class="box-body">

       <form class="form-horizontal" method="post" action="kriteria_insert.php">
         
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama kriteria</label>
              <div class="col-sm-8">
                <input type="text" name="nama_kriteria" class="form-control" placeholder="nama kriteria" required>
              </div>
           </div>

           <div class="form-group">
              <label class="col-sm-2 control-label">Kaidah</label>
              <div class="col-sm-8">
                <select name="kaidah" class="form-control">
                  
                  <option value="maksimum">Maksimum</option>
                  <option value="minimum">Minimum</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Bobot</label>
              <div class="col-sm-8">
                <input type="text" name="bobot" class="form-control" placeholder="bobot" required>
              </div>
           </div>

           <div class="form-group">
              <label class="col-sm-2 control-label">Tipe preferensi</label>
              <div class="col-sm-8" >
                <select name="tipe_preferensi" class="form-control">
                  
                  <option value="I">I.Usual Criterion</option>
                  <option value="II">II.Quasi Criterion</option>
                  <option value="III">III.Criterion with Linear Preference</option>
                  <option value="IV">IV.Level Criterion</option>
                 <option value="V">V.Criterion with Linear Preference and Indifference Area</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Parameter p</label>
              <div class="col-sm-8">
                <input type="text" name="p" class="form-control" placeholder="parameter p" required>
              </div>
           </div>

           <div class="form-group">
              <label class="col-sm-2 control-label">Parameter q</label>
              <div class="col-sm-8">
                <input type="text" name="q" class="form-control" placeholder="parameter q" required>
              </div>
           </div>    

            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-8">
                <button class="btn btn-primary" type="submit" name="submit">
                <i class="fa fa-save"></i> Simpan</button>
                <a href="kriteria.php" class="btn btn-danger">
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