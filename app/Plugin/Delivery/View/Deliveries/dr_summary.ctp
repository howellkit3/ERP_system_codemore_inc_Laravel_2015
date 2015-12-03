<?php echo $this->Html->script('Sales.quantityLimitDelivery'); ?>
<?php  echo $this->Html->script('Delivery.date_range');?>
<?php echo $this->element('deliveries_options'); ?><br><br>

<div class="row1">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">

        <div class="filter-block pull-right marginDelivery"></div>

        <header class="main-box-header clearfix">

            <h2 class="pull-left"><b>Delivery Schedule</b></h2>

        </header>

        <div class="main-box-body clearfix">
            <div class="table-responsive">
                <div class="main-box clearfix body-pad">  
                     <?php   
                            echo $this->Html->link('<i class="fa  fa-arrow-left fa-lg "></i> Back ', 
                                array('controller' => 'deliveries', 
                                'action' => 'index'
                                ),
                                array('class' =>'btn btn-primary pull-right',
                                    'style' => "margin-left:3px",
                                    'escape' => false));

                        ?> 

                    <?php echo $this->Form->create('SalesInvoice',array('url'=>(array('controller' => 'sales_invoice','action' => 'payables_print')),array('class' => 'form-inline')));?>

                        <button type="submit" class="form-export-btn btn btn-success pull-right"><i class="fa fa-share-square-o fa-lg"></i> Export</button>
                        
                        <div class="form-group col-md-3 pull-left">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input placeholder="Date Filter" name="from_date" data="1" type="text" class="form-control myDateRange datepickerDateRange" id="datepickerDateRange" >
                            </div>
                        </div>
                    
                        <div class="form-group col-md-3 pull-left">
                            <div class="input-group">

                        <?php 
                            echo $this->Form->input('RequestItem.category', array(
                                'options' => $companyData,  
                                'label' => false,
                                'class' => 'form-control company-filter',
                                'empty' => '---Select Customer---'
                                 )); 
                        ?>
                            </div>
                        </div>

                        <button type="button" class="clear-date btn btn-success pull-left" ><i class="fa fa-eraser fa-lg"></i> Clear</button>

                    <?php echo $this->Form->end(); ?>

                    <table class="table table-striped table-hover ">
                        
                        <thead>
                            <tr>
                                <th class=""><a href="#"><span>D.R. #</span></a></th>
                                <th class=""><a href="#"><span>Customer</span></a></th>
                                <th class=""><a href="#"><span>C.O. #</span></a></th>
                                <th class=""><a href="#"><span>P.O. #</span></a></th>
                                <th class=""><a href="#"><span>Schedule</span></a></th>
                                <th class=""><a href="#"><span>Quantity</span></a></th>
                                <th class=""><a href="#"><span>Delivered</span></a></th>
                                <th class=""><a href="#"><span>Status</span></a></th>
                            </tr>
                        </thead>

                        <tbody aria-relevant="all" class="dateRangeAppend-dr" aria-live="polite" role="alert" style="display:none;">
                        </tbody>
                        <tbody aria-relevant="all" class="dr-report" aria-live="polite" role="alert">
                        <?php echo $this->element('delivery_summary'); ?>   
                        </tbody>

                    </table>
                    <hr>
                    </div>
                    <div class="paging" id="item_type_pagination">
                                <?php
                               
                                echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Delivery','model' => 'Delivery'), null, array('class' => 'disable','model' => 'Delivery'));
                                echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Delivery'), array('paginate' => 'Delivery'));
                                echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Delivery','model' => 'Delivery'), null, array('class' => 'disable'));

                                ?>
                        </div>
                </div>
            </div>  
        </div>
</div>

<script>
        
    jQuery(document).ready(function($){

        $("#SalesInvoiceReceivableForm").validate();
        
        $('.daterange').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('.datepickerDateRange').daterangepicker();
    
    });


</script>
          


