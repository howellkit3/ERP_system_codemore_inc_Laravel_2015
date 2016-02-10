<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/delivery_template.xls");
     
    // add data

    // pr($measureList); exit;
     $counter = 10;
        
    $po = 9;

    $odd = array( '0' => '9','1'=>'11','2'=>'13', '3'=>'15');

    $even = array( '0' => '10','1'=>'12','2'=>'14', '3'=>'16');

    $sheet =  $objTpl->setActiveSheetIndex(0);

   
    $toBePrinted = date("M/d/Y");


   foreach ($toPrint as $key => $print) {


       # code...
   
        // $phpPrice = '';
        // $usdPrice = '';
        // $totalQty = $print['ClientOrder']['QuotationItemDetail']['quantity'] * $print['DeliveryDetail']['quantity'];
         $dividend = 0;
         if ($print['DeliveryDetail']['quantity'] > 0) {
              $dividend = $print['DeliveryDetail']['quantity'] / $print['DeliveryDetail']['pieces'];
           
         }
       
         $difference = $print['DeliveryDetail']['quantity'] - (floor($dividend) * $print['DeliveryDetail']['pieces']);
         $preparedFName = ucwords($prepared['User']['first_name']) ;
         $preparedLName = ucwords($prepared['User']['last_name'])  ;
         $approvedFName = ucwords($approved['User']['first_name'])  ;
         $approvedLName = ucwords($approved['User']['last_name'])  ;
          
        // $quantity = $drData['DeliveryDetail']['quantity'];
         $remarks = $print['DeliveryDetail']['remarks'];
       
        // if(!empty($drQuantity)){

        //     $quantity = $drQuantity;

        //     if(!empty($drRemarks)){

        //         $remarks = $drRemarks;

        //     }else{

        //         $remarks = " ";

        //     }               
        // }

            $productName = !empty($print['ClientOrder']['Product']['name']) ? $print['ClientOrder']['Product']['name'] : '';
            $deliveryDetail = !empty($print['DeliveryDetail']['location']) ? $print['DeliveryDetail']['location'] : ''; 
            $remarks = !empty($print['DeliveryDetail']['remarks']) ? $print['DeliveryDetail']['remarks'] : '';     
            $sheet->setCellValue('A'.$po, $print['ClientOrder']['ClientOrder']['po_number']);
            $sheet->setCellValue('C'.$po, $productName);
            $sheet->setCellValue('C'. $even[$key], $remarks);
            $sheet->setCellValue('J'. $odd[$key], $print['DeliveryDetail']['quantity']);

            $sheet->setCellValue('I'.'5', $toBePrinted);

            $sheet->setCellValue('C'.'6', ucwords($print['Company']['Company']['company_name']));
            $sheet->setCellValue('C'.'7', ucwords($print['DeliveryDetail']['location']));       
             
            if($difference == 0){

                     $sheet->setCellValue('H'.$odd[$key], floor($dividend) . " x " .   $print['DeliveryDetail']['pieces'] . " / " . $measureList[$print['DeliveryDetail']['measure']] );

            }else{

                        $sheet->setCellValue('H'.$odd[$key], floor($dividend) . " x " .   $print['DeliveryDetail']['pieces'] . " + " . floor($difference) . " / " . $measureList[$print['DeliveryDetail']['measure']] );

            }


             $sheet->setCellValue('A'.'21', $preparedFName . " " .$preparedLName);
             $sheet->setCellValue('E'.'21', $approvedFName . " " .$approvedLName);

          // ->setCellValue('J'.'9', $print['DeliveryDetail']['quantity'])
                    // ->setCellValue('J'.'4', '')
                 
                    // ->setCellValue('A'.'9', $print['ClientOrder']['ClientOrder']['po_number'])
                    // ->setCellValue('C'.'7', ucwords($print['DeliveryDetail']['location']))
                    // ->setCellValue('C'.'9', ucfirst($print['ClientOrder']['Product']['name']))
                    // ->setCellValue('C'.'10', $remarks)
                    // ->setCellValue('J'.'9', $print['DeliveryDetail']['quantity'])
                    // ->setCellValue('A'.'21', $preparedFName . " " .$preparedLName)
                    // ->setCellValue('E'.'21', $approvedFName . " " .$approvedLName)
                    // ->setCellValue('I'.'5', $toBePrinted);

        // if($difference == 0){

        // $objTpl->setActiveSheetIndex(0)
                    
        //             ->setCellValue('H'.'9', floor($dividend) . " x " .   $drData['DeliveryDetail']['pieces'] . " / " . $measureList[$drData['DeliveryDetail']['measure']] );

        // }else{

        // $objTpl->setActiveSheetIndex(0)
                    
        //             ->setCellValue('H'.'9', floor($dividend) . " x " .   $drData['DeliveryDetail']['pieces'] . " + " . floor($difference) . " / " . $measureList[$drData['DeliveryDetail']['measure']] );

        // }


        $po +=2;
        $counter++;  

    }

    $filename = 'dr-'.date('ymd').'-'.mt_rand(1,100000).'.xls'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>