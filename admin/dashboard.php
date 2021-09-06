<?php include '../connection.php';
      
      session_start();
  if  (@$_SESSION['akses_level'] == "petugas"){
      echo "<script> alert('Anda harus login sebagai admin user terlebih dahulu untuk mengakses module');
            window.location = 'login.php';</script>";
      exit;
    }
      include '../layout/header.php';
      include '../layout/nav_admin.php';

$querysupplier = mysqli_query($connect, "SELECT * FROM alternatif_supplier");
$countsupplier = mysqli_num_rows($querysupplier);
$querykriteria = mysqli_query($connect, "SELECT * FROM kriteria");
$countkriteria = mysqli_num_rows($querykriteria);
$queryuser     = mysqli_query($connect, "SELECT * FROM user");
$countuser     = mysqli_num_rows($queryuser);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Dashboard</a></li>
      </ol>
</section>

<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="col-lg-12 col-xs-6">
                <div class="box box-primary box-solid">

                    <div class="box-header">
                        <h3 class="box-title">SELAMAT DATANG :</h3>
                    </div>
                    <div class="box-body">
                    <form>
                     <?php echo $_SESSION['nama_lengkap']; ?>
                      Anda Login Sebagai
                     <?php echo $_SESSION['akses_level']; ?>
                    </form>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 col-xs-6">
                <div class="box box-primary box-solid">

                    <div class="box-header">
                        <h3 class="box-title">INFO PERANKINGAN</h3>
                    </div>

                    <div class="box-body">
                    <form>
                          
                      <h4><center>Sistem Pendukung Keputusan untuk perankingan supplier apotek ringinsari menggunakan metode PROMETHEE 
                      (Preference Ranking Organization Method for Enrichment Evaluation)</center></h4>
                      </br>
<div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><?php echo $countsupplier ?></h3>

              <p>total supplier</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="alternatif.php" class="small-box-footer">lihat selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?php echo $countkriteria ?><sup style="font-size: 20px"></sup></h3>

              <p>total kriteria</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="kriteria.php" class="small-box-footer">lihat selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

         <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $countuser ?></h3>

              <p>total user</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="user.php" class="small-box-footer">lihat selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


                  </form>
                  </div>
              </div>
          </div>



</div>
    
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<?php include '../layout/footer.php' ?>