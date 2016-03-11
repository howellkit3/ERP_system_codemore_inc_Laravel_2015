<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/pre_invoice.xlsx");

    $unitPrice = 0;

    $quantity = 0;
 	
 	$totalQty = 0;

	$vatSale = '';

	 $sheet = $objTpl->setActiveSheetIndex(0);

	 $start = 6;

	 foreach ($deliveries as $key => $list) {


	 	if (!empty($list['Delivery'])) {
	 			foreach ($list['Delivery'] as $InnerKey => $value) {
	 			$total_amount = 0;			
			 	$sheet->setCellValue('A'.$start, $list['SalesInvoice']['sales_invoice_no']);

			 	$invoiceDate = !empty($list['SalesInvoice']['invoice_date']) ? $list['SalesInvoice']['invoice_date'] :  $list['SalesInvoice']['created'];

			 	$sheet->setCellValue('B'.$start, date('Y/m/d',strtotime($invoiceDate)));

			 	$sheet->setCellValue('C'.$start, $value['Company']['company_name']);

			 	$sheet->setCellValue('D'.$start, $value['ClientOrder']['po_number']);

			 	$sheet->setCellValue('E'.$start, $value['Product']['name']);

			 	$sheet->setCellValue('F'.$start, $value['DeliveryDetail']['quantity']);


			 	$sheet->setCellValue('G'.$start, $value['QuotationItemDetail']['unit_price']);	

			 	$total_amount = $value['DeliveryDetail']['quantity'] *  $value['QuotationItemDetail']['unit_price'];

			 	$sheet->setCellValue('H'.$start, number_format($total_amount,2));

			 	$sheet->setCellValue('I'.$start, $value['Delivery']['dr_uuid']);


			 	$start++;
	 			}
	 	}
	 	
	 


	 	//$sheet->setCellValue('B'.$start, date('Y/m/d',strtotime($invoiceDate)));
	 	
	 	
	 }


	  // prepare download
    $filename = 'pre_invoice-'.mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!
?>