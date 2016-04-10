<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'customer_sales', 'action' => 'add')); ?>

<div style="clear:both"></div>

<?php echo $this->element('account_option'); ?><br><br>
<?php echo $this->Html->script('Sales.company_quotation');?>
<?php  echo $this->Form->create('SalesInvoice',array('url'=>(array(
'controller' => 'sales_invoice',
'action' => 'edit_pre_invoice',
$invoice['SalesInvoice']['id'],0,
$invoice['SalesInvoice']['dr_uuid'],
$invoice['SalesInvoice']['sales_invoice_no'],
$invoice['SalesInvoice']['delivery_id']

)),'class' => 'form-horizontal')); ?>
<div class="row">
    <div class="col-lg-12">
        
        <div class="row">
            <div class="col-lg-12">
                <header class="main-box-header clearfix">
                    
                    <center>
                        <h1 class="pull-left">
                            Customer Information
                        </h1>
                    </center>
                    <?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'customer_sales', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
                </header>

            </div>
        </div>
        <?php echo $this->Form->input('Company.id', array('class' => 'form-control item_type',
                        'type' => 'hidden',
                        'value' => !empty($this->request->data['Company']['id']) ? $this->request->data['Company']['id'] : '' ,
                        'label' => false)); 
                   // pr($this->request->data);exit();
                ?>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <h1>Pre Invoice</h1>
                        <!-- <div class="top-space"></div> -->
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                           <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Company </label>
                                        <div class="col-lg-9">
                                               <?php
                                                
                                                echo $this->Form->input('SalesInvoice.id'); 
                                             
                                                echo $this->Form->input('SalesInvoice.company_id', 
                                                    array(
                                                        'class' => 'form-control col-lg-6',
                                                        'label' => false,
                                                        'options' => $companyName,
                                                        'default' => $clientDataHolder['ClientOrder']['company_id']

                                                    ));
                                            ?>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Date </label>
                                        <div class="col-lg-9">
                                               <?php
                                                 
                                             
                                                echo $this->Form->input('SalesInvoice.invoice_date', 
                                                    array(
                                                        'class' => 'form-control col-lg-6 datepicker',
                                                        'label' => false,
                                                        'value' => !empty($invoice['SalesInvoice']['invoice_date']) ? $invoice['SalesInvoice']['invoice_date'] : date('Y-m-d'),
                                                    'type' => 'text'
                                                        )

                                                    );
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> SI number</label>
                                        <div class="col-lg-9">
                                            <?php
                                                echo $this->Form->input('SalesInvoice.sales_invoice_no', array('class' => 'form-control col-lg-6 required','label' => false));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"> DR number</label>
                                        <div class="col-lg-9">
                                            <?php
                                                echo $this->Form->input('SalesInvoice.dr_uuid', array('type' => 'text', 
                                                    'maxlength'=>'1000',
                                                     'class' => 'form-control col-lg-6 ',
                                                     'label' => false
                                                     ));
                                            ?>
                                        </div>
                                    </div>

                                    <h3>Edit Item</h3> 
                                   <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td><center><b>P.O NO.</b></center></td>
                                <td><center><b>DESCRIPTION</b></center></td>
                                <td><center><b>QUANTITY</b></center></td>
                                <td><center><b>PRICE</b></center></td>
                            </tr>
                        <?php  
                        $vat = array();
                        $unitPriceID = array();
                        $total =0; 
                        foreach ($drData as $key => $list) : 

                            $unitPrice = number_format($list['QuotationItemDetail']['unit_price'],4); 
                            ?>
                            <tr>
                                <td><center><?php echo $list['ClientOrder']['po_number']?></center></td>
                                <td><center><?php echo ucfirst($list['Product']['name'])?></center></td>
                                <td><center><?php //echo number_format($list['DeliveryDetail']['quantity'])?>
                                    <?php echo $this->Form->input('DeliveryDetail.'.$key.'.id',array(
                                            'type' => 'hidden',
                                            'value' => $list['DeliveryDetail']['id']
                                    )); 
                                     echo $this->Form->input('DeliveryDetail.'.$key.'.quantity',array(
                                        'label' => false,
                                        'value' => !empty($list['DeliveryDetail']['quantity']) ? $list['DeliveryDetail']['quantity'] : '' ,
                                        'class' => 'form-control'
                                    )); ?>
                                </center></td>
                                <td><center><?php echo $unitPrice ?></center>
                                    <?php echo $this->Form->input('QuotationItemDetail.'.$key.'.id',array(
                                            'type' => 'hidden',
                                            'value' => $list['QuotationItemDetail']['id']
                                    )); ?>
                                     <?php echo $this->Form->input('QuotationItemDetail.'.$key.'.unit_price',array(
                                        'label' => false,
                                        'value' => !empty($list['QuotationItemDetail']['unit_price']) ? $list['QuotationItemDetail']['unit_price'] : '' ,
                                        'class' => 'form-control'
                                    )); ?>
                                </td>
                               
                            </tr>
                        <?php 
                        $vat[] = $list['QuotationItemDetail']['vat_status'];
                        $unitPriceID[] = $list['QuotationItemDetail']['unit_price_currency_id'];
                        endforeach; ?>
                         
                            
                        </thead>
                    </table>
                </div> 

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

              <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                       
                        <div class="top-space"></div>
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                        
                                    <div class="multi-field clearfix">
                                        <div class="col-xs-2 col-md-2"></div>
                                        <div class="col-xs-2 col-md-2 2">
                                            <?php 
                                                echo $this->Form->submit('Submit', array('class' => 'btn btn-success pull-right' ));
                                            ?>
                                          
                                        </div>
                                        <div class="col-xs-2 col-md-2 2">
                                            <?php 
                                                echo $this->Html->link('Cancel ', array('controller' => 'customer_sales', 'action' => 'index'),array('class' =>'btn btn-primary','escape' => false));
                                            ?>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

       
    </div>
</div>
 <?php echo $this->Form->end(); ?>

 <script>
 
 $(document).ready(function(){

  $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
      });

 });

 </script>