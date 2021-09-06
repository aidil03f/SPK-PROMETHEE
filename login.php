<?php 
  session_start();
  include "connection.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Halaman Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome-login.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#">Login | <b>Apotek</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
 <form method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="button" id="button" class="btn btn-primary btn-block btn-flat">
          Sign In</button>
        </div>
         
        <!-- /.col -->
      </div>
</form>


    <!-- /.social-auth-links -->

<?php 
if (isset($_POST['button'])){

  $username     = $_POST['username'];
  $password     = $_POST['password'];
  $query        = mysqli_query($connect,"SELECT * FROM user WHERE username = '$username' AND password='$password'");
  $ada          = mysqli_num_rows($query);
  $data         = mysqli_fetch_array($query);
  $akses_level  = $data['akses_level'];
  $nama_lengkap = $data['nama_lengkap'];
  $foto_session = $data['photo'];
  
  if($ada==1){
    
    $_SESSION['username']=$username;
    $_SESSION['akses_level']=$akses_level;
    $_SESSION['nama_lengkap']=$nama_lengkap;
    $_SESSION['photo']=$foto_session;
    if($akses_level=="admin"){
      header("location:admin/dashboard.php");
      exit;
    }
    elseif($akses_level=="petugas"){
      header("location:petugas/dashboard.php");
      exit;  
    }


  }

  else{
      echo "<script> alert('Maaf username atau password anda salah'); window.location = 'login.php'; </script>";
  }
 
}


?>
   
    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
