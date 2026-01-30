<?php 
require_once('./dbLocal.php');
include_once "./lib/fpdf.php"; 

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('..\View\assets\Images\VTabicon.jpg',10,6,15,15,'jpg');
    // Arial bold 25
    $this->SetFont('times','B',25);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'VTAB SQUARE PVT LTD',0,1,'C');
    $this->SetFont('times', 'B', 15);
    $this->Cell(0, 10, ' ISO 9001:2005 Certified Company', 0, 1,'C');
    $this->Cell(0, 8, 'BUSSINESS SOLUTIONS - SOFTWARE DEVOLPMENT & IT SUPPORT', 0, 1,'C');
    $this->Ln(5);
    $this->SetX(0);
    $this->SetDrawColor(255,0,0);
    $this->SetFillColor(252,  0 , 173);
    $this->Cell(250,2,"",1,1,"C",true);
    // Line break
    $this->Ln(10);
}
// Page footer
function Footer(){
    $this->SetY(-31);
    $this->SetX(0);
    $this->SetDrawColor(255,0,0);
    $this->SetFillColor(60, 107, 177);
    $this->Cell(230,2,"",0,1,"C",true);
    $this->Ln(2);
    // Position at 1.5 cm from bottom
     // Title
    $this->SetFont('times', '', 13);
    $this->Cell(0,5,'17/99, 2nd Floor, 5th Street, lyyappa Nagar, N.S.Puram, Vijayalakshmi Mills,',0,1,'C', false, 'https://goo.gl/maps/EwhHPfbyDb1Y7qXG6');
    $this->Cell(0, 5, 'Kuniyamuthur, Coimbatore - 641 008', 0, 1,'C',false, 'https://goo.gl/maps/EwhHPfbyDb1Y7qXG6');
    $this->Cell(0, 5, 'Tel: 0422-252601 Mob: +91 97878 52601,  +91-94421 52601', 0, 1,'C', false,'tel:9787852601');
    $this->Cell(0, 4, 'Email: vitabsquare@gmail.com, info@vtabsquare.com Web: www.Vtabsquare.com', 0, 1,'C');

        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
}
}
// Instanciation of inherited class
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('..\View\assets\Images\logo.jpg', 50,100, 110, 110);
$pdf->SetX(5);
$pdf->SetAutoPageBreak(true, 40);
$sql= "SELECT * FROM `mock_data`";
$res= mysqli_query($conn,$sql);
if($res){
    $pdf->SetX(7);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetFillColor(102,205,170);
    $pdf->SetFont('times','B',14);
    $pdf->Cell(10,10, 'ID', 1, 0,"",true);
    $pdf->Cell(35,10, 'First Name', 1, 0,"",true);
    $pdf->Cell(35,10, 'Last Name', 1, 0,"",true);
    $pdf->Cell(80,10, 'Email', 1, 0,"",true);
    $pdf->Cell(35,10, 'Gender', 1, 1,"",true);
while ($row=mysqli_fetch_assoc($res)) {
    $pdf->SetX(7);
    $pdf->SetFont('times','',14);
    $pdf->SetDrawColor(0,0,0);
$pdf->Cell(10,10, $row['id'],1,0);
$pdf->Cell(35,10, $row['first_name'],1,0);
$pdf->Cell(35,10, $row['last_name'],1,0);
$pdf->Cell(80,10, $row['email'],1,0);
$pdf->Cell(35,10, $row['gender'],1,1);
}
}
$pdf->Output();
?>
