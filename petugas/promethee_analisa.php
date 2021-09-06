<?php include '../connection.php';

      session_start();
    if  (@$_SESSION['akses_level'] == "admin"){
      echo "<script> alert('Anda harus login sebagai admin user terlebih dahulu untuk mengakses module');
            window.location = 'login.php';</script>";
      exit;
    }
      include '../layout/header.php';
      include '../layout/nav_petugas.php';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Analisa Promethee
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Analisa promethee</a></li>
        <li class="active">Data analisa ranking</li>
      </ol>
</section>
<!-- style="display:none;"-->
<section class="content">

<!-- Main content -->
  <div class="row">
    <div class="col-xs-8">
      <div class="box box-primary box-solid">
      	<div class="box-header">
           <h3 class="box-title">Persyaratan dan Nilai :</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

<?php 
	$alternatif = array();
	
	$queryalternatif = mysqli_query($connect,"SELECT * FROM alternatif_supplier ORDER BY id_supplier");
	$i=0;
	while ($dataalternatif = mysqli_fetch_array($queryalternatif))
	{
		$alternatif[$i] = $dataalternatif['nama_supplier'];
		$i++;
	}
	
	$kriteria = array();
	$minmaks = array();
	$tipe_preferensi = array();
	$q = array();
	$p = array();
	$bobot = array();
	
	$querykriteria = mysqli_query($connect,"SELECT * FROM kriteria ORDER BY id_kriteria");
	$i=0;
	while ($datakriteria = mysqli_fetch_array($querykriteria))
	{
		$kriteria[$i] = $datakriteria['nama_kriteria'];
		$kaidah[$i] = $datakriteria['kaidah'];
		$bobot[$i] = $datakriteria['bobot'];
		$tipe_preferensi[$i] = $datakriteria['tipe_preferensi'];
		$q[$i] = $datakriteria['q'];
		$p[$i] = $datakriteria['p'];
		$i++;
	}
	
	$alternatifkriteria = array();
	
	$queryalternatif = mysqli_query($connect,"SELECT * FROM alternatif_supplier ORDER BY id_supplier");
	$i=0;
	while ($dataalternatif = mysqli_fetch_array($queryalternatif))
	{
		$querykriteria = mysqli_query($connect,"SELECT * FROM kriteria ORDER BY id_kriteria");
		$j=0;
		while ($datakriteria = mysqli_fetch_array($querykriteria))
		{
			$queryalternatifkriteria = mysqli_query($connect,"SELECT * FROM nilai_seleksi WHERE id_supplier
			 = '$dataalternatif[id_supplier]' AND id_kriteria = '$datakriteria[id_kriteria]'");
			$dataalternatifkriteria = mysqli_fetch_array($queryalternatifkriteria);
			
			$alternatifkriteria[$i][$j] = $dataalternatifkriteria['nilai'];
			$j++;
		}
		$i++;
	} 
	
	$total_index_preferensi = array();
	$leaving_flow = array();
	$entering_flow = array();
	$net_flow = array();
	$alternatif_rangking = array();
	$net_flow_rangking = array(); ?>
						  
	<table id="example2" class="table table-bordered table-striped">
<?php 
	echo "<tr>";
	echo "<td rowspan=\"2\">Kriteria</td>";
	echo "<td rowspan=\"2\">Kaidah </td>";
	echo "<td rowspan=\"2\">Bobot</td>";
	echo "<td colspan=\"".count($alternatif)."\">Alternatif</td>";
	echo "<td rowspan=\"2\">Tipe Preferensi</td>";
	echo "<td colspan=\"2\">Parameter</td>";
	echo "</tr>";
	echo "<tr>"; ?>
<?php for ($i=0;$i<count($alternatif);$i++) {
		echo "<td>".$alternatif[$i]."</td>";
	} 
		echo "<td>q</td>";
		echo "<td>p</td>";
		echo "</tr>" ;?>
	
<?php   for ($i=0;$i<count($kriteria);$i++) {
		echo "<tr>";
		echo "<td>".$kriteria[$i]."</td>";
		echo "<td>".$kaidah[$i]."</td>";
		echo "<td>".$bobot[$i]."</td>";
		for ($j=0;$j<count($alternatif);$j++) {
			echo "<td>".$alternatifkriteria[$j][$i]."</td>";
		}
		echo "<td>".$tipe_preferensi[$i]."</td>";
		echo "<td>".$q[$i]."</td>";
		echo "<td>".$p[$i]."</td>";			
		echo "</tr>";
	} 
	echo "</table>"; ?>
	
 			  <!-- /.box-body -->
  			</div>
            <!-- /.box -->
          </div>
       <!-- /.col -->
        </div>
       <!-- /.row -->
      </div>

<!-- Main content -->
<?php for ($i=0;$i<count($alternatif);$i++) {
		for ($j=0;$j<count($alternatif);$j++) {
			$total_index_preferensi[$i][$j] = 0;
		}
	}
	
  for ($i=0;$i<count($kriteria);$i++) { ?>
  <div class="row">

    <div class="col-xs-8">

      <div class="box box-primary box-solid">

      	<div class="box-header">
           <?php echo "<h3 class=\"box-title\">".$kriteria[$i]." :</h3>"; ?>
        </div>

        <!-- /.box-header -->
        <div class="box-body">

		
		<table id="example2" class="table table-bordered table-striped">
<?php 	echo "<tr>";
		echo "<td colspan=\"2\">Alternatif Perbandingan :</td>";
		echo "<td>a</td>";
		echo "<td>b</td>";
		echo "<td>d(jarak)</td>";
		echo "<td>|d|</td>";
		echo "<td>P(Preferensi)</td>";
		echo "<td>P(Indeks Preferensi)</td>";
		echo "</tr>";
		for ($j=0;$j<count($alternatif);$j++) {
			for ($k=$j+1;$k<count($alternatif);$k++) {
				echo "<tr>";
				echo "<td>".$alternatif[$j]."</td>";
				echo "<td>".$alternatif[$k]."</td>";
				echo "<td>".$alternatifkriteria[$j][$i]."</td>";
				echo "<td>".$alternatifkriteria[$k][$i]."</td>";
				$d = ($alternatifkriteria[$j][$i]-$alternatifkriteria[$k][$i]);
				echo "<td>".$d."</td>";
				$d_abs = abs($alternatifkriteria[$j][$i]-$alternatifkriteria[$k][$i]);
				echo "<td>".$d_abs."</td>";
				if (($kaidah[$i] == "minimasi") && ($alternatifkriteria[$j][$i] >= $alternatifkriteria[$k][$i])) 
				{
					$P = 0;
				}
				else if (($kaidah[$i] == "maksimasi") && ($alternatifkriteria[$j][$i] <= $alternatifkriteria[$k][$i])) 
				{
					$P = 0;
				}
				else 
				{
					if ($tipe_preferensi[$i] == "I")
					{
						if ($d == 0)
						{
							$P = 0;
						}
						else //if ($d != 0)
						{
							$P = 1;
						}
					} 
					else if ($tipe_preferensi[$i] == "II")
					{
						if (($d <= $q[$i]) && ($d >= (-1 * $q[$i])))
						{
							$P = 0;
						}
						else //if (($d > $q[$i]) && ($d < (-1 * $q[$i])))
						{
							$P = 1;
						}
					}
					else if ($tipe_preferensi[$i] == "III")
					{
						if (($d <= $p[$i]) && ($d >= (-1 * $p[$i])))
						{
							$P = $d_abs / $p[$i];
						}
						else //if (($d > $p[$i]) && ($d < (-1 * $p[$i])))
						{
							$P = 1;
						}
					}
					else if ($tipe_preferensi[$i] == "IV")
					{
						if (($d <= $q[$i]) && ($d >= -1 * ($q[$i])))
						{
							$P = 0;
						}
						else if ((($d <= $p[$i]) && ($d > $q[$i])) || (($d >= -1 * ($p[$i])) && ($d < -1 * ($q[$i])))) 
						{
							$P = 0.5;
						}
						else //if (($d > $p[$i]) && ($d < (-1 * $p[$i])))
						{
							$P = 1;
						} 
					}
					else if ($tipe_preferensi[$i] == "V")
					{
						if (($d <= $q[$i]) && ($d >= -1 * ($q[$i])))
						{
							$P = 0;
						}
						else if ((($d <= $p[$i]) && ($d > $q[$i])) || (($d >= -1 * ($p[$i])) && ($d < -1 * ($q[$i])))) 
						{
							$P = ($d_abs - $q[$i]) / ($p[$i] - $q[$i]);
						}
						else //if (($d > $p[$i]) && ($d < (-1 * $p[$i])))
						{
							$P = 1;
						} 
					}
				}
				echo "<td>".$P."</td>";
				$IP = $bobot[$i] * $P;
				echo "<td>".$IP."</td>";
				echo "</tr>";
				$total_index_preferensi[$j][$k] = $total_index_preferensi[$j][$k] + $IP;
				
				echo "<tr>";
				echo "<td>".$alternatif[$k]."</td>";
				echo "<td>".$alternatif[$j]."</td>";
				echo "<td>".$alternatifkriteria[$k][$i]."</td>";
				echo "<td>".$alternatifkriteria[$j][$i]."</td>";
				$d = ($alternatifkriteria[$k][$i]-$alternatifkriteria[$j][$i]);
				echo "<td>".$d."</td>";
				$d_abs = abs($alternatifkriteria[$k][$i]-$alternatifkriteria[$j][$i]);
				echo "<td>".$d_abs."</td>";
				if (($kaidah[$i] == "minimasi") && ($alternatifkriteria[$k][$i] >= $alternatifkriteria[$j][$i])) 
				{
					$P = 0;
				}
				else if (($kaidah[$i] == "maksimasi") && ($alternatifkriteria[$k][$i] <= $alternatifkriteria[$j][$i])) 
				{
					$P = 0;
				}
				else 
				{
					if ($tipe_preferensi[$i] == "I")
					{
						if ($d == 0)
						{
							$P = 0;
						}
						else //if ($d != 0)
						{
							$P = 1;
						}
					} 
					else if ($tipe_preferensi[$i] == "II")
					{
						if (($d <= $q[$i]) && ($d >= (-1 * $q[$i])))
						{
							$P = 0;
						}
						else //if (($d > $q[$i]) && ($d < (-1 * $q[$i])))
						{
							$P = 1;
						}
					}
					else if ($tipe_preferensi[$i] == "III")
					{
						if (($d <= $p[$i]) && ($d >= (-1 * $p[$i])))
						{
							$P = $d_abs / $p[$i];
						}
						else //if (($d > $p[$i]) && ($d < (-1 * $p[$i])))
						{
							$P = 1;
						}
					}
					else if ($tipe_preferensi[$i] == "IV")
					{
						if (($d <= $q[$i]) && ($d >= -1 * ($q[$i])))
						{
							$P = 0;
						}
						else if ((($d <= $p[$i]) && ($d > $q[$i])) || (($d >= -1 * ($p[$i])) && ($d < -1 * ($q[$i])))) 
						{
							$P = 0.5;
						}
						else //if (($d > $p[$i]) && ($d < (-1 * $p[$i])))
						{
							$P = 1;
						} 
					}
					else if ($tipe_preferensi[$i] == "V")
					{
						if (($d <= $q[$i]) && ($d >= -1 * ($q[$i])))
						{
							$P = 0;
						}
						else if ((($d <= $p[$i]) && ($d > $q[$i])) || (($d >= -1 * ($p[$i])) && ($d < -1 * ($q[$i])))) 
						{
							$P = ($d_abs - $q[$i]) / ($p[$i] - $q[$i]);
						}
						else //if (($d > $p[$i]) && ($d < (-1 * $p[$i])))
						{
							$P = 1;
						} 
					}
				}
				echo "<td>".$P."</td>";
				$IP = $bobot[$i] * $P;
				echo "<td>".$IP."</td>";
				echo "</tr>";
				$total_index_preferensi[$k][$j] = $total_index_preferensi[$k][$j] + $IP;
			}
		}
		echo "</table>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
	} ?>
			

<!-- Main content -->
  <div class="row">
    <div class="col-xs-8">
      <div class="box box-primary box-solid">
      	<div class="box-header">
           <h3 class="box-title">Total Index Preferensi :</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

	<table id="example2" class="table table-bordered table-striped">
<?php  for ($i=0;$i<count($alternatif);$i++) {
		for ($j=$i+1;$j<count($alternatif);$j++) {
			echo "<tr>";
			echo "<td>".$alternatif[$i]."</td>";
			echo "<td>".$alternatif[$j]."</td>";
			echo "<td>".$total_index_preferensi[$i][$j]."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>".$alternatif[$j]."</td>";
			echo "<td>".$alternatif[$i]."</td>";
			echo "<td>".$total_index_preferensi[$j][$i]."</td>";
			echo "</tr>";
		}
	}		echo "</table>";		
			echo "<br/>"; ?>
	

			 </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


<!-- Main content -->
  <div class="row">
    <div class="col-xs-8">
      <div class="box box-primary box-solid">
      	<div class="box-header">
           <h3 class="box-title">Data Leaving flow dan entering flow :</h3>
        </div>
      
        <!-- /.box-header -->
        <div class="box-body">
	<table id="example2" class="table table-bordered table-striped">
        <tr>
		    <td>Alternatif</td>

<?php   for ($i=0;$i<count($alternatif);$i++) {
		echo "<td>".$alternatif[$i]."</td>";
		$leaving_flow[$i] = 0;
		$entering_flow[$i] = 0;
		$net_flow[$i] = 0; 
} 		
		echo "<td>Jumlah</td>";
		echo "<td>Leaving</td>";
		echo "</tr>"; ?>
<?php 	for ($i=0;$i<count($alternatif);$i++) {  
		echo "<tr>";
		echo "<td>".$alternatif[$i]."</td>"; ?>
<?php 	for ($j=0;$j<count($alternatif);$j++) {
		echo "<td>".$total_index_preferensi[$i][$j]."</td>";
		$leaving_flow[$i] = $leaving_flow[$i] + $total_index_preferensi[$i][$j];
		$entering_flow[$j] = $entering_flow[$j] + $total_index_preferensi[$i][$j];
		}
		echo "<td>".$leaving_flow[$i]."</td>";
		$leaving_flow[$i] = $leaving_flow[$i] / (count($alternatif) - 1);
		echo "<td>".$leaving_flow[$i]."</td>";
		echo "</tr>";
	} ?>
	 <tr>
		<td>Jumlah</td>
<?php for ($i=0;$i<count($alternatif);$i++) {
		echo "<td>".$entering_flow[$i]."</td>";
	} ?>

	</tr>
	<tr>
	<td>Entering</td>
<?php   for ($i=0;$i<count($alternatif);$i++) {
		$entering_flow[$i] = $entering_flow[$i] / (count($alternatif) - 1);
		echo "<td>".$entering_flow[$i]."</td>";
	}
	echo "<td>&nbsp;</td>";
	echo "<td>&nbsp;</td>";
	echo "</tr>";
	echo "</table>";
	echo "<br/>"; ?>

			</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


<!-- Main content -->
  <div class="row">
    <div class="col-xs-8">
      <div class="box box-primary box-solid">
      	<div class="box-header">
           	<h3 class="box-title">Data Net flow :</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">

	<table id="example2" class="table table-bordered table-striped">
     <thead>
        <tr>
		    <th>Alternatif</th>
			<th>Leaving Flow</th>
			<th>Entering Flow</th>
			<th>Net Flow</th>
	   </tr>
	 </thead>
      
<?php	
		for ($i=0;$i<count($alternatif);$i++) {
		echo "<tr>";
		echo "<td>".$alternatif[$i]."</td>";
		echo "<td>".$leaving_flow[$i]."</td>";
		echo "<td>".$entering_flow[$i]."</td>";
		$net_flow[$i] = $leaving_flow[$i] - $entering_flow[$i];
		echo "<td>".$net_flow[$i]."</td>";
		echo "</tr>";
		
		
	} echo "</table>"; 
	  echo "</br>"; ?>
				</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

<?php 
   for ($i=0;$i<count($alternatif);$i++) {
		$net_flow_rangking[$i] = $net_flow[$i];
		$alternatif_rangking[$i] = $alternatif[$i];
	}

	for ($i=0;$i<count($alternatif);$i++) {
		for ($j=$i;$j<count($alternatif);$j++) {
			if ($net_flow_rangking[$i] < $net_flow_rangking[$j]) {
				$tmp_net_flow = $net_flow_rangking[$i];
				$tmp_alternatif = $alternatif_rangking[$i];
				$net_flow_rangking[$i] = $net_flow_rangking[$j];
				$alternatif_rangking[$i] = $alternatif_rangking[$j];
				$net_flow_rangking[$j] = $tmp_net_flow;
				$alternatif_rangking[$j] = $tmp_alternatif;
			}
		}
	} ?>


  <div class="row">
    <div class="col-xs-8"> 
      <div class="box box-primary box-solid">
        <div class="box-header">
           	<h3 class="box-title">Ranking :</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <div style="padding-bottom: 10px;">
        
            <a href="promethee_analisa_print.php" target="_blank" class="btn btn-primary btn-sm">
             <i class="fa fa-print" aria-hidden="true"></i> Print</a>
            <a href="promethee_analisa_laporan.php" class="btn btn-danger btn-sm">
             <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</a>
            
          </div>
 
			<table id="example2" class="table table-bordered table-striped">
			<thead>
			 <tr>
			   <th>No.</th>
			   <th>Alternatif</th>
			   <th>Nilai</th>   
			   <th>Ranking</th>
			</tr>
			</thead>
			<tbody>
		<?php $no=0;for ($i=0;$i<count($net_flow_rangking);$i++){ $no++	?>
			<tr>
			  <td><?php echo $no ?></td>
			  <td><?php echo $alternatif_rangking[$i]; ?></td>
			  <td><?php echo $net_flow_rangking[$i]; ?></td>
			  <td><?php echo ($i+1);?></td>                            
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