<?php
	ob_start();
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/purchased_item.xlsx");

	$sheet = $objTpl->setActiveSheetIndex(0);

	//$start = 6;

	// $sheet->setCellValue('A'.$start,'now' );

	 // foreach ($requestItemData  as $key => $list) { 

		// 	$sheet->setCellValue('A'.$start,  $list[$modelTable]['name'] );

		
		// 	if (!empty($list['PurchaseOrder']['supplier_id'])) {

		// 		if (is_numeric($list['PurchaseOrder']['supplier_id'])) {
		// 			$sheet->setCellValue('B'.$start,  $supplierData[$list['PurchaseOrder']['supplier_id']] );
		// 		} else {
		// 			$sheet->setCellValue('B'.$start,$list['PurchaseOrder']['supplier_id']);
		// 		}
		// 		//pr($supplierData[$list['PurchaseOrder']['supplier_id']]);
				
		// 	}

		// 	$sheet->setCellValue('C'.$start,  $list[$modelTable]['pieces'] );


		// 	$sheet->setCellValue('D'.$start,  $list[$modelTable]['unit_price'] );

		// 	//if(!empty($currencyData[$list[$modelTable]['unit_price_unit_id']])) {
			
		// 	$sheet->setCellValue('E'.$start, $list[$modelTable]['unit_price'] * $list[$modelTable]['pieces'] );
			
		// 	//}

		// 	if (!empty($list['PurchaseOrder']['created'])) {
		// 		$sheet->setCellValue('F'.$start,  date('Y/m/d',strtotime($list['PurchaseOrder']['created'])) );

		// 	}
			
		// 	$start++;
	    
	 //  } 
	  // prepare download
    $filename = 'purchase_item-'.mt_rand(1,100000).'.xlsx';
    
    ob_end_clean();
     //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!
?>