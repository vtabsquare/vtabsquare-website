<?php 
require_once('./dbLocal.php');
include_once "./lib/fpdf.php"; 

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('..\View\assets\Images\VTabicon.jpg',10,6,30,30,'jpg');
    // Arial bold 25
    $this->SetFont('times','B',25);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'VTAB SQUARE PVT LTD',0,1,'C');
    $this->Ln(10);
    $this->SetFont('times', 'B', 14);
    // $this->Cell(0, 5, ' ISO 9001:2005 Certified Company', 0, 1,'C');
    // $this->Cell(0, 5, 'BUSSINESS SOLUTIONS - SOFTWARE DEVOLPMENT & IT SUPPORT', 0, 1,'C');
    $this->Cell(25);
     $this->Cell(0,8,'17/99, 2nd Floor, 5th Street, lyyappa Nagar, N.S.Puram, Vijayalakshmi Mills,',0,1,'C', false, 'https://goo.gl/maps/EwhHPfbyDb1Y7qXG6');
    $this->Cell(0, 8, '', 0, 1,'C',false, 'https://goo.gl/maps/EwhHPfbyDb1Y7qXG6');
    $this->Ln(15);

}

}
// Instanciation of inherited class
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('..\View\assets\Images\logo.jpg', 50,80, 110, 110);
$pdf->SetAutoPageBreak(true, 20);
$sql= "SELECT * FROM `mock_data`";
$res= mysqli_query($conn,$sql);
if($res){
    //User Details
    $pdf->SetFillColor(122, 171, 62);
    $pdf->SetFont('times','B',17);
    $pdf->Cell(0, 4, 'PaySlip for month of APR,2021', 0, 1,'C');
    $pdf->ln(5);
    $pdf->Cell(180, 0.6, '', 0, 1,'C',true);
    $pdf->SetFont('times','',14);
    $pdf->Cell(40,10,'NAME', "L", 0,"L");
    $pdf->Cell(40,10,'Sachin Tendulkar', "", 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', "L", 0,"L");
    $pdf->Cell(40,10,'EMPLOYEE ID', "", 0,"L");
    $pdf->Cell(40,10,'BPTL/001', "R", 1,"L");
    $pdf->Cell(40,10,'DESTINATION', "L", 0, "L");
    $pdf->Cell(40,10,'Co-founder', "", 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', "L", 0,"L");
    $pdf->Cell(40,10,'BANK NAME', 0, 0, "L");
    $pdf->Cell(40,10,'Andra Bank', "R", 1, "L");
    $pdf->Cell(40,10,'DEPARTMENT', "L", 0, "L");
    $pdf->Cell(40,10,'Co-Founder', 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', "L", 0,"L");
    $pdf->Cell(40,10,'BANK A/C NO', 0, 0, "L");
    $pdf->Cell(40,10,'401210000987', "R", 1, "L");
    $pdf->Cell(40,10,'LOCATION', "L", 0, "L");
    $pdf->Cell(40,10,'Bangaluru', 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', "L", 0,"L");
    $pdf->Cell(40,10,'PAN', 0, 0, "L");
    $pdf->Cell(40,10,'BPTL46575MO', "R", 1, "L");
    $pdf->Cell(40,10,'L.O.P', "LB", 0, "L");
    $pdf->Cell(40,10,'0.0', "B", 0, "B");
    $pdf->Cell(10,10,'', "B", 0,"L");
    $pdf->Cell(10,10,'', "LB", 0,"L");
    $pdf->Cell(40,10,'', "B", 0, "R");
    $pdf->Cell(40,10,'', "BR", 1, "R");
    $pdf->ln(15);
    
    //Salary Details
    $pdf->SetFillColor(122, 171, 62);
    $pdf->Cell(180, 0.6, '', 0, 1,'C',true);
    $pdf->SetFont('times','',14);
    $pdf->Cell(40,10,'Earnings', "L", 0,"L");
    $pdf->Cell(40,10,'Amount', "", 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', "L", 0,"L");
    $pdf->Cell(40,10,'Deduction', "", 0,"L");
    $pdf->Cell(40,10,'Amount', "R", 1,"L");
    $pdf->Cell(90,5,'', "LR", 0,"L");
    $pdf->Cell(90,5,'', "LR", 0,"R");
    $pdf->ln(5);
    $pdf->SetFont('times','',14);
    $pdf->Cell(40,10,'Basic', "TL", 0,"L");
    $pdf->Cell(40,10,'83,333.50', "T", 0,"L");
    $pdf->Cell(10,10,'', "T", 0,"L");
    $pdf->Cell(10,10,'', "TL", 0,"L");
    $pdf->Cell(40,10,'Income Tax', "T", 0,"L");
    $pdf->Cell(40,10,'31,444.75', "TR", 1,"L");
    $pdf->Cell(40,10,'HRA', "L", 0, "L");
    $pdf->Cell(40,10,'41,666.75', "", 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', "L", 0,"L");
    $pdf->Cell(40,10,'Provident Fund', 0, 0, "L");
    $pdf->Cell(40,10,'1,800', "R", 1, "L");
    $pdf->Cell(40,10,'Telephone', "L", 0, "L");
    $pdf->Cell(40,10,'0.83', 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', "L", 0,"L");
    $pdf->Cell(40,10,'Professional Tax', 0, 0, "L");
    $pdf->Cell(40,10,'200', "R", 1, "L");
    $pdf->Cell(40,10,'Bonus', "L", 0, "L");
    $pdf->Cell(40,10,'0.00', 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', "L", 0,"L");
    $pdf->Cell(40,10,'', 0, 0, "L");
    $pdf->Cell(40,10,'', "R", 1, "L");
    $pdf->Cell(40,10,'LTA', "L", 0, "L");
    $pdf->Cell(40,10,'0.00', 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', "L", 0,"L");
    $pdf->Cell(40,10,'', 0, 0, "L");
    $pdf->Cell(40,10,'', "R", 1, "L");
    $pdf->Cell(40,10,'Special Allowance', "L", 0,"L");
    $pdf->Cell(40,10,'29,667.00', "", 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', "L", 0,"L");
    $pdf->Cell(40,10,'', "", 0,"L");
    $pdf->Cell(40,10,'', "R", 1,"L");
    $pdf->Cell(90,8,'', "L", 0,"L");
    $pdf->Cell(90,8,'', "LR", 0,"R");
    $pdf->ln(8);
    $pdf->Cell(40,0.3,'', 1, 0,"L");
    $pdf->Cell(40,0.3,'', 1, 0,"L");
    $pdf->Cell(10,0.3,'', 1, 0,"L");
    $pdf->Cell(10,0.3,'', 1, 0,"L");
    $pdf->Cell(40,0.3,'', 1, 0,"L");
    $pdf->Cell(40,0.3,'', 1, 1,"L");
    $pdf->Cell(40,10,'Total Earnings', "LB", 0,"L");
    $pdf->Cell(40,10,'154,668.04', "B", 0,"L");
    $pdf->Cell(10,10,'', "B", 0,"L");
    $pdf->Cell(10,10,'', "LB", 0,"L");
    $pdf->Cell(40,10,'Total Deductions', "B", 0,"L");
    $pdf->Cell(40,10,'33,444.84', "BR", 1,"L");
    $pdf->ln(8);
    $pdf->Cell(250,10,'Net Pay for the month: 119,423.24', "", 1,"L");
    $pdf->ln(5);
    $pdf->Cell(250,0.6,'', 0, 1,"L",true);

}
$pdf->Output();
?>
