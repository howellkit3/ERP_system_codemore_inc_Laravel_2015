<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);


    if (in_array($customerID,array('1223','3','4','5','6','60','102'))) {

    	$objTpl = PHPExcel_IOFactory::load("./img/apc_list_invoice.xlsx");

    } else {
    	$objTpl = PHPExcel_IOFactory::load("./img/pre_invoice.xlsx");

    }

    
    $unitPrice = 0;

    $quantity = 0;
 	
 	$totalQty = 0;

	$vatSale = '';

	 $sheet = $objTpl->setActiveSheetIndex(0);

	 $start = 6;

	 $sheet->setCellValue('B2',$date);

	 foreach ($deliveries as $key => $list) {

	 	if (!empty($list['Delivery'])) {
	 			foreach ($list['Delivery'] as $InnerKey => $value) {

	 				pr($value);
	 			$total_amount = 0;			
			 	$sheet->setCellValue('A'.$start, $list['SalesInvoice']['sales_invoice_no']);

			 	$invoiceDate = !empty($list['SalesInvoice']['invoice_date']) ? $list['SalesInvoice']['invoice_date'] :  $list['SalesInvoice']['created'];

			 	$sheet->setCellValue('B'.$start, date('Y/m/d',strtotime($invoiceDate)));

			 	pr($value);
			 	if (!empty($value['ClientOrder']['company_id'])) {

			 		$sheet->setCellValue('C'.$start,$companyName[$value['ClientOrder']['company_id']]);

			 	} else {
			 		$sheet->setCellValue('C'.$start, $value['Company']['company_name']);

			 	}
			 	
			 	$sheet->setCellValue('D'.$start, $value['ClientOrder']['po_number']);

			 	$sheet->setCellValue('E'.$start, $value['Product']['name']);

			 	$sheet->setCellValue('F'.$start, $value['DeliveryDetail']['quantity']);


			 	$sheet->setCellValue('G'.$start, $value['QuotationItemDetail']['unit_price']);	

			 	$total_amount = $value['DeliveryDetail']['quantity'] *  $value['QuotationItemDetail']['unit_price'];

			 	$sheet->setCellValue('H'.$start, number_format($total_amount,2));

			 	
			 	if (in_array($customerID,array('1223','3','4','5','6','60','102'))) {

			 		if (!empty($deliveries['DeliveryDetail']['remarks'])) {
			 			
			 		$sheet->setCellValue('J'.$start, $list['SalesInvoice']['apc_dr']);

			 		} else {


			 		$sheet->setCellValue('J'.$start, $list['SalesInvoice']['apc_dr']);
	
			 		}
			 		if (!empty($deliveries['DeliveryDetail']['plant_id'])) {

			 			$sheet->setCellValue('K'.$start, $plants[$deliveries['DeliveryDetailv']['plant_id']]);
			 		} else {

			 			if (!empty($list['SalesInvoice']['plant_id'])) {

			 				$sheet->setCellValue('K'.$start, $plants[$list['SalesInvoice']['plant_id']]);
			 			}
			 		}
			 		
			 	
			 	}


			 	$start++;
	 			}
	 	}
	 	
	 


	 	//$sheet->setCellValue('B'.$start, date('Y/m/d',strtotime($invoiceDate)));
	 	
	 	
	 }


	  // prepare download
    $filename = 'sa-'.date('Ymd').mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!
?>