<?php 

// New Word Document
$PHPWord = new PHPWord();

// New portrait section

// Add header



$startKey = 1;	
foreach ($salaries as $key => $salary) :


//regular hours
$total_hours = 0;

$hours_regular = !empty($salary['hours_regular']) ? $salary['hours_regular'] : 0;

$hours_ot = !empty($Salary['hours_ot']) ? $salary['hours_ot'] : 0;

$hours_sunday_work = !empty($salary['hours_sunday_work']) ? $salary['hours_sunday_work'] : 0;

$hours_sunday_work_ot = !empty($salary['hours_sunday_work_ot']) ? $salary['hours_sunday_work_ot'] : 0;

$hours_legal_holiday_work = !empty($salary['hours_legal_holiday_work']) ? $salary['hours_legal_holiday_work'] : 0;


$hours_legal_holiday_work_ot = !empty($salary['hours_legal_holiday_work_ot']) ? $salary['hours_legal_holiday_work_ot'] : 0;


$hours_legal_holiday_sunday_work = !empty($salary['hours_legal_holiday_sunday_work']) ? $salary['hours_legal_holiday_sunday_work'] : 0;


$hours_legal_holiday_sunday_work_ot = !empty($salary['hours_legal_holiday_sunday_work_ot']) ? $salary['hours_legal_holiday_sunday_work_ot'] : 0;



$hours_special_holiday_work  = !empty($salary['hours_special_holiday_work ']) ? $salary['hours_special_holiday_work '] : 0;

$hours_special_holiday_work_ot  = !empty($salary['hours_special_holiday_work_ot ']) ? $salary['hours_special_holiday_work_ot '] : 0;


$regular  = !empty($salary['regular']) ? $salary['regular'] : 0;


$sectionSettings = array(
'orientation' => 'portrait',
'marginTop' => 150,
'marginLeft' => 150,
'marginRight' => 150,
'marginBottom ' => 0,
// 'colsNum' => 2,
'pageSizeW' => '4500',
'pageSizeH' => '8000',

);
$section = $PHPWord->createSection($sectionSettings);

// Define table style arrays
$styleTable = array('cellMargin'=>10);
//$styleFirstRow = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'66BBFF');
$styleFirstRow = array();

// Define cell style arrays
$styleCell = array('valign'=>'center','height' => '50','space' => array('line' => 1000),'border' => 0);
$styleCellBTLR = array('valign'=>'center', 'textDirection'=>PHPWord_Style_Cell::TEXT_DIR_BTLR);

// Define font style for first row
$fontStyle = array('bold'=>true, 'align'=>'center','size' => 6);

// Add table style
$PHPWord->addTableStyle('myOwnTableStyleDetail', $styleTable, $styleFirstRow);

$table = $section->addTable('myOwnTableStyleDetail');
$table->addRow();
$table->addCell(4500)->addImage('./img/koufu_logo.jpg', array('width'=>70, 'height'=>20, 'align'=>'left'));

$right_header = $table->addCell(4500);
$right_header->addText('Lot 4-5 Blk 3 Ph2 Mountview Industrial Complex Brgy. Bancal Carmona Cavite',array('size' => 5),array('valign' => 'center','spaceAfter'=>0,'lineHeight'=>1.0));
$right_header->addText('Tel: +632-5844928; +6346-4301576 Fax: +632-5844952
',array('size' => 5),array('valign' => 'center','spaceAfter'=>1.5,'lineHeight'=>3));

// Define table style arrays
$styleTable = array( 'cellMargin'=>10);
//$styleFirstRow = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'66BBFF');
$styleFirstRow = array();

// Define cell style arrays
$styleCell = array('valign'=>'center','height' => '50','space' => array('line' => 1000),'border' => 0);
$styleCellBTLR = array('valign'=>'center', 'textDirection'=>PHPWord_Style_Cell::TEXT_DIR_BTLR);

// Define font style for first row
$fontStyle = array('bold'=>true, 'align'=>'center','size' => 6);

// Add table style
$PHPWord->addTableStyle('myOwnTableStyleDetail', $styleTable, $styleFirstRow);

// Add table
$table = $section->addTable('myOwnTableStyleDetail');


// Add row
$table->addRow(40);

$fontStyle=  array('bold'=>true,'color' => '#0000','size' => 6);

// Add cells
$paragraphStyle = array('valign' => 'center','spaceAfter'=>0,'lineHeight'=>1.0);
$detail = $table->addCell(4500);			
$detail->addText('Name: '.$salary['Employee']['full_name'],$fontStyle,$paragraphStyle);
$detail->addText('Period: '.$payrollDate,$fontStyle,$paragraphStyle);

$right_detail = $table->addCell(4500);			
$right_detail->addText('Emp #: '.$salary['Employee']['code'],$fontStyle,$paragraphStyle);
$right_detail->addText('Department : '. ucwords($salary['Department']['description']), $fontStyle,$paragraphStyle);
$right_detail->addText('Position : '.$salary['Position']['name'],$fontStyle,$paragraphStyle);
// Add row

// Define table style arrays
$styleTable = array('borderSize' => 6, 'borderColor'=>'000000', 'cellMargin'=>10);
//$styleFirstRow = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'66BBFF');
$styleFirstRow = array( 'borderBottomColor'=>'000000');

// Define cell style arrays
$styleCell = array('valign'=>'center','height' => '50','space' => array('line' => 1000),'border' => 0);
$styleCellBTLR = array('valign'=>'center', 'textDirection'=>PHPWord_Style_Cell::TEXT_DIR_BTLR);

// Define font style for first row
$fontStyle = array('bold'=>true, 'align'=>'center','size' => 6);

// Add table style
$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);

// Add table
$table = $section->addTable('myOwnTableStyle');
 
$table->addRow(70);

$fontStyleBold =  array('bold'=>true, 'align'=>'center','color' => '#0000','size' => 6);
// Add cells
$paragraphStyle = array('align' => 'center','valign' => 'center','spaceAfter'=>0,'lineHeight'=>1.0);

$table->addCell(2000,$styleCell)->addText('Earnings', $fontStyleBold);
$table->addCell(1000)->addText('Hours', $fontStyle,$paragraphStyle);
$table->addCell(1000)->addText('Amount', $fontStyle,$paragraphStyle);
$table->addCell(2000)->addText('Deductions', $fontStyleBold);
$table->addCell(1000)->addText('Amount', $fontStyle,$paragraphStyle);

$table->addRow(70);

$days = $salary['hours_regular'] / 8;

$sdays = $salary['sunday_days'] / 8;

$fontStyle = array('align'=>'left','size' => 6,'align'=>'center');
$paragraphStyle = array('valign' => 'center','spaceAfter'=>0,'lineHeight'=>1.8);

$earnings = $table->addCell(2000);
$earnings->addText("Basic Pay (Days:". number_format($days,2) .")",$fontStyle,$paragraphStyle);
$earnings->addText("OT",$fontStyle,$paragraphStyle);
$earnings->addText("Sun",$fontStyle,$paragraphStyle);
$earnings->addText("Sun OT",$fontStyle,$paragraphStyle);
$earnings->addText("LH",$fontStyle,$paragraphStyle);
$earnings->addText("LH WORK",$fontStyle,$paragraphStyle);
$earnings->addText("LH OT",$fontStyle,$paragraphStyle);
$earnings->addText("LH Sunday Work",$fontStyle,$paragraphStyle);
$earnings->addText("LH Sunday OT",$fontStyle,$paragraphStyle);
$earnings->addText("SH",$fontStyle,$paragraphStyle);
$earnings->addText("SH Work",$fontStyle,$paragraphStyle);
$earnings->addText("SH OT",$fontStyle,$paragraphStyle);
$earnings->addText("Night Diff",$fontStyle,$paragraphStyle);
$earnings->addText("ND OT",$fontStyle,$paragraphStyle);
$earnings->addText("SUN ND",$fontStyle,$paragraphStyle);
$earnings->addText("SUN ND OT",$fontStyle,$paragraphStyle);
$earnings->addText("Vacation Leave",$fontStyle,$paragraphStyle);
$earnings->addText("CTPA + SEA",$fontStyle,$paragraphStyle);
$earnings->addText("SUN CTPA + SEA (days: ".number_format($sdays,2).")",$fontStyle,$paragraphStyle);


$earnings->addText("Adjustments",array('bold'=>true, 'align' => 'center','color' => '#0000','size' => 6),$paragraphStyle);
$earnings->addText("Allowances",$fontStyle,$paragraphStyle);
$earnings->addText("Adjustment",$fontStyle,$paragraphStyle);

$hours = $table->addCell(1000);
$hours->addText($hours_regular,$fontStyle,$paragraphStyle); $total_hours += $hours_regular;
$hours->addText('',$fontStyle,$paragraphStyle);
$hours->addText($hours_ot,$fontStyle,$paragraphStyle); $total_hours += $hours_ot;
$hours->addText($hours_sunday_work,$fontStyle,$paragraphStyle); $total_hours += $hours_sunday_work;
$hours->addText($hours_sunday_work_ot,$fontStyle,$paragraphStyle); $total_hours += $hours_sunday_work_ot;
$hours->addText('',$fontStyle,$paragraphStyle);
$hours->addText($hours_legal_holiday_work ,$fontStyle,$paragraphStyle);  $total_hours += $hours_legal_holiday_work;

$hours->addText($hours_legal_holiday_sunday_work_ot ,$fontStyle,$paragraphStyle); $total_hours += $hours_legal_holiday_sunday_work_ot;

$hours->addText($hours_special_holiday_work ,$fontStyle,$paragraphStyle);  $total_hours += $hours_special_holiday_work;

$hours->addText($hours_special_holiday_work_ot ,$fontStyle,$paragraphStyle); $total_hours += $hours_special_holiday_work_ot;

$hoursNightDiff = !empty($salary['hours_night_diff']) ? $salary['night_diff'] : '0'; $total_hours += $hoursNightDiff;

$hours->addText( $hoursNightDiff ,$fontStyle, $paragraphStyle); 

$HoursSundayNightDiff = !empty($salary['hours_sunday_night_diff']) ? $salary['sunday_night_diff'] : '0';  

$total_hours += $HoursSundayNightDiff;

$hours->addText( $HoursSundayNightDiff ,$fontStyle, $paragraphStyle);

$HoursSundayNightDiffOt = !empty($salary['hours_sunday_night_diff_ot']) ? $salary['sunday_night_diff_ot'] : '0';

$total_hours += $HoursSundayNightDiffOt;

$hours->addText( $HoursSundayNightDiffOt ,$fontStyle, $paragraphStyle);


$HoursLeave = !empty($salary['hours_leave']) ? $salary['hours_leave'] : '0';

$total_hours += $HoursLeave;

$hours->addText( $HoursLeave ,$fontStyle, $paragraphStyle);

$hours->addText( '' ,$fontStyle, $paragraphStyle);
$hours->addText( '' ,$fontStyle, $paragraphStyle);


$amount = $table->addCell(1000);
$amount->addText(number_format($regular,2),$fontStyle,$paragraphStyle);
$amount->addText('',$fontStyle,$paragraphStyle);
$amount->addText(number_format($salary['OT'],2),$fontStyle,$paragraphStyle);

$sunday_work = !empty($salary['sunday_work']) ? $salary['sunday_work'] : 0;
$amount->addText(number_format($sunday_work,2),$fontStyle,$paragraphStyle);


$sunday_work_ot = !empty($salary['sunday_work_ot']) ? $salary['sunday_work_ot'] : 0;
$amount->addText(number_format($sunday_work_ot,2),$fontStyle,$paragraphStyle);

$legal_holiday = !empty($salary['legal_holiday']) ? $salary['legal_holiday'] : 0;
$amount->addText(number_format($legal_holiday,2),$fontStyle,$paragraphStyle);

$legal_holiday_work = !empty($salary['legal_holiday_work']) ? $salary['legal_holiday_work'] : 0;
$amount->addText(number_format($legal_holiday_work,2),$fontStyle,$paragraphStyle);

$legal_holiday_work_ot = !empty($salary['legal_holiday_work_ot']) ? $salary['legal_holiday_work_ot'] : 0;
$amount->addText(number_format($legal_holiday_work_ot,2),$fontStyle,$paragraphStyle);


$legal_holiday_sunday_work = !empty($salary['legal_holiday_sunday_work']) ? $salary['legal_holiday_sunday_work'] : 0;
$amount->addText(number_format($legal_holiday_sunday_work,2),$fontStyle,$paragraphStyle);

$legal_holiday_sunday_work_ot = !empty($salary['legal_holiday_sunday_work_ot']) ? $salary['legal_holiday_sunday_work_ot'] : 0;
$amount->addText(number_format($legal_holiday_sunday_work_ot,2),$fontStyle,$paragraphStyle);

$special_holiday = !empty($salary['special_holiday']) ? $salary['special_holiday'] : 0;
$amount->addText(number_format($special_holiday,2),$fontStyle,$paragraphStyle);


$special_holiday_work = !empty($salary['special_holiday_work']) ? $salary['special_holiday_work'] : 0;
$amount->addText(number_format($special_holiday_work,2),$fontStyle,$paragraphStyle);


$special_holiday_work_ot = !empty($salary['special_holiday_work_ot']) ? $salary['special_holiday_work_ot'] : 0;
$amount->addText(number_format($special_holiday_work_ot,2),$fontStyle,$paragraphStyle);


$night_diff = !empty($salary['night_diff']) ? $salary['night_diff'] : 0;
$amount->addText(number_format($night_diff,2),$fontStyle,$paragraphStyle);


$night_diff_ot = !empty($salary['night_diff_ot']) ? $salary['night_diff_ot'] : 0;
$amount->addText(number_format($night_diff_ot,2),$fontStyle,$paragraphStyle);

$sunday_work_night_diff = !empty($salary['sunday_work_night_diff']) ? $salary['sunday_work_night_diff'] : 0;
$amount->addText(number_format($sunday_work_night_diff,2),$fontStyle,$paragraphStyle);

$sunday_work_night_diff_ot = !empty($salary['sunday_work_night_diff']) ? $salary['sunday_work_night_diff'] : 0;
$amount->addText(number_format($sunday_night_diff,2),$fontStyle,$paragraphStyle);

$leave = !empty($salary['sunday_work_night_diff']) ? $salary['sunday_work_night_diff'] : 0;
$amount->addText(number_format($leave,2),$fontStyle,$paragraphStyle);

//$leave = !empty($salary['sunday_work_night_diff']) ? $salary['sunday_work_night_diff'] : 0;
$ctpa_sea = !empty($salary['ctpa']) ? $salary['ctpa'] : 0;
$ctpa_sea .= !empty($salary['sea']) ? $salary['sea'] : 0;

$amount->addText(number_format($ctpa_sea,2),$fontStyle,$paragraphStyle);

//sunday ctpa & sea
$ctpa_sea = !empty($salary['sunday_ctpa']) ? $salary['sunday_ctpa'] : 0;
$ctpa_sea .= !empty($salary['sunday_sea']) ? $salary['sunday_sea'] : 0;

$amount->addText(number_format($ctpa_sea,2),$fontStyle,$paragraphStyle);

//ADJUSTMENTS

$amount->addText('',$fontStyle,$paragraphStyle);

$allowances = empty($salary['allowances']) ? $salary['allowances'] : 0;
$amount->addText($allowances,$fontStyle,$paragraphStyle);

$adjustments = empty($salary['adjustment']) ? $salary['adjustment'] : 0;
$amount->addText($adjustments,$fontStyle,$paragraphStyle);


// $table->addCell(2000,$styleCell)->addText('Earnings', $fontStyleBold);
// $table->addCell(1000)->addText('Hours', $fontStyle,$paragraphStyle);
// $table->addCell(1000)->addText('Amount', $fontStyle,$paragraphStyle);
// $table->addCell(2000)->addText('Deductions', $fontStyleBold);
// $table->addCell(1000)->addText('Amount', $fontStyle,$paragraphStyle);


$deduct = $table->addCell(2000);

$deductAmounts = $table->addCell(2000);

$total_deductions = 0;

foreach ($deductions as $deduction_key => $list) {

	$deduct->addText($list['Loan']['name'],$fontStyle,$paragraphStyle);
	
	$index = str_replace(' ','_',strtolower($list['Loan']['name']));
	$amount = !empty($salary[$index]) ? number_format($salary[$index],2) : '0.00';
	$total_deductions += $amount;
	$deductAmounts->addText($amount,$fontStyle,$paragraphStyle);
}

$deduct->addText('Gov Deductions',array('bold' => true,'size' => 6),$paragraphStyle);

$sss = !empty($salary['sss']) && is_int($salary['sss'])  ? number_format($salary['sss'],2) : '0.00'; 
$philhealth = !empty($salary['philhealth'])  ? number_format($salary['philhealth'],2) : '0.00';
$pagibig = !empty($salary['pagibig'])  ? number_format($salary['pagibig'],2) : '0.00'; 
$wtax = !empty($salary['with_holding_tax'])  ? number_format($salary['with_holding_tax'],2) : '0.00';

$deduct->addText('SSS',$fontStyle,$paragraphStyle);
$deduct->addText('PhilHealth',$fontStyle,$paragraphStyle);
$deduct->addText('Pag-ibig',$fontStyle,$paragraphStyle);
$deduct->addText('WTax',$fontStyle,$paragraphStyle);

//deduct amount

// $deductAmounts->addText($total_deductions,$fontStyle,$paragraphStyle);

$deductAmounts->addText('',$fontStyle,$paragraphStyle);
$deductAmounts->addText($sss,$fontStyle,$paragraphStyle);
$deductAmounts->addText($philhealth,$fontStyle,$paragraphStyle);
$deductAmounts->addText($pagibig,$fontStyle,$paragraphStyle);
$deductAmounts->addText($wtax,$fontStyle,$paragraphStyle);



// $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
// $objWriter->save('AdvancedTable.docx');


//totals
// Define table style arrays
$styleTable = array('borderSize'=>6, 'borderColor'=>'000000', 'cellMargin'=>10);
//$styleFirstRow = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'66BBFF');
$styleFirstRow = array( 'borderBottomColor'=>'000000');

// Define cell style arrays
$styleCell = array('valign'=>'center','height' => '50','space' => array('line' => 1000),'border' => 0);
$styleCellBTLR = array('valign'=>'center', 'textDirection'=>PHPWord_Style_Cell::TEXT_DIR_BTLR);

// Define font style for first row
$fontStyle = array('bold'=>true, 'align'=>'center','size' => 6);

// Add table style
$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);

// Add table
$table = $section->addTable('myOwnTableStyle');

			
$table->addRow(70);

$fontStyleBold =  array('bold'=>true, 'align'=>'center','color' => '#0000','size' => 6);
// Add cells
$paragraphStyle = array('align' => 'center','valign' => 'center');

$table->addCell(2000,$styleCell)->addText('Total', $fontStyleBold);
$table->addCell(1000)->addText($total_hours, $fontStyle,$paragraphStyle);
$table->addCell(1000)->addText( number_format($salary['total_earnings'],2) , $fontStyle,$paragraphStyle);


$table->addCell(2000,$styleCell)->addText('Deductions', $fontStyleBold);
$table->addCell(1000)->addText(number_format($salary['total_deduction'],2), $fontStyle,$paragraphStyle);

// Add table
$table = $section->addTable('myOwnTableStyle');

			
$table->addRow(70);
$fontStyleBold =  array('bold'=>true, 'align'=>'center','color' => '#0000','size' => 6);
// Add cells
$paragraphStyle = array('align' => 'center','valign' => 'center');

$table->addCell(2000,$styleCell)->addText('Total Net Pay:' , $fontStyleBold);
$table->addCell(1000)->addText('', $fontStyle,$paragraphStyle);
$table->addCell(1000)->addText('', $fontStyle,$paragraphStyle);
$table->addCell(2000,$styleCell)->addText('', $fontStyleBold);
$table->addCell(1000)->addText(number_format($salary['total_pay'],2),$fontStyleBold,$paragraphStyle);


endforeach;
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