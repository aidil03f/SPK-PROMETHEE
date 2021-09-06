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
        Tambah User
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">user</a></li>
        <li class="active">Input Data user</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-7">
      
      <div class="box box-primary box-solid">
        
        <!-- /.box-header -->
        <div class="box-body">

       <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
         
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama lengkap</label>
              <div class="col-sm-8">
                <input type="text" name="nama_lengkap" class="form-control" placeholder="nama lengkap" required>
              </div>
           </div>


            <div class="form-group">
              <label class="col-sm-2 control-label">Username</label>
              <div class="col-sm-8">
                <input type="text" name="username" class="form-control" placeholder="username" required>
              </div>
           </div>

           <div class="form-group">
              <label class="col-sm-2 control-label">Password</label>
              <div class="col-sm-8">
                <input type="password" name="password" id="password" class="form-control" placeholder="password" required>
                <input type="checkbox" class="form-checkbox"> Show Password
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
              <label class="col-sm-2 control-label">Akses level</label>
              <div class="col-sm-8" >
                <select name="akses_level" class="form-control">
                  
                  <option value="admin">Admin</option>
                  <option value="petugas">Petugas</option>
                </select>
              </div> 
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Foto</label>
              <div class="col-sm-8">
                <input type="file" name="gambar" class="form-control">
              </div>
           </div>

            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-8">
                <button class="btn btn-primary" type="submit" name="simpan">
                <i class="fa fa-save"></i> Simpan</button>
                <a href="user.php" class="btn btn-danger">
                <i class="fa fa-times"></i> Kembali</a>
              </div>
            </div>
       </form>

       <?php
       if(isset($_POST['simpan'])){
          
          $nama_lengkap  = $_POST['nama_lengkap']; 
          $username      = $_POST['username'];
          $password      = $_POST['password'];
          $phone         = $_POST['phone'];
          $email         = $_POST['email'];
          $akses_level   = $_POST['akses_level'];
          $nama_photo    = $_FILES['gambar']['name'];
          $source        = $_FILES['gambar']['tmp_name'];
          $folder        = './../foto/';

          if($nama_photo != ''){
            move_uploaded_file($source,$folder.$nama_photo);
            $insert = mysqli_query($connect, "INSERT INTO user SET
               nama_lengkap='".$nama_lengkap."',
               username='".$username."',
               password='".$password."',
               phone='".$phone."',
               email='".$email."',
               akses_level='".$akses_level."',
               photo='".$nama_photo."'
              ");
            if($insert){
              echo "<script> alert('Data User Berhasil ditambah'); window.location = '/spk_promethee1/admin/user.php';</script>";
            }else{
              echo "<script> alert('Input gagal'); window.location = '/spk_promethee1/admin/user.php';</script>";
            }
            //else jika tidak upload gambar
          }else{
              $insert = mysqli_query($connect, "INSERT INTO user SET
               nama_lengkap='".$nama_lengkap."',
               username='".$username."',
               password='".$password."',
               phone='".$phone."',
               email='".$email."',
               akses_level='".$akses_level."'
              ");
          if($insert){
              echo "<script> alert('Data User Berhasil ditambah'); window.location = '/spk_promethee1/admin/user.php';</script>";  
            }else{
              echo "<script> alert('Input gagal'); window.location = '/spk_promethee1/admin/user.php';</script>";
            }
          }


       }?>

          
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

<script type="text/javascript">
  $(document).ready(function() {
    var cek = $('.form-checkbox').val();
    $('.form-checkbox').click(function() {
      if ($(this).is(':checked')) {
        $('#password').attr('type', 'text');
      } else {
        $('#password').attr('type', 'password');
      }
    });
  });
</script>