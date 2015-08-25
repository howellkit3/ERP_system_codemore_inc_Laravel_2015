<?php 

// New Word Document
$PHPWord = new PHPWord();



// $i = 0;
// foreach ($salaries as $key => $salary) {
	


// 	$employee = $this->CustomEmployee->findEmployee($salary['employee_id']);
// 	$employee_name = $this->CustomText->getFullname($employee['Employee']);


// 	$section = $PHPWord->createSection();

// 	$document = $PHPWord->loadTemplate('./img/salaries/payslip.docx');

// 	$document->setValue('{EmployeeName}', $employee_name);
// 	$document->setValue('{Period}', $payrollDate);
// 	$document->setValue('{WorkingDays}', $salary['days']);

// 	$document->setValue('{EmpCode}', $employee['Employee']['code']);


// 	$section->addPageBreak();

// 	$filename = 'salaries-'.date('y-m-d').'-'.time(). $key .'.docx';

// 	$document->save('./img/salaries/'.$filename);
//    // $document->addPageBreak();

// }



 foreach ($salaries as $key => $salary) {
// New portrait section
$section = $PHPWord->createSection();

// Add header
$header = $section->createHeader();
$table = $header->addTable();
$table->addRow();
$table->addCell(4500)->addImage('./img/koufu_logo.jpg', array('width'=>250, 'height'=>auto, 'align'=>'left'));


// $image = $section->addImage('./img/koufu_logo.jpg',array ('width'=> 250));

// $section->addText('Employee Name : Aldrin Brion' , array('bold' => true));

// $section->addText('Payroll Period : Aug 1-15 2015'  , array('bold' => true));
$table = $section->addTable();

$employee = $this->CustomEmployee->findEmployee($salary['employee_id'],array('Department','Position'));

$employee_name = $this->CustomText->getFullname($employee['Employee']);

$table->addRow();
$table->addCell(4500)->addText('Employee Name : '.$employee_name , array('bold' => true,'align'=>'left','size' => 8));
$table->addCell(4500)->addText('Code : '.$employee['Employee']['code'], array('bold' => true,'align'=>'right','size' => 8));
$table->addRow();
$table->addCell(4500)->addText('Payroll Period : '.$payrollDate , array('bold' => true,'align'=>'left','size' => 8));
$table->addCell(4500)->addText('Department : '.  ucwords($employee['Department']['name']) , array('bold' => true,'align'=>'right','size' => 8));
$table->addRow();
$table->addCell(4500)->addText('Days Work : '.$salary['days'] , array('bold' => true,'align'=>'left','size' => 8));
$table->addCell(4500)->addText('Position : '. ucwords($employee['Position']['name']) , array('bold' => true,'align'=>'right','size' => 8));


// Define table style arrays
$styleTable = array('borderSize'=>1, 'borderColor'=>'#000', 'cellMargin'=>80);
$styleFirstRow = array('borderBottomSize'=>1, 'borderBottomColor'=>'000', 'bgColor'=>'000');

// Define cell style arrays
$styleCell = array('valign'=>'center');
//$styleCellBTLR = array('valign'=>'center', 'textDirection' => PHPWord_Style_Cell::TEXT_DIR_BTLR);

// Define font style for first row
$fontStyle = array('bold'=>true, 'align'=>'center');

// Add table style
$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);

// Add table
$table = $section->addTable('myOwnTableStyle');

// Add row
$table->addRow();

// Add cells
$table->addCell(5000, $styleCell)->addText('Earnings',array('bold' => true));

$table->addCell(5000, $styleCell)->addText('Deductions', array('bold' => true));

$styleTable = array('borderSize'=>1, 'borderColor'=>'#000', 'cellMargin'=>80, 'align' => left);
$styleFirstRow = array('borderBottomSize'=>1, 'borderBottomColor'=>'000', 'bgColor'=>'000');

$PHPWord->addTableStyle('secondTable', $styleTable, $styleFirstRow);

$table = $section->addTable('secondTable');

//deductions 
$ca_fund = !empty($salary['ca_fund']) ? $salary['ca_fund'] : number_format(0,2);
$sss_loan = !empty($salary['sss_loan']) ? $salary['sss_loan'] : number_format(0,2);
$uniform = !empty($salary['uniform']) ? $salary['uniform'] : number_format(0,2);
$philhealth = !empty($salary['philhealth']) ? $salary['philhealth'] : 0;
$sss = !empty($salary['sss']) ? $salary['sss'] : 0;

//earnings 
$table->addRow();
$table->addCell(2500,$styleCell)
->addText('Regular Pay:');
$newTable = $table->addCell(2500,$styleCell)
->addText(number_format($salary['regular_work'],2));

//deduction
$table->addCell(2500,$styleCell)
->addText('Uniform:');
$newTable = $table->addCell(2500,$styleCell)
->addText(number_format($salary['uniform'],2));

$table->addRow();

//earnings 
$table->addCell(2500,$styleCell)
->addText('Regular OT:');
$newTable = $table->addCell(2500,$styleCell)
->addText(number_format($salary['regular_work_ot'],2));

$table->addCell(2500,$styleCell)
->addText('Penalty:');
$newTable = $table->addCell(2500,$styleCell)
->addText(number_format($salary['penalty'],2));

$table->addRow();
//earnings 
$table->addCell(2500,$styleCell)
->addText('LH:');
 $table->addCell(2500,$styleCell)
->addText(number_format($salary['regular_work_ot'],2));

$table->addCell(2500,$styleCell)
->addText('CA Fund');
$table->addCell(2500,$styleCell)
->addText(number_format($ca_fund,2));


$table->addRow();
//earnings 
$table->addCell(2500,$styleCell)
->addText('LH Work:');
$newTable = $table->addCell(2500,$styleCell)
->addText(number_format($salary['regular_holiday_work'],2));


$pagibig_loan = !empty($salary['pagibig_loan']) ? $salary['pagibig_loan'] : number_format(0,2);

$table->addCell(2500,$styleCell)
->addText('Pagibig Loan');
$table->addCell(2500,$styleCell)
->addText(number_format($pagibig_loan,2));


$table->addRow();

$table->addCell(2500,$styleCell)
->addText('LH OT:');
$newTable = $table->addCell(2500,$styleCell)
->addText(number_format($salary['regular_holiday_work_ot'],2));


$table->addCell(2500,$styleCell)
->addText('SSS Loan');
$newTable = $table->addCell(2500,$styleCell)
->addText(number_format($sss_loan,2));


$table->addRow();

$table->addCell(2500,$styleCell)
->addText('CTPA');
$newTable = $table->addCell(2500,$styleCell)
->addText(number_format($salary['ctpa'],2));

$table->addCell(2500,$styleCell)
->addText('TAXES',array('bold' => true));
$newTable = $table->addCell(2500,$styleCell)
->addText();


$table->addRow();

$table->addCell(2500,$styleCell)
->addText('SEA');
$newTable = $table->addCell(2500,$styleCell)
->addText(number_format($salary['sea'],2));

$table->addCell(2500,$styleCell)
->addText('SSS');
$newTable = $table->addCell(2500,$styleCell)
->addText(number_format($sss,2));

$table->addRow();

$table->addCell(2500,$styleCell)
->addText('Allowance');
$newTable = $table->addCell(2500,$styleCell)
->addText(number_format($salary['allowance'],2));


$table->addCell(2500,$styleCell)
->addText('PhilHealth');
$newTable = $table->addCell(2500,$styleCell)
->addText(number_format($philhealth,2));

$table->addRow();

$table->addCell(2500,$styleCell)
->addText('Gross Pay');
$newTable = $table->addCell(2500,$styleCell)
->addText(number_format($salary['gross_pay'],2));


$table->addCell(2500,$styleCell)
->addText('');
$newTable = $table->addCell(2500,$styleCell)
->addText('');

$styleTable = array('borderSize'=>1, 'borderColor'=>'#000', 'cellMargin'=>80,'align' => right);
$styleFirstRow = array('borderBottomSize'=>1, 'borderBottomColor'=>'000', 'bgColor'=>'000');

$PHPWord->addTableStyle('thirdtable', $styleTable, $styleFirstRow);


$styleTable = array('borderSize'=>1, 'borderColor'=>'#000', 'cellMargin'=>80);
$styleFirstRow = array('borderBottomSize'=>1, 'borderBottomColor'=>'000', 'bgColor'=>'000');

$PHPWord->addTableStyle('thirdtable', $styleTable, $styleFirstRow);

$table = $section->addTable('thirdtable');

$table->addRow();
$table->addCell(2500,$styleCell)->addText("TOTAL :",array('bold' => true));
$total_earnings = $salary['gross_pay'] + $salary['allowance'];
$table->addCell(2500,$styleCell)->addText(number_format($total_earnings,2), array('bold' => true));

$table->addCell(2500,$styleCell)->addText("TOTAL :",array('bold' => true));
$total_deduction = $salary['total_deduction'];
$table->addCell(2500,$styleCell)->addText(number_format($total_deduction,2), array('bold' => true));


$styleTable = array('borderSize'=>1, 'borderColor'=>'#000', 'cellMargin'=>80);
$styleFirstRow = array('borderBottomSize'=>1, 'borderBottomColor'=>'000', 'bgColor'=>'000');

$PHPWord->addTableStyle('fourthtable', $styleTable, $styleFirstRow);

$table = $section->addTable('fourthtable');

$table->addRow();
$table->addCell(5000,$styleCell)->addText("");
$table->addCell(2500,$styleCell)->addText("Net-Pay : ", array('bold' => true));
$table->addCell(2500,$styleCell)->addText( number_format($salary['total_pay'],2) , array('bold' => true));
// Add more rows / cells
// for($i = 1; $i <= 10; $i++) {
// 	$table->addRow();
// 	$table->addCell(2000)->addText("Cell $i");
// 	$table->addCell(2000)->addText("Cell $i");
// }

//$section->addPageBreak();
}

// Save File
// $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
// $objWriter->save('AdvancedTable.docx');


//prepare download
$filename = 'salaries-'.date('y-m-d').'-'.time().'.docx'; //just some random filename
//header('Content-Type: application/vnd.ms-office');
header('Content-Type: application/vnd.ms-office');

header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');  //downloadable file is in Excel 2003 format (.xls)
ob_end_clean();
$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
 
exit; //done.. exiting!


?>