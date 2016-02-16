<?php
  require('fonction.inc');
  require('exportPDF.php');

  $bdd = connexionDB();
  session_start();
  $pdf=new PDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','',12);
  $pdf->WriteHTML(suppliesStudentList($bdd));
  $pdf->Output('exportPDF.pdf');

?>
