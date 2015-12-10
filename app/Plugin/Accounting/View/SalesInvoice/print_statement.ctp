<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/statement_account.xlsx");

    $statementnum = "SA".str_pad($invoiceData['SalesInvoice']['statement_no'], 6, '0', STR_PAD_LEFT); 
    $drnum = "DR".str_pad($drData['Delivery']['dr_uuid'], 6, '0', STR_PAD_LEFT);

    $words = explode(" ", $drData['DeliveryDetail']['location']);

    if(count($words) > 3){

        $halfAddress = floor(count($words)/2);
      
        $r = array();
        for ($i = 0; $i <= $halfAddress; $i++) {

            if($i == 0){

                $Addresspart1 = $words[$i];
                $Addresspart2 = $words[$i + $halfAddress + 1];

            }else{

                $addindex = $halfAddress + 1;
                $Addresspart1 = $Addresspart1 . " " . $words[$i];
               // pr(); exit;
               if(count($words) == ($i + $halfAddress + 1)){

                    if($i != $halfAddress){

                        $Addresspart2 = $Addresspart2 . " " . $words[$i + $halfAddress  ];
                    }   

                }else{
                   
                    if($i != $halfAddress){

                        $Addresspart2 = $Addresspart2 . " " . $words[$i + $halfAddress + 1 ];

                    }

                }
            }
        }
    }else{

        $Addresspart1 = $drData['DeliveryDetail']['location'];
        $Addresspart2 = "";
      
    }

    $objTpl->setActiveSheetIndex(0)
                ->setCellValue('C7', ucwords($clientData['Company']['company_name']))
                ->setCellValue('C8', $Addresspart1)
                ->setCellValue('C9', $Addresspart2)
                ->setCellValue('I6', $statementnum)
                ->setCellValue('I8', $clientData['Company']['tin'])
                ->setCellValue('F12', number_format($drData['DeliveryDetail']['quantity']))
                ->setCellValue('H12', $clientData['QuotationItemDetail']['unit_price'])
                ->setCellValue('I9', $paymentTermData[$clientData['ClientOrder']['payment_terms']])      
                ->setCellValue('I7', date('M d, Y', strtotime($drData['Delivery']['created'])))
                ->setCellValue('C12', ucfirst($clientData['Product']['name']))
                ->setCellValue('A12', $clientData['ClientOrder']['po_number'])
                ->setCellValue('C25', $drnum);
                   
    //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!
?>