<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/jobticket.xlsx");

    $objTpl->setActiveSheetIndex(0)
                        ->setCellValue('C5', 'Date : '.(new \DateTime())->format('l, F d, Y '))
                        ->setCellValue('B6', strtoupper($companyData[$productData['Product']['company_id']]))
                        ->setCellValue('C6', 'Schedule No : '.$ticketUuid)
                        ->setCellValue('B7', $productData['Product']['name'])
                        ->setCellValue('C7', 'PO No : '.$ticketData['JobTicket']['po_number'])
                        ->setCellValue('B8', $specs['ProductSpecification']['size1'].' x '.$specs['ProductSpecification']['size2'].' x '.$specs['ProductSpecification']['size3'])
                        ->setCellValue('C8', 'Delivery Date : '.date('M d, Y', strtotime($delData['ClientOrderDeliverySchedule'][0]['schedule'])))
                        ->setCellValue('B9', $specs['ProductSpecification']['quantity'].' '.$unitData[$specs['ProductSpecification']['quantity_unit_id']])
                        ->setCellValue('C9', 'Stock Qty : '.$specs['ProductSpecification']['stock']);
   	$addRow = 0;
    foreach ($formatDataSpecs as $key => $specLists) { 

    	if($specLists['ProductSpecificationDetail']['model'] == 'Component'){
    		$addRow = $key + 1;
    	}
    	if($specLists['ProductSpecificationDetail']['model'] == 'Part'){
    		$addRow = $key + 3;
    	}
    	if($specLists['ProductSpecificationDetail']['model'] == 'Process'){
    		$processRow = 0 ;
    		foreach ($specLists['ProductSpecificationProcess']['ProcessHolder'] as $key1 => $processList) {
    			$processRow = $key1 + 1;
    		}
    		$addRow = $addRow + $processRow;
    	}
    	
    }
    $objTpl->setActiveSheetIndex(0)->insertNewRowBefore(12,$addRow);
    $counter = 10;
    $componentCounter = 1 ;
	$partCounter = 1 ;
	$processCounter = 1 ;
    foreach ($formatDataSpecs as $key => $specLists) { 

    	if($specLists['ProductSpecificationDetail']['model'] == 'Component'){

    		$objTpl->setActiveSheetIndex(0)
                        ->setCellValue('A'.$counter, 'Component'.' '.$componentCounter)
                        ->setCellValue('B'.$counter, $specLists['ProductSpecificationComponent']['name']);
            $componentCounter++;    

    	}

    	if($specLists['ProductSpecificationDetail']['model'] == 'Part'){

    		$outs = floatval($specLists['ProductSpecificationPart']['outs1']) * floatval($specLists['ProductSpecificationPart']['outs2']);
    		$count1 = $counter + 1;
    		$count2 = $count1 + 1;
    		$objTpl->setActiveSheetIndex(0)
                        ->setCellValue('A'.$counter, 'C'.' '.$partCounter.' '.'-Part'.$partCounter)
                        ->setCellValue('B'.$counter, $specLists['ProductSpecificationPart']['material'])
                        ->setCellValue('C'.$counter, $specLists['ProductSpecificationPart']['quantity'])
                        ->setCellValue('C'.$count1, $specLists['ProductSpecificationPart']['material'].' >> '.$specLists['ProductSpecificationPart']['color'])
                        ->setCellValue('C'.$count2, $specLists['ProductSpecificationPart']['size1'].' x '.$specLists['ProductSpecificationPart']['size2'].' >> '.$outs.' Outs >> '.$specLists['ProductSpecificationPart']['paper_quantity'].' + '.$specs['ProductSpecification']['stock'].' '.$unitData[$specLists['ProductSpecificationPart']['quantity_unit_id']]);
            $partCounter++; 

    	}

    	if($specLists['ProductSpecificationDetail']['model'] == 'Process'){
    		$processRow = 0 ;
    		$counter1 = 0 ; 
    		foreach ($specLists['ProductSpecificationProcess']['ProcessHolder'] as $key1 => $processList) {

    			$counterrow = $counter1 + $counter + 2;
    			$objTpl->setActiveSheetIndex(0)
                        ->setCellValue('A'.$counterrow, '>>PP'.' '.$key1++)
                        ->setCellValue('B'.$counterrow, $subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']]);
            	$componentCounter++; 
            	
    			$counter1++;

    		}
    		$processCounter++;
    	}
    	$counter++;
    }
    
    //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!
?>