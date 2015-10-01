<?php
                    
    //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');

    $ctr = 1;
    $ctrQuantity = 8;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/gatepass1.xlsx");
 	
        if(!empty($gateData['GatePass']['id'])){  
            $objTpl->setActiveSheetIndex(0)
                                ->setCellValue('J3', $gateData['GatePass']['id']);
        }else{

            $objTpl->setActiveSheetIndex(0)
                                ->setCellValue('J3',rand ( 99 , 1000 ));


        }

        if(!empty($truckList[$truck]) || !empty($driverList[$driver])){

            $objTpl->setActiveSheetIndex(0)                      
                                ->setCellValue('J6', (new \DateTime())->format('l, F d, Y '))
                                ->setCellValue('C12', ucwords(strtoupper($truckList[$truck])))
                                ->setCellValue('C13', ucwords($driverList[$driver]));
                                
            foreach ($gateData as $key => $gateDateList) {

                $objTpl->setActiveSheetIndex(0)
                                    ->setCellValueByColumnAndRow('1', $ctr + 7 , 'DR-'.$gateDateList['GatePass']['ref_uuid'].' / '.ucwords($gateDateList['ClientOrder']))
                                    ->setCellValue('F'.$ctrQuantity, $gateDateList['DeliveryDetail'])
                                    ->setCellValue('I'.$ctrQuantity, $units[$gateDateList['QuotationItemDetail']]);

                $ctr++;
                $ctrQuantity++;

            }
        
            // foreach ($productList as $key => $productnamelist) {   
            //     if(count($productList) < 5){

            //         $objTpl->setActiveSheetIndex(0)
            //                         ->setCellValueByColumnAndRow('1', $ctr + 7 , ucwords($clientData['Product']['name']))
            //                         ->setCellValue('F'.$ctrQuantity, $drData['DeliveryDetail']['quantity'])
            //                         ->setCellValue('I'.$ctrQuantity, $units[$clientData['QuotationItemDetail']['quantity_unit_id']]);
                                    

            //         $ctr++;
            //         $ctrQuantity++;
                    

            //     }else{

            //         $objTpl->setActiveSheetIndex(0)
            //                         ->setCellValueByColumnAndRow('1', 9 , count($productList) .' '. 'items')
            //                         ->setCellValue('J9','pick up by '. $companyList[$drData['Delivery']['company_id']]);
                                     
            //     }
            // }

        }

                           
        $counter =  14;  
        foreach ($assistData as $key => $helperlist) {
            if(!empty($helperlist['GatePassAssistant']['helper_id'])){     
                $objTpl->setActiveSheetIndex(0)
                                ->setCellValue('C'.$counter, ucwords($assList[$helperlist['GatePassAssistant']['helper_id']]));
                $counter++;
            }
        }

        $objTpl->setActiveSheetIndex(0)
                                ->setCellValue('B18',ucwords($userData['User']['first_name']) . ' '. ucwords($userData['User']['last_name']))
                                ->setCellValue('F18', ucwords($userFnameList[$approver]) . ' ' .ucwords($userLnameList[$approver]))
                                ->setCellValue('J8', $remarks);
      
     
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
    
    //header("location:".base_url()."../view/".$deliveryScheduleId."/".$quotationId."/".$clientsOrderUuid);
    exit; //done.. exiting!
?>