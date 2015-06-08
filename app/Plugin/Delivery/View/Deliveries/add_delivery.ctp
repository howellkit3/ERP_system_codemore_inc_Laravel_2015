<?php echo $this->element('deliveries_options'); ?><br><br>
    <?php echo $this->Form->create('Company',array('url'=>(array('controller' => 'customer_sales','action' => 'add')),'class' => 'form-horizontal'));?>
<div class="row">
    <div class="col-lg-12">
        
        <div class="row">
            <div class="col-lg-12">
                <header class="main-box-header clearfix">
                    
                    <center>
                        <h1 class="pull-left">
                         Delivery Plan Information
                        </h1>
                    </center>
                    <?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'customer_sales', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
                </header>

            </div>
        </div>
       <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                      	<br>
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>Delivery Receipt</label>
                                        <div class="col-lg-9">
                                            <?php
                                                echo $this->Form->input('Company.company_name', array('class' => 'form-control col-lg-6 required','label' => false));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group" id="existing_items">
                                                <label class="col-lg-2 control-label"><span style="color:red">*</span>Schedule</label>
                                        <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('DeliveryDetail.schedule', array(
                                                                                        'label' => false,
                                                                                        'required' => 'required',
                                                                                        'class' => 'form-control item_type datepick required',
                                                                                        'type' => 'text',
                                                                                        'id' => 'date'
                                                                                       
                                                                                        ));
                                                    ?>
			                            </div>
			                        </div>

                                     <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">Quantity</label>
                                        <div class="col-lg-9">
                                            <?php
                                                echo $this->Form->input('Company.website', array('class' => 'form-control col-lg-6','label' => false));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">Location</label>
                                        <div class="col-lg-9">
                                            <?php
                                                echo $this->Form->input('Company.tin', array('class' => 'form-control col-lg-6','label' => false,'type' => 'text'));
                                            ?>
                                
                                        </div>
                                    </div>


			                      
			                        
			                                    <div class="multi-field clearfix">
			                                        <div class="col-xs-2 col-md-2"></div>
			                                        <div class="col-xs-2 col-md-2 2">
			                                            <?php 
			                                                echo $this->Form->submit('Submit Delivery Plan', array('class' => 'btn btn-success pull-right',  'title' => 'Click here to add the customer'));
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
    
        jQuery(document).ready(function($){
            $("#ClientOrderDeliveryScheduleViewForm").validate();
            $('#date').datepicker({
            format: 'yyyy-mm-dd'
        });
          
        });

        jQuery("#ClientOrderDeliveryScheduleViewForm").validate();

     </script>
