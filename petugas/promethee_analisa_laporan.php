<?php 
	include_once("../analisa.php");
	require('../fpdf182/fpdf.php');

	$no = 1;
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

	$pdf->SetFont('Times','U'.'B',12);
	$pdf->SetX(8); 
	$pdf->Cell(0,0.3,'Ranking Supplier',0,1);

	date_default_timezone_set("Asia/Jakarta");
	$pdf->SetFont('Courier','B',10);
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
	$pdf->Cell(4,0.5,'Nama Supplier',1);
	$pdf->Cell(6,0.5,'Nilai',1);
	$pdf->Cell(3,0.5,'Ranking',1);
	
	$pdf->Ln(0.5);
	for ($i=0;$i<count($net_flow_rangking);$i++){
	
	
	$pdf->Cell(1,0.5,''.$no++.'',1);
	//$pdf->Cell(1,0.5,''.$data['id_supplier'].'',1);
	$pdf->Cell(4,0.5,''.$alternatif_rangking[$i].'',1);
	$pdf->SetFont('Courier','B',7);
	$pdf->Cell(6,0.5,''.$net_flow_rangking[$i].'',1);
	$pdf->SetFont('Courier','B',7);
	$pdf->Cell(3,0.5,''.($i+1).'',1);
	
	$pdf->Ln(0.5);
	}

	$pdf->Output();
 ?>