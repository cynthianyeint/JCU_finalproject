<?php
require_once( "fpdf/fpdf.php" );


// Begin configuration

$textColour = array( 0, 0, 0 );
//$headerColour = array( 100, 100, 100 );
$reportName = "Enrolment Form";
$reportNameYPos = 50;
// End configuration


/**
  Create the title page
**/
$pdf = new FPDF( 'P', 'mm', 'A4' );
$pdf->AddPage();

$pdf->Image( "JCUlogo.jpg", 0, 0, 60 ); //LOGO file , xpos, ypos,width
$pdf->SetFont( 'Arial', 'B', 20);
$pdf->Ln( 30 );
$pdf->Cell( 0, 0, 'Request for Enrolment of Subjects', 0, 0, 'C' ); //w,h,txt,border,ln,align,fill,link

//table header
	
$pdf->setFont("times","B","14");
$pdf->setXY(10, 60);
$pdf->Cell(60, 10, "FirstName", 1, 0, "C", 0);
$pdf->Cell(60, 10, "LastName", 1, 0, "C", 0);
$pdf->Cell(60, 10, "UserName", 1, 0, "C", 0);//w,h,txt,border,ln,align,fill,link

//database
$x = 10;
$y= 70;
$pdf->setXY($x, $y);
$con = mysql_connect("127.0.0.1","root",""); //connecting server
mysql_select_db('jcu_db',$con);  //selecting database
$data = mysql_query("SELECT * FROM jcu_db.students "); 
while ($row = mysql_fetch_array($data))
{
    $pdf->setFont("times","","12");
	$pdf->Cell(60, 10, $row['FirstName'], 1, 0, "C", 0);
	$pdf->Cell(60, 10, $row['LastName'], 1, 0, "C", 0);
	$pdf->Cell(60, 10, $row['UserName'],  1, 0, "C", 0);
	
	$y += 10;
	
	if ($y > 180)
	{
		$pdf->AddPage();
		$y = 20;
	}
	
	$pdf->setXY($x, $y);
}



$pdf->Output( "report.pdf", "I" );





?>