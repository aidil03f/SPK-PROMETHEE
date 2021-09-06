<?php 
	include_once("../connection.php");
	require('../fpdf182/fpdf.php');

	$no = 1;
	$sql = $connect->query("SELECT * FROM user");


	$pdf = new FPDF ('P','cm','A4');
	$pdf->AddPage();

	$pdf->SetFont('Courier','B',14);
	//$pdf->Image('images/logo1.png',5,1,1.6,1.4);
	$pdf->SetX(6.6); 
	$pdf->MultiCell(19.5,0.5,'APOTEK RINGINSARI',0,'L'); 
	$pdf->SetX(3.6); 
	$pdf->MultiCell(19.5,0.5,'JL ANGGREK RINGINSARI MAGUWOHARJO DEPOK SLEMAN',0,'L'); 
	$pdf->SetFont('Courier','B',10); 
	$pdf->SetX(6.6); 
	$pdf->MultiCell(19.5,0.5,'TELEPON : 085225484729',0,'L'); 

	$pdf->Line(1,2.7,20.2,2.7); 
	$pdf->SetLineWidth(0.1); 
	$pdf->Line(1,2.8,20.2,2.8); 
	$pdf->SetLineWidth(0); 
	$pdf->Ln(0.8);

	$pdf->SetFont('Times','U'.'B',14);
	$pdf->SetX(8); 
	$pdf->Cell(0,0.3,'Data User',0,1);

	date_default_timezone_set("Asia/Jakarta");
	$pdf->SetFont('Courier','B',12);
	$pdf->Ln(0.5);
	$pdf->cell(3,0.5,'Hari',0);
	$pdf->Cell(2,0.5,': '.Date("l").'',0);
	$pdf->Ln(0.5);
	$pdf->cell(3,0.5,'Tanggal',0);
	$pdf->Cell(2,0.5,': '.Date("d-M-Y ").'',0);
	$pdf->Ln(0.5);

	$pdf->cell(3,0.5,'Jam',0);
	$pdf->Cell(2,0.5,': '.Date("H:i:s").'',0);
	$pdf->Ln(1);


	$pdf->SetFont('Courier','B',8);
	$pdf->Cell(1,0.5,'No',1);
	//$pdf->Cell(1,0.5,'ID',1);
	$pdf->Cell(4,0.5,'Nama User',1);
	$pdf->Cell(4,0.5,'Username',1);
	$pdf->Cell(3,0.5,'Akses level',1);
	$pdf->Cell(3,0.5,'Phone',1);
	$pdf->Cell(4,0.5,'email',1);

	$pdf->Ln(0.5);
	while ($data = mysqli_fetch_array($sql)) {
	$pdf->Cell(1,0.5,''.$no++.'',1);
	//$pdf->Cell(1,0.5,''.$data['id_kriteria'].'',1);
	$pdf->Cell(4,0.5,''.$data['nama_lengkap'].'',1);
	$pdf->SetFont('Courier','B',7);
	$pdf->Cell(4,0.5,''.$data['username'].'',1);
	$pdf->SetFont('Courier','B',7);
	$pdf->Cell(3,0.5,''.$data['akses_level'].'',1);
	$pdf->SetFont('Courier','B',8);
	$pdf->Cell(3,0.5,''.$data['phone'].'',1);
	$pdf->Cell(4,0.5,''.$data['email'].'',1);
	$pdf->Ln(0.5);
	}

	$pdf->Output();
 ?>