<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Inquiry', array('controller' => 'customer_sales', 'action' => 'inquiry')); ?>
<?php echo $this->Html->script('Sales.item_type');?>
<?php echo $this->Html->script('Sales.searchQuotation');?>
<div style="clear:both"></div>
<?php 
  /* echo $this->Html->script('jquery');
   $this->Paginator->options(array(
      'update' => '#productTable',
      'before' => $this->Js->get("#loader")->effect('fadeIn', array('buffer' => false)),
      'complete' => $this->Js->get("#loader")->effect('fadeOut', array('buffer' => false)),
   )); */
?>
<div id="productTable">
<?php //echo $this->Html->image('loader.gif', array('class' => 'hide', 'id' => 'loader')); ?>
<?php echo $this->element('sales_option');?><br><br>
          
    <div class="row" > 

        <div class="col-lg-12">
            <div class="main-box clearfix body-pad">
                <header class="main-box-header clearfix">
                    <h2 class="pull-left"><b>Product List</b></h2>
                    <div class="filter-block pull-right">
                        <div class="form-group pull-left">
                            <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
                                <input placeholder="Search..." class="form-control searchProduct <?php echo $noPermission; ?>"  />
                                <i class="fa fa-search search-icon"></i>
                             <?php //echo $this->Form->end(); ?>
                        </div>

                     <?php

                            echo $this->Html->link('<i class="fa fa-plus-circle fa-lg"></i> Add Product ', array('controller' => 'products', 'action' => 'create_product'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </div>
                </header>
               <div class="main-box-body clearfix">

                     <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr> 
                               <th><a href="#"><span>Item Number</span></a></th>
                                    <th><a href="#"><span>Product Name</span></a></th>
                                    <th><a href="#"><span>Customer</span></a></th>
                                    <th><a href="#"><span>Item Category</span></a></th>
                                    <th><a href="#"><span>Item Type</span></a></th>
                                    <th><a href="#"><span>Remarks</span></a></th>
                                    <th><a href="#"><span>Created</span></a></th>
                                    <th style="width:200px">Action</th>
                            </tr>
                        </thead>

                        <tbody aria-relevant="all" aria-live="polite" class="field" name = "kit "role="alert" >
                            <?php echo $this->element('product_table'); ?>
                        </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchProductAppend" role="alert" >
                        </tbody>
 
                    </table>
                    <hr>

                <div class="paging">
                <?php

                echo $this->Paginator->prev('< ' . __('previous'), null, null, array('class' => 'disable'));
                echo $this->Paginator->numbers(array('separator' => ''));
                echo $this->Paginator->next(__('next') . ' >', null, null, array('class' => 'disable'));
                ?>
                </div>
                <?php //echo $this->Html->image('loader.gif', array('class' => 'hide', 'id' => 'loader')); ?>
                <?php //echo $this->Js->writeBuffer(); ?>
                </div>



                    <!-- <div class="table-responsive">
                        <table class="table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th><a href="#"><span>Item Number</span></a></th>
                                    <th><a href="#"><span>Product Name</span></a></th>
                                    <th><a href="#"><span>Customer</span></a></th>
                                    <th><a href="#"><span>Item Category</span></a></th>
                                    <th><a href="#"><span>Item Type</span></a></th>
                                    <th><a href="#"><span>Remarks</span></a></th>
                                    <th><a href="#"><span>Created</span></a></th>
                                    <th style="width:200px">Action</th>
                                </tr>
                            </thead>

                            
                            <tbody  class="searchProductAppend">
                            <span  ></span>
                            </tbody>

                              <tbody  class="field">
                                 <?php //echo $this->element('product_table'); ?>
                            </tbody>
                          

                        </table>
                    

        <div class="paging">
        <?php

        echo $this->Paginator->prev('< ' . __('previous'), null, null, array('class' => 'disable'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', null, null, array('class' => 'disable'));
        ?>
        </div>
        </div> -->
        <?php //echo $this->Js->writeBuffer(); ?>


                </div>       
            </div>
        </div>
    </div>
 </div>
 <script type="text/javascript">
 $('.pagination .current > a').wrap('<a>');
 $('.pagination .disable').html('<a>'+$('.pagination .disable').text()+'</a>');
 $('.pagination .current').html('<a>'+$('.pagination .current').text()+'</a>');


 </script>