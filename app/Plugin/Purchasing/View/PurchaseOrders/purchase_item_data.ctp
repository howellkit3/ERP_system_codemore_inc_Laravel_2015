<?php
	ob_start();
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/purchased_item.xlsx");

	$sheet = $objTpl->setActiveSheetIndex(0);

	$start = 7;

	// foreach ($requestItemData  as $key => $list) { 

	// 		$sheet->setCellValue('A'.$start,  $list[$modelTable]['name'] );

	// 		if(!empty($currencyData[$list[$modelTable]['unit_price_unit_id']])){
	// 			$sheet->setCellValue('B'.$start,  $supplierData[$list['PurchaseOrder']['supplier_id']] );
	// 		}

	// 		$sheet->setCellValue('C'.$start,  $list[$modelTable]['pieces'] );


	// 		$sheet->setCellValue('D'.$start,  $list[$modelTable]['unit_price'] );

	// 		if(!empty($currencyData[$list[$modelTable]['unit_price_unit_id']])) {
			
	// 		$sheet->setCellValue('E'.$start,  $currencyData[$list[$modelTable]['unit_price_unit_id']]  . " " .  $list[$modelTable]['unit_price'] * $list[$modelTable]['pieces'] );
			
	// 		}

	// 		$start++;
	    
	//   } 
	  // prepare download
    $filename = 'purchase'.mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    ob_end_clean();
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!

    exit; //done.. exiting!