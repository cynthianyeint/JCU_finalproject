<?php
require_once( "fpdf/fpdf.php" );

// Begin configuration

$textColour = array(0,0);
$headerColour = array( 100, 100 );

$tableHeaderTopTextColour = array(0,0);
$tableHeaderTopFillColour = array( '#FFFFFF', '#FFFFFF');

$tableHeaderTopProductTextColour = array( 0, 0);
$tableHeaderTopProductFillColour = array( 143, 173);



$tableBorderColour = array(0,0);
$tableRowFillColour = array( 213, 170);



$columnLabels = array( "Q1", "Q2", "Q3");
$rowLabels = array( "SupaWidget", "WonderWidget", "MegaWidget", "HyperWidget" );


$data = array(
          array( 9940, 10100, 9490 ),
          array( 19310, 21140, 20560),
          array( 25110, 26260, 25210),
          array( 27650, 24550, 30040 ),
        );

// End configuration


/**
  Create the title page
**/

$pdf = new FPDF( 'P', 'mm', 'A4' );
//$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->AddPage();

// Logo
$pdf->Image( "JCUlogo.jpg", 10, 5, 60);//image file, xposition,ypositiion,imagesize

// Report Name
$pdf->SetFont( 'Arial', 'B', 14 );
$pdf->Ln(25); //line height
$pdf->Cell( 0, 10, 'Request for enrolment forms', 0, 0, 'C' ); //width,height,text,border,position,alignment,bg,urllink


$pdf = new FPDF( 'P', 'mm', 'A4' );
//$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->AddPage();


$pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1] );
$pdf->Ln( 15 );

// Create the table header row
$pdf->SetFont( 'Arial', 'B', 15 );





for ( $i=0; $i<count($columnLabels); $i++ ) {
  $pdf->Cell( 36, 12, $columnLabels[$i], 1, 0, 'C', true );
}

$pdf->Ln( 12 );

// Create the table data rows

$fill = false;
$row = 0;

foreach ( $data as $dataRow ) {

  // Create the left header cell
  $pdf->SetFont( 'Arial', 'B', 15 );
  
  $pdf->Cell( 46, 12, " " . $rowLabels[$row], 1, 0, 'L', $fill );

  // Create the data cells
  $pdf->SetTextColor( $textColour[0], $textColour[1]);

  $pdf->SetFont( 'Arial', '', 15 );

  for ( $i=0; $i<count($columnLabels); $i++ ) {
    $pdf->Cell( 36, 12, ( '$' . number_format( $dataRow[$i] ) ), 1, 0, 'C', 0 );
  }

  $row++;
  $fill = !$fill;
  $pdf->Ln( 12 );
}

$pdf->Output( "form.pdf", "I" ); //I - display & download //D - force to download
?>