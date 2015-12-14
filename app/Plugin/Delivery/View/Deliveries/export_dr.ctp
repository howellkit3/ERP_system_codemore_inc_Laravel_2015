<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/dr_export.xlsx");

    $cellHolder = 2;

    $quantitySum = 0;
    $po_quantity = 0;

    foreach ($deliveryData as $key => $value) {

        $keyholder = $key + 2;

        $cellNumber = $cellHolder ++;

        $cellForQty = $cellNumber - 1;

        $keyPO = $key - 1;

        if($key == 0){

            $keyPO = 0;

        }

        if($value['ClientOrder']['po_number'] != $deliveryData[$keyPO]['ClientOrder']['po_number']){

            $status = $po_quantity - $quantitySum;

            if($status == 0){

                $status = "Completed";

            }

            $objTpl->setActiveSheetIndex(0)
                
                ->setCellValue('J'.$cellForQty, $quantitySum)
                ->setCellValue('L'.$cellForQty, $po_quantity)
                ->setCellValue('M'.$cellForQty, $status);

            $quantitySum = 0;
            $po_quantity = 0;

        }

        $quantitySum = $quantitySum + $value['DeliveryDetail']['quantity'];
        $po_quantity = $po_quantity + $value['QuotationItemDetail']['quantity'];

        $objTpl->setActiveSheetIndex(0)

        ->setCellValue('A'.$cellNumber, date('Y-m-d',strtotime($value['Delivery']['created'])))
        ->setCellValue('C'.$cellNumber, $value['Delivery']['dr_uuid'])
        ->setCellValue('E'.$cellNumber, $value['ClientOrder']['po_number'])
        ->setCellValue('G'.$cellNumber, $value['Product']['name'])
        ->setCellValue('I'.$cellNumber, $value['DeliveryDetail']['quantity'])
        ->setCellValue('K'.$cellNumber, $value['QuotationItemDetail']['quantity']);
   
    } 

    $status = $po_quantity - $quantitySum;

    if($status == 0){

        $status = "Completed";

    }

    $objTpl->setActiveSheetIndex(0)
                
                ->setCellValue('J'.$keyholder, $quantitySum)
                ->setCellValue('L'.$keyholder, $po_quantity)
                ->setCellValue('M'.$keyholder, $status);

    $filename = mt_rand(1,100000).'.xlsx'; 
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007'); 
    $objWriter->save('php://output'); 
     
    exit;
?>