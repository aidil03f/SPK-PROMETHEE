<?php include '../connection.php';

      session_start();
  if  (@$_SESSION['akses_level'] == "petugas"){
      echo "<script> alert('Anda harus login sebagai admin user terlebih dahulu untuk mengakses module');
            window.location = 'login.php';</script>";
      exit;
    }
include '../layout/header.php';
include '../layout/nav_admin.php';

$id_kriteria = $_GET['id_kriteria'];

$query = Mysqli_query($connect, "SELECT * FROM kriteria WHERE id_kriteria='$id_kriteria' LIMIT 1");
$result = Mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

      <!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        form edit Kriteria
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">kriteria</a></li>
        <li class="active">Edit Data Kriteria</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-7">
      
      <div class="box box-primary box-solid">
        
        <!-- /.box-header -->
        <div class="box-body">

       <form action="kriteria_update.php" method="post" class="form-horizontal">
          
          <input type="hidden" name="id_kriteria" value="<?php echo $result[0]['id_kriteria'];?>"> 

            <div class="form-group">
              <label class="col-sm-2 control-label">Nama kriteria</label>
              <div class="col-sm-8">
                <input type="text" name="nama_kriteria" class="form-control" 
                       value="<?php echo $result[0]['nama_kriteria'];?>" required>
              </div>
           </div>

           <div class="form-group">
              <label class="col-sm-2 control-label">Kaidah</label>
              <div class="col-sm-8">
                <select name="kaidah" class="form-control">
                  
                  <option value="maksimasi"<?php echo ($result[0]['kaidah'] == 'maksimasi') ? 'selected' : '';?>>Maksimasi</option>
                  <option value="minimasi" <?php echo ($result[0]['kaidah'] == 'minimasi') ? 'selected' : '';?>>Minimasi</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Bobot</label>
              <div class="col-sm-8">
                <input type="text" name="bobot" class="form-control" value="<?php echo $result[0]['bobot'];?>" required>
              </div>
           </div>

           <div class="form-group">
              <label class="col-sm-2 control-label">Tipe preferensi</label>
              <div class="col-sm-8" >
                <select name="tipe_preferensi" class="form-control">
                  <option value="I"<?php echo ($result[0]['tipe_preferensi'] == 'I') ? 'selected' : '';?> >
                  I.Usual Criterion</option>
                  <option value="II"<?php echo ($result[0]['tipe_preferensi'] == 'II') ? 'selected' : '';?>>         II.Quasi Criterion</option>
                  <option value="III"<?php echo ($result[0]['tipe_preferensi'] == 'III') ? 'selected' : '';?>>III.Criterion with Linear Preference</option>
                  <option value="IV"<?php echo ($result[0]['tipe_preferensi'] == 'IV') ? 'selected' : '';?>>      IV.Level Criterion</option>
                 <option value="V"<?php echo ($result[0]['tipe_preferensi'] == 'V') ? 'selected' : '';?>>             V.Criterion with Linear Preference and Indifference Area</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Parameter p</label>
              <div class="col-sm-8">
                <input type="text" name="p" class="form-control" value="<?php echo $result[0]['p'];?>" required>
              </div>
           </div>

           <div class="form-group">
              <label class="col-sm-2 control-label">Parameter q</label>
              <div class="col-sm-8">
                <input type="text" name="q" class="form-control" value="<?php echo $result[0]['q'];?>" required>
              </div>
           </div>    

            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-8">
                <button class="btn btn-primary" type="submit">
                <i class="fa fa-save"></i> Update</button>
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