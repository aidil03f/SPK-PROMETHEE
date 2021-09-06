<?php
	include 'connection.php';
?>

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
						  
<?php for ($i=0;$i<count($alternatif);$i++) {} ?>
	
<?php for ($i=0;$i<count($kriteria);$i++) {
		 for ($j=0;$j<count($alternatif);$j++) {}
	} ?>

<?php for ($i=0;$i<count($alternatif);$i++) {
		for ($j=0;$j<count($alternatif);$j++) {
			$total_index_preferensi[$i][$j] = 0;
		}
	}
	
	 for ($i=0;$i<count($kriteria);$i++) { ?>
		
	
<?php for ($j=0;$j<count($alternatif);$j++) {
			for ($k=$j+1;$k<count($alternatif);$k++) {

				$d = ($alternatifkriteria[$j][$i]-$alternatifkriteria[$k][$i]);
				
				$d_abs = abs($alternatifkriteria[$j][$i]-$alternatifkriteria[$k][$i]);
				
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
						else 
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
						else 
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
						else
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
						else
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
						else 
						{
							$P = 1;
						} 
					}
				}
				
				$IP = $bobot[$i] * $P;
			
				
				$total_index_preferensi[$j][$k] = $total_index_preferensi[$j][$k] + $IP;
				
	
				$d = ($alternatifkriteria[$k][$i]-$alternatifkriteria[$j][$i]);
				
				$d_abs = abs($alternatifkriteria[$k][$i]-$alternatifkriteria[$j][$i]);
				
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
						else
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
						else 
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
						else 
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
						else
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
						else
						{
							$P = 1;
						} 
					}
				}
				
				$IP = $bobot[$i] * $P;
				
			
				$total_index_preferensi[$k][$j] = $total_index_preferensi[$k][$j] + $IP;
			}
		}
				
	}?>

<?php  for ($i=0;$i<count($alternatif);$i++) {
		for ($j=$i+1;$j<count($alternatif);$j++) {
			
			
			
		}
	} ?>		
	  
<?php   for ($i=0;$i<count($alternatif);$i++) {
		
		$leaving_flow[$i] = 0;
		$entering_flow[$i] = 0;
		$net_flow[$i] = 0; 
}?> 		
		
<?php 	for ($i=0;$i<count($alternatif);$i++) {  
			for ($j=0;$j<count($alternatif);$j++) {
			$leaving_flow[$i] = $leaving_flow[$i] + $total_index_preferensi[$i][$j];
			$entering_flow[$j] = $entering_flow[$j] + $total_index_preferensi[$i][$j];
		}
		$leaving_flow[$i] = $leaving_flow[$i] / (count($alternatif) - 1);
	} ?>
	
<?php for ($i=0;$i<count($alternatif);$i++) {
	} ?>

<?php   for ($i=0;$i<count($alternatif);$i++) {
		$entering_flow[$i] = $entering_flow[$i] / (count($alternatif) - 1);
	} ?>
	
<?php for ($i=0;$i<count($alternatif);$i++) {
		$net_flow[$i] = $leaving_flow[$i] - $entering_flow[$i];
	} ?>
	
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

