<?php echo $this->Html->script('Sales.quantityLimitDelivery'); ?>
<?php echo $this->element('deliveries_options'); ?><br><br>

<div class="row1">
  <div class="col-lg-12">
    <div class="main-box clearfix body-pad">
  


      <div class="filter-block pull-right marginDelivery">

      </div>

      <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Delivery Receipt Records</b></h2>

                <div class="filter-block pull-right">

                <div class="form-group pull-left">
                
                        <input placeholder="Search..." class="form-control searchOrder"  />
                        <i class="fa fa-search search-icon"></i>
                    
                </div>

            </div> 
                
      </header>

      <div class="main-box-body clearfix" id = "dr-table">
        <div class="table-responsive">
          <div class="main-box clearfix body-pad">        
          <table class="table table-striped table-hover ">
            <thead>
            <tr >
              <th class=""><a href="#"><span>DR #</span></a></th>
              <!-- <th class=""><a href="#"><span>Schedule</span></a></th> -->
              <th class=""><a href="#"><span>Company</span></a></th>
              <th class=""><a href="#"><span>Item Name</span></a></th>
              <th class=""><a href="#"><span>Quantity</span></a></th>
              <th class=""><a href="#"><span>Type</span></a></th>
              <th class=""><a href="#"><span>Remarks</span></a></th>
              <th class=""><a href="#"><span>Printed Date</span></a></th>
              <th class=""><a href="#"><span>Printed by</span></a></th>
            </tr>
            </thead>

                  <tbody aria-relevant="all" aria-live="polite" class="OrderFields" role="alert" >
                            <!-- <div class ="field"> -->
                            <?php echo $this->element('dr_table'); ?> 
                            <!-- </div> -->
                        </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
                        </tbody>

            

          </table>
       
          </div>
          <hr>
           <div class="paging" id="dr_pagination">
              <?php

              echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'DeliveryReceipt','model' => 'DeliveryReceipt'), null, array('class' => 'disable','model' => 'DeliveryReceipt'));
              echo $this->Paginator->numbers(array('separator' => '','paginate' => 'DeliveryReceipt'), array('paginate' => 'DeliveryReceipt'));
              echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'DeliveryReceipt','model' => 'DeliveryReceipt'), null, array('class' => 'disable'));
              ?>

            </div>
        </div>
      </div>  
  </div>
</div>
</div>
          
<?php echo $this->element('modals'); ?>

<script>

    $("body").on('keyup','.searchOrder', function(e){

        var searchInput = $(this).val();
    
        
        //alert(searchInput);
        if(searchInput != ''){

            $('.OrderFields').hide();
            $('.searchAppend').show();
          

        }else{
            $('.OrderFields').show();
            $('.searchAppend').hide();
          //  alert('show');
        }
        
        $.ajax({
            type: "GET",
            url: serverPath + "delivery/deliveries/search_delivery_receipt/"+searchInput,
            dataType: "html",
            success: function(data) {

                //alert(data);

                if(data){

                    $('.searchAppend').html(data);

                } 
                if (data.length < 5 ) {

                    $('.searchAppend').html('<font color="red"><b>No result..</b></font>');
                     
                }
                
            }
        });

    });

</script>

