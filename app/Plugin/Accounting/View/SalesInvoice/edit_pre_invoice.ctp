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
                                                        'disabled' => 'disabled',
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