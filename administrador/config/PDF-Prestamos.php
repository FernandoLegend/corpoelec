<?php
require('../../fpdf/fpdf.php');

date_default_timezone_set('America/Caracas');

$GLOBALS['fecha']=date(" d / m / Y");

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
	
    // Arial bold 15
    $this->SetFont('Arial','B',11);
    // Movernos a la derecha
    $this->Cell(105);
    // Título
    $this->Cell(70,10,'Prestamos ' . $GLOBALS['fecha'],0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(30,10,'ID',1,0,'C',0);
	$this->Cell(35,10,'Cedula',1,0,'C',0);
	$this->Cell(35,10,'Plazo',1,0,'C',0);
    $this->Cell(35,10,'Monto',1,0,'C',0);
	$this->Cell(35,10,'Cuotas',1,0,'C',0);
    $this->Cell(35,10,'Interes',1,0,'C',0);
    $this->Cell(35,10,'Total a Pagar',1,0,'C',0);
	$this->Cell(35,10,'Monto x Cuota',1,1,'C',0);
  
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página') .$this->PageNo().'/{nb}',0,0,'C');
}
}

// Conexion a la base de dato
include("./bd.php");
$con=conectar();
//

$sql="SELECT * FROM prestamos";

$query=mysqli_query($con, $sql);
//

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('LANDSCAPE');
$pdf->SetFont('Arial','B',10);

while ($row=$query->fetch_assoc()) {
	$pdf->Cell(30,10,$row['id'],1,0,'C',0);
	$pdf->Cell(35,10,$row['cedula'],1,0,'C',0);
    $pdf->Cell(35,10,$row['tipo'],1,0,'C',0);
	$pdf->Cell(35,10,$row['monto'] . ' Bs.',1,0,'C',0);
    $pdf->Cell(35,10,$row['cuotas'],1,0,'C',0);
	$pdf->Cell(35,10,$row['interes'] . ' %',1,0,'C',0);
    $pdf->Cell(35,10,$row['total'] . ' Bs.',1,0,'C',0);
    $pdf->Cell(35,10,$row['montoxcuota'],1,1,'C',0);
    

}


	$pdf->Output();
?>