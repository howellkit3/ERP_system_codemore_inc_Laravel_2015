<?php
// create new empty worksheet and set default font
$this->PhpExcel->createWorksheet()
    ->setDefaultFont('Calibri', 12);
$this->PhpExcel->setActiveSheetIndex(0)->mergeCells('C1:D1');
// define table cells
$table = array(
    array('label' => __('CUSTOMER')),
    array('label' => __('PHP')),
    array('label' => __('AVE. CONVERSION RATE (USD IN PHP) 44.221 = $1')),
    //array('label' => __('PHP')),
    array('label' => __('Total Sales')),
    array('label' => __('%')),
    array('label' => __('Target')),
    array('label' => __('Terms')),
    array('label' => __('Due Date'))
);

// add heading with different font and bold text
$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));

// add data

foreach ($invoiceData as $invoiceList) {
    $phpPrice = '';
    $totalphp = '';
    $usdPrice = '';
    $phpTotal = '';
    $totalP = '';
    $totalPhpSale = '';

    if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {
        $phpPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);

        $totalphp = number_format($invoiceList['SalesInvoice']['unit_price'],2);

        $totalPhpSale = number_format($invoiceList['SalesInvoice']['unit_price'],2);

    } else {
        $usdPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);

        $phpTotal = 44.221 * $invoiceList['SalesInvoice']['unit_price'];
        
        $totalP = number_format($phpTotal,2);

        $totalPhpSale = number_format($phpTotal,2);
    }

    $totalSale = 0;
    foreach ($invoiceData as $key => $invoice) { 
        if ($invoice['SalesInvoice']['unit_price_currency_id'] == 1) {
            $totalSale = $totalSale + $invoice['SalesInvoice']['unit_price'];
            
        } else {
            $phpTotal = 44.221 * $invoice['SalesInvoice']['unit_price'];
            $totalSale = $totalSale + $phpTotal;
            
        }
    }
    
    $percent = '';
    $fulltotalSale = '';
    if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {
        $fulltotalSale = $totalSale /  $invoiceList['SalesInvoice']['unit_price'];
        $percent = number_format($fulltotalSale,2);
            
    } else {
        $phpTotal = 44.221 * $invoiceList['SalesInvoice']['unit_price'];
        $fulltotalSale = $totalSale /  $phpTotal;
        $percent = number_format($fulltotalSale,2);
        
    }
    $this->PhpExcel->addTableRow(array(
        $companyData[$invoiceList['SalesInvoice']['company_id']],
        $phpPrice,
        $usdPrice,
        $totalP,
        $totalPhpSale,
        $percent,
        ' ',
        $paymentTermData[$invoiceList['SalesInvoice']['payment_terms']],
        date('m/d/Y', strtotime($invoiceList['SalesInvoice']['schedule']))
    ));
   
}


// close table and output
$this->PhpExcel->addTableFooter()
    ->output($invoiceList['SalesInvoice']['sales_invoice_no'].'.xlsx');
?>