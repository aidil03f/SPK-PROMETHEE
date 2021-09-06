<?php include '../connection.php';

      session_start();
    if  (@$_SESSION['akses_level'] == "petugas"){
      echo "<script> alert('Anda harus login sebagai admin user terlebih dahulu untuk mengakses module');
            window.location = 'login.php';</script>";
      exit;
    }
      include '../layout/header.php';
      include '../layout/nav_admin.php';

$id_user = $_GET['id_user'];

$query = Mysqli_query($connect, "SELECT * FROM user WHERE id_user='$id_user' LIMIT 1");
$result = Mysqli_fetch_all($query, MYSQLI_ASSOC);

?>
      <!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Edit User
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">user</a></li>
        <li class="active">Edit Data user</li>
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
        <input type="hidden" name="id_user" value="<?php echo $result[0]['id_user'];?>">

            <div class="form-group">
              <label class="col-sm-2 control-label">Nama lengkap</label>
              <div class="col-sm-8">
                <input type="text" name="nama_lengkap" class="form-control"
                       value="<?php echo $result[0]['nama_lengkap'];?>" required>
              </div>
           </div>


            <div class="form-group">
              <label class="col-sm-2 control-label">Username</label>
              <div class="col-sm-8">
                <input type="text" name="username" class="form-control" 
                       value="<?php echo $result[0]['username'];?>" required>
              </div>
           </div>

           <div class="form-group">
              <label class="col-sm-2 control-label">Password</label>
              <div class="col-sm-8">
                <input type="password" name="password" id="password" class="form-control" 
                       value="<?php echo $result[0]['password'];?>" required>
                <input type="checkbox" class="form-checkbox"> Show Password
              </div>
           </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Email</label>
              <div class="col-sm-8">
                <input type="email" name="email" class="form-control" 
                       value="<?php echo $result[0]['email'];?>" required>
              </div>
           </div>

           <div class="form-group">
              <label class="col-sm-2 control-label">Phone</label>
              <div class="col-sm-8">
                <input type="text" name="phone" class="form-control"
                       value="<?php echo $result[0]['phone'];?>" required>
              </div>
           </div>

           <div class="form-group">
              <label class="col-sm-2 control-label">Akses level</label>
              <div class="col-sm-8" >
                <select name="akses_level" class="form-control">
                  
            <option value="admin"<?php echo ($result[0]['akses_level'] == 'admin') ? 'selected' : '';?>>Admin</option>
            <option value="petugas" <?php echo ($result[0]['akses_level'] == 'petugas') ? 'selected' : '';?>>
            Petugas</option>
                </select>
                
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Photo</label>
              <div class="col-sm-8">
                <input type="hidden"  value="<?php echo $result[0]['photo'];?>">
                <img src="../foto/<?php echo $result[0]['photo'];?>" width="60px" height="60px">
                <input type="file" name="gambar">
              </div>
           </div>

            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-8">
                <button class="btn btn-primary" type="submit" name="kirim">
                <i class="fa fa-save"></i> Simpan</button>
                <a href="user.php" class="btn btn-danger">
                <i class="fa fa-times"></i> Kembali</a>
              </div>
            </div>                        
       </form>

       <?php
       if(isset($_POST['kirim'])){
          
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
            $update = mysqli_query($connect, "UPDATE user SET
               nama_lengkap='".$nama_lengkap."',
               username='".$username."',
               password='".$password."',
               phone='".$phone."',
               email='".$email."',
               akses_level='".$akses_level."',
               photo='".$nama_photo."'
               WHERE id_user='".$_GET['id_user']."'
              ");
            if($update){
              
              echo "<script> alert('Data User Berhasil diubah'); window.location = '/spk_promethee1/admin/user.php';</script>";
            }else{
              echo "<script> alert('Data User Gagal diubah'); window.location = '/spk_promethee1/admin/user.php';</script>";
            }
            //else jika tidak upload gambar
          }else{
              $update = mysqli_query($connect, "UPDATE user SET
               nama_lengkap='".$nama_lengkap."',
               username='".$username."',
               password='".$password."',
               phone='".$phone."',
               email='".$email."',
               akses_level='".$akses_level."'
               WHERE id_user='".$_GET['id_user']."'
              ");
          if($update){
              
              echo "<script> alert('Data User Berhasil diubah'); window.location = 'user.php';</script>";  
            }else{
              echo "<script> alert('Data User Gagal diubah'); window.location = 'user.php';</script>";
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