<?php
require_once( "fpdf/fpdf.php" );
$pdf = new FPDF();
$pdf->open();
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);

 
//table header
	
$pdf->setFont("times","B","12");
$pdf->setXY(10, 80);
$pdf->Cell(80, 10, "FirstName", 0, 0, "C", 0);
$pdf->Cell(60, 10, "LastName", 0, 0, "C", 0);
$pdf->Cell(25, 10, "UserName", 0, 0, "C", 0);//w,h,txt,border,ln,align,fill,link

//gegevens van database
$y = $pdf->GetY();
$x = 10;
$pdf->setXY($x, $y);
 
 
$con = mysql_connect("127.0.0.1","root",""); //connecting server
mysql_select_db('jcu_db',$con);  //selecting database
//$sql = ...
//query ...
$data = mysql_query("SELECT * FROM jcu_db.students "); 
while ($row = mysql_fetch_array($data))
{
    $pdf->Cell(80, 10, $row['FirstName'], 0);
	$pdf->Cell(60, 10, $row['LastName'], 0);
	$pdf->Cell(25, 10, $row['UserName'], 0);
	
	
	$y += 10;
	
	if ($y > 180)
	{
		$pdf->AddPage();
		$y = 20;
	}
	
	$pdf->setXY($x, $y);
}
 
$pdf->Output("test.pdf", "I");