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
    $this->SetFont('times', 'B', 15);
    $this->Cell(0, 8, ' ISO 9001:2005 Certified Company', 0, 1,'C');
    $this->Cell(0, 8, 'BUSSINESS SOLUTIONS - SOFTWARE DEVOLPMENT & IT SUPPORT', 0, 1,'C');
    $this->Ln(2);
    $this->SetX(0);
    //$this->SetDrawColor(255,0,0);
    $this->SetFillColor(215, 58, 149);
    $this->Cell(250,1.5,"",0,1,"C",true);
    // Line break
    $this->Ln(8);
}
// Page footer
function Footer(){
    $this->SetY(-31);
    $this->SetX(0);
    //$this->SetDrawColor(255,0,0);
    $this->SetFillColor(60, 107, 177);
    $this->Cell(230,1.5,"",0,1,"C",true);
    $this->Ln(2);
    // Position at 1.5 cm from bottom
     // Title
    $this->SetFont('times', '', 13);
    $this->Cell(0,5,'17/99, 2nd Floor, 5th Street, lyyappa Nagar, N.S.Puram, Vijayalakshmi Mills,',0,1,'C', false, 'https://goo.gl/maps/EwhHPfbyDb1Y7qXG6');
    $this->Cell(0, 5, 'Kuniyamuthur, Coimbatore - 641 008', 0, 1,'C',false, 'https://goo.gl/maps/EwhHPfbyDb1Y7qXG6');
    $this->Cell(0, 5, 'Tel: 0422-252601 Mob: +91 97878 52601,  +91-94421 52601', 0, 1,'C', false,'tel:9787852601');
    $this->Cell(0, 4, 'Email: vitabsquare@gmail.com, info@vtabsquare.com Web: www.Vtabsquare.com', 0, 1,'C');

        // Page number
        // $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
}
}
// Instanciation of inherited class
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('..\View\assets\Images\logo.jpg', 50,80, 110, 110);
$pdf->SetAutoPageBreak(true, 25);
$sql= "SELECT * FROM `bill`";
$res= mysqli_query($conn,$sql);
if($res){
    while ($row=mysqli_fetch_assoc($res)) {
        $totearning=$row['GrossSalary']+$row['HRA']+$row['Basic']+$row['LTA']+$row['Commission']+$row['Telephone']+$row['Bonus']+$row['Special'];
        $totearnings = number_format($totearning,2);
        $totdeducts=$row['IncomeTax']+$row['EmployeePF']+$row['PT'];
        $totdeduct = number_format($totdeducts,2);;
        $tot= $totearning + $totdeducts;
       $tot= number_format($tot,2);

        //User Details
    $pdf->SetFillColor(122, 171, 62);
    $pdf->SetFont('times','B',17);
    $pdf->Cell(0, 4, 'PaySlip for month of '.$row['Month'], 0, 1,'C');
    $pdf->ln(5);
    $pdf->Cell(0, 0.6, '', 0, 1,'C',true);
    $pdf->ln(5);
    $pdf->SetFont('times','',14);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'Name', 0, 0,"L");
    $pdf->Cell(40,10,$row['Name'], "", 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'EMPLOYEE ID', "", 0,"L");
    $pdf->Cell(40,10,$row['Emp_id'], "", 1,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'DESIGNATION', "", 0, "L");
    $pdf->Cell(40,10,$row['Designation'], "", 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'BANK NAME', 0, 0, "L");
    $pdf->Cell(40,10,$row['BankName'], 0, 1, "L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'DEPARTMENT', 0, 0, "L");
    $pdf->Cell(40,10,$row['Dept'], 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'BANK A/C NO', 0, 0, "L");
    $pdf->Cell(40,10,$row['AccountNo'], 0, 1, "L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'LOCATION', 0, 0, "L");
    $pdf->Cell(40,10,$row['City'], 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'PAN', 0, 0, "L");
    $pdf->Cell(40,10,$row['PAN'], 0, 1, "L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 1,"L");
    $pdf->Cell(40,10,'L.O.P', 0, 0, "L");
    $pdf->Cell(40,10,$row['LOP'], 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'', 0, 0, "R");
    $pdf->Cell(40,10,'', 0, 1, "R");
    $pdf->ln(15);
    
    //Salary Details
    $pdf->SetFillColor(122, 171, 62);
    $pdf->Cell(0, 0.6, '', 0, 1,'C',true);
    $pdf->ln(5);
    $pdf->SetFont('times','',14);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'Earnings', 0, 0,"L");
    $pdf->Cell(40,10,'Amount', "", 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'Deduction', "", 0,"L");
    $pdf->Cell(40,10,'Amount', "", 1,"L");
    $pdf->ln(5);
    $pdf->Cell(0, 0.6, '', 0, 1,'C',true);
    $pdf->ln(5);
    $pdf->SetFont('times','',14);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'Basic', 0, 0,"L");
    $pdf->Cell(40,10,$row['Basic'], "", 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'Income Tax', "", 0,"L");
    $pdf->Cell(40,10,$row['IncomeTax'], "", 1,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'HRA', "", 0, "L");
    $pdf->Cell(40,10,$row['HRA'], "", 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'Provident Fund', 0, 0, "L");
    $pdf->Cell(40,10,$row['EmployeePF'], 0, 1, "L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'Telephone', 0, 0, "L");
    $pdf->Cell(40,10,$row['Telephone'], 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'Professional Tax', 0, 0, "L");
    $pdf->Cell(40,10,$row['PT'], 0, 1, "L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 1,"L");
    $pdf->Cell(40,10,'Bonus', 0, 0, "L");
    $pdf->Cell(40,10,$row['Bonus'], 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'', 0, 0, "L");
    $pdf->Cell(40,10,'', 0, 1, "L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 1,"L");
    $pdf->Cell(40,10,'LTA', 0, 0, "L");
    $pdf->Cell(40,10,$row['LTA'], 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'', 0, 0, "L");
    $pdf->Cell(40,10,'', 0, 1, "L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 1,"L");
    $pdf->Cell(40,10,'Special Allowance', 0, 0,"L");
    $pdf->Cell(40,10,$row['Special'], "", 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'', "", 0,"L");
    $pdf->Cell(40,10,'', "", 1,"L");
    $pdf->ln(8);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'Total Earnings', 0, 0,"L");
    $pdf->Cell(40,10,$totearnings, "", 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'Total Deductions', "", 0,"L");
    $pdf->Cell(40,10,$totdeduct, "", 1,"L");
    $pdf->ln(8);
    $pdf->Cell(250,10,'Net Pay for the month: '.$tot, "", 1,"L");
    $pdf->ln(5);
    $pdf->Cell(250,0.3,'', 0, 1,"L",true);
    }
}
$pdf->Output();
?>


Bill_id

Name



Month
CompanyName
Address1
Address2
City
State
Country
Postal Code


UAN
PFNumber

GrossSalary
HRA

Commission







