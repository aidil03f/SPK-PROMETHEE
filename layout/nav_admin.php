<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">

        <div class="pull-left image">
    <?php include '../connection.php'; 
          $query   = mysqli_query($connect, "SELECT * FROM user");
          $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
          foreach($results as $rowfotonav){
            if($rowfotonav['photo']==$_SESSION['photo']){
              $fotonav = '<img src="./../foto/'.$rowfotonav['photo'].'" class="img-circle" alt="User Image">';
              echo $fotonav;
            }
          } ?>
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nama_lengkap'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i><?php echo $_SESSION['username'];?></a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
      
        <li>
          <a href="dashboard.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        
        <li>
          <a href="kriteria.php">
            <i class="fa fa-list-ul"></i> <span>Kriteria</span>
          </a>
        </li>

        <li>
          <a href="alternatif.php">
            <i class="fa fa-users"></i> <span>Alternatif supplier</span>
          </a>
        </li>

         <li>
          <a href="penilaian.php">
            <i class="fa fa-pencil-square"></i> <span>Input penilaian</span>
          </a>
        </li>

         <li>
          <a href="promethee_analisa.php">
            <i class="fa fa-bar-chart"></i> <span>Analisa perankingan</span>
          </a>
        </li>

        <li>
          <a href="user.php">
            <i class="fa fa-user"></i> <span>User</span> 
          </a>
        </li>
        
        

        <li>
          <a href="../logout.php" onclick="return confirm('yakin anda ingin logout ?')">
            <i class="fa fa-sign-in"></i> <span>Logout</span>
          </a>
        </li>
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
