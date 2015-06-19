<?php
// create new empty worksheet and set default font
$this->PhpExcel->createWorksheet()
    ->setDefaultFont('Calibri', 12);

// define table cells
$table = array(
    array('label' => __('DATE')),
    array('label' => __('DR#')),
    array('label' => __('USD')),
    array('label' => __('PHP')),
    array('label' => __('CUSTOMER')),
    array('label' => __('QUANTITY')),
    array('label' => __('SI#')),
    array('label' => __('SA#')),
    array('label' => __('Remarks'))
);

// add heading with different font and bold text
$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));

// add data

foreach ($invoiceData as $key => $invoiceList) {

	if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {
		$phpPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);
	} else {
		$usdPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);
	}

    $this->PhpExcel->addTableRow(array(
        date('m/d/Y', strtotime($invoiceList['SalesInvoice']['created'])),
        $invoiceList['SalesInvoice']['dr_uuid'],
        $usdPrice,
        $phpPrice,
        $companyData[$invoiceList['SalesInvoice']['company_id']],
        $invoiceList['SalesInvoice']['quantity'],
        $invoiceList['SalesInvoice']['sales_invoice_no'],
        $invoiceList['SalesInvoice']['statement_no'],
        ' '
    ));
   
}

// close table and output
$this->PhpExcel->addTableFooter()
    ->output($invoiceList['SalesInvoice']['sales_invoice_no'].'.xlsx');
?>