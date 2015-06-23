<?php
// create new empty worksheet and set default font
$this->PhpExcel->createWorksheet()
    ->setDefaultFont('Calibri', 12);

$objTpl = PHPExcel_IOFactory::load("./img/template.xlsx");

// add data
    $counter = 10;
    foreach ($invoiceData as $key => $invoiceList) {
        $phpPrice = '';
        $usdPrice = '';
        if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {
            $phpPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);
        } else {
            $usdPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);
        }

        //$this->PhpExcel->addTableRow(array(
        //date('m/d/Y', strtotime($invoiceList['SalesInvoice']['created'])),
        //$invoiceList['SalesInvoice']['dr_uuid'],
        //$usdPrice,
        //$phpPrice,
        //$companyData[$invoiceList['SalesInvoice']['company_id']],
        //$invoiceList['SalesInvoice']['quantity'],
        //$invoiceList['SalesInvoice']['sales_invoice_no'],
        //$invoiceList['SalesInvoice']['statement_no'],
        //' '
        //));

        $objTpl->setActiveSheetIndex(0)
                    ->setCellValue('B'.$counter, date('m/d/Y', strtotime($invoiceList['SalesInvoice']['created'])))
                    ->setCellValue('D'.$counter, $invoiceList['SalesInvoice']['dr_uuid'])
                    ->setCellValue('F'.$counter, $usdPrice)
                    ->setCellValue('G'.$counter, $phpPrice)
                    ->setCellValue('I'.$counter, $companyData[$invoiceList['SalesInvoice']['company_id']])
                    ->setCellValue('K'.$counter, $invoiceList['SalesInvoice']['quantity'])
                    ->setCellValue('L'.$counter, $invoiceList['SalesInvoice']['sales_invoice_no'])
                    ->setCellValue('M'.$counter, $invoiceList['SalesInvoice']['statement_no']);

     $counter++;  
    }
 
// close table and output
// $this->PhpExcel->addTableFooter()
//     ->output('dsfsd.xlsx');

//prepare download
$filename = mt_rand(1,100000).'.xlsx'; //just some random filename
header('Content-Type: application/vnd.ms-office');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
 
exit; //done.. exiting!

?>