<?php echo $this->element('deliveries_options'); ?><br><br>

<?php echo $this->Html->script('Sales.quantityLimitDelivery');?>

<div class="row1">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <div class="filter-block pull-right marginDelivery">
               <?php   
                
                  echo $this->Html->link('<i class="fa  fa-arrow-left fa-lg "></i> Back ', 
                        array('controller' => 'deliveries', 
                            'action' => 'index'
                            ),
                        array('class' =>'btn btn-primary pull-right',
                            'escape' => false));
                ?>  

               <br><br>
           </div>
   
            

<div class="row1">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <div class="filter-block pull-right marginDelivery">

           </div>
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Delivery Schedule</b></h2>

                <?php echo $this->Html->link('<i class="fa fa-plus-circle fa-lg"></i> Add Delivery Schedule ', array('controller' => 'deliveries', 'action' => 'add_delivery'),array('class' =>'btn btn-primary pull-right','escape' => false)); ?>
                
            </header>



            <table class="table table-striped table-hover ">
                        <thead>
                            <tr >
                                <th class=""><a href="#"><span>Delivery Receipt #</span></a></th>
                                <th class=""><a href="#"><span>Schedule</span></a></th>
                                <th class=""><a href="#"><span>Quantity</span></a></th>
                                <th class=""><a href="#"><span>Location</span></a></th>
                               <!--  <th class=""><a href="#"><span>Status</span></a></th> -->
                            </tr>
                        </thead>

                        <?php echo $this->element('delivery_table'); ?>  
                    </table>
              </div>
        </div>
    </div>  

    
             
<?php echo $this->element('modals'); ?>

<style>
.margintop{
    margin-top : 10%; 

</style    

