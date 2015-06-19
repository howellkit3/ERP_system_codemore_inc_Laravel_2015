<?php
// create new empty worksheet and set default font
$this->PhpExcel->createWorksheet()
    ->setDefaultFont('Calibri', 12);

// define table cells
$table = array(
    array('label' => __('CUSTOMER')),
    array('label' => __('DATE')),
    array('label' => __('DR#')),
    array('label' => __('CM/DM#')),
    array('label' => __('SI#')),
    array('label' => __('SA#')),
    array('label' => __('Total Amount PHP')),
    array('label' => __('Remarks'))
);

// add heading with different font and bold text
$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));

// add data

foreach ($invoiceData as $invoiceList){

    if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {

        $php = $invoiceList['SalesInvoice']['quantity'] * $invoiceList['SalesInvoice']['unit_price'];
        $amountPhp = number_format($php,2);

        $this->PhpExcel->addTableRow(array(
            $companyData[$invoiceList['SalesInvoice']['company_id']],
            date('m/d/Y', strtotime($invoiceList['SalesInvoice']['created'])),
            $invoiceList['SalesInvoice']['dr_uuid'],
            ' ',
            $invoiceList['SalesInvoice']['sales_invoice_no'],
            $invoiceList['SalesInvoice']['statement_no'],
            $amountPhp,
            ' '
        ));
    }  
}


// close table and output
$this->PhpExcel->addTableFooter()
    ->output($invoiceList['SalesInvoice']['sales_invoice_no'].'.xlsx');
?>