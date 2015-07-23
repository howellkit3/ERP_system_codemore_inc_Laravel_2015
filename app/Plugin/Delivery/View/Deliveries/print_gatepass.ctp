<?php

    $ctr = 1;
    $ctrQuantity = 8;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/gatepass1.xlsx");
 	
        $objTpl->setActiveSheetIndex(0)
                            //->setCellValueByColumnAndRow('1', 9, 'Howell Kit')
                            ->setCellValue('J3', $gateData['GatePass']['id'])
                            ->setCellValue('J6', (new \DateTime())->format('l, F d, Y '));

       
     foreach ($productList as $key => $productnamelist) {
         if(count($productList) < 5){
                $objTpl->setActiveSheetIndex(0)
                            ->setCellValueByColumnAndRow('1', $ctr + 7 , ucwords($productList[$key]))
                            ->setCellValue('F'.$ctrQuantity, $productQuantity[$key])
                            ->setCellValue('J8', $remarks)
                            ->setCellValue('I'.$ctrQuantity, $units[$productUnit[$key]]);
                            
              $ctr++;
              $ctrQuantity++;
            
            }else{

                $objTpl->setActiveSheetIndex(0)
                            ->setCellValueByColumnAndRow('1', 9 , count($productList) .' '. 'items')
                            ->setCellValue('J9','pick up by '. $companyList[$drData['Delivery']['company_id']]);
                          
            }
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
                                ->setCellValue('C12', ucwords(strtoupper($truckList[$truck])))
                                ->setCellValue('C13', ucwords($driverList[$driver]))
                                ->setCellValue('B18',ucwords($userData['User']['first_name']) . ' '. ucwords($userData['User']['last_name']))
                                ->setCellValue('F18', ucwords($userFnameList[$approver]) . ' ' .ucwords($userLnameList[$approver]));
      
                       
    //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
    
    //header("location:".base_url()."../view/".$deliveryScheduleId."/".$quotationId."/".$clientsOrderUuid);
    exit; //done.. exiting!
?>