<?php
	
	Configure::write('debug',2);

    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/purchased_item_updated.xls");

    $unitPrice = 0;

    $quantity = 0;
 	
 	$totalQty = 0;

	$vatSale = '';

	$sheet = $objTpl->setActiveSheetIndex(0);

	$start = 7;

	foreach ($requestItemData  as $key => $list) { 

			$sheet->setCellValue('A'.$start,  $list[$modelTable]['name'] );

			if(!empty($currencyData[$list[$modelTable]['unit_price_unit_id']])){
				$sheet->setCellValue('B'.$start,  $supplierData[$list['PurchaseOrder']['supplier_id']] );
			}

			$sheet->setCellValue('C'.$start,  $list[$modelTable]['pieces'] );


			$sheet->setCellValue('D'.$start,  $list[$modelTable]['unit_price'] );

			if(!empty($currencyData[$list[$modelTable]['unit_price_unit_id']])) {
			
			$sheet->setCellValue('E'.$start,  $currencyData[$list[$modelTable]['unit_price_unit_id']]  . " " .  $list[$modelTable]['unit_price'] * $list[$modelTable]['pieces'] );
			
			}

			$start++;
	    
	  } 

	  // prepare download
    $filename = 'purchase-item-report-'.mt_rand(1,100000).'.xls'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!