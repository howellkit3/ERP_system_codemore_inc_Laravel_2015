<?php echo $this->Html->script('Sales.quantityLimitDelivery'); ?>
<?php echo $this->element('deliveries_options'); ?><br><br>

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


      <div class="filter-block pull-right marginDelivery">

      </div>

      <header class="main-box-header clearfix">

        <h2 class="pull-left"><b>Delivery Schedule</b></h2>

      </header>

      <div class="main-box-body clearfix">
        <div class="table-responsive">
          <div class="main-box clearfix body-pad">        
          <table class="table table-striped table-hover ">
            <thead>
            <tr >
              <th class=""><a href="#"><span>Delivery Receipt #</span></a></th>
              <th class=""><a href="#"><span>Schedule</span></a></th>
              <th class=""><a href="#"><span>Location</span></a></th>
              <th class=""><a href="#"><span>Quantity</span></a></th>
              <th class=""><a href="#"><span>Remaining</span></a></th>
              <th class=""><a href="#"><span>Status</span></a></th>
              <th class=""><a href="#"><span>Action</span></a></th> 
            </tr>
            </thead>

            <?php echo $this->element('delivery_replacing_table'); ?>   

          </table>
          </div>
        </div>
      </div>  
  </div>
</div>
          
<?php echo $this->element('modals'); ?>

