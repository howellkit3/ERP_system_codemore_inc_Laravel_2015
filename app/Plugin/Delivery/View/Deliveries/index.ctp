<?php //echo $this->Html->script('Deliveries.searchOrder');?>
<?php echo $this->element('deliveries_options'); ?><br><br>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Delivery Monitoring</b></h2>

                <div class="filter-block pull-right">

                <div class="form-group pull-left">
                
                        <input placeholder="Search..." class="form-control searchOrder"  />
                        <i class="fa fa-search search-icon"></i>
                    
                </div>

            </div> 
                
            </header>
            
            <div class="main-box-body clearfix ">
                <div class="table-responsive">
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr >
                                <th class="text-center"><a href="#"><span>Client Order</span></a></th>
                                <th class="text-center"><a href="#"><span>P.O. Number</span></a></th>
                                <th class="text-center"><a href="#"><span>Customer Name</span></a></th>
                                <th class="text-center"><a href="#"><span>Item Name</span></a></th>
                                <th class="text-center"><a href="#"><span>Schedule</span></a></th>
                                <th class="text-center"><a href="#"><span>Quantity</span></a></th>
                                <th class="text-center"><a href="#"><span>Status</span></a></th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody aria-relevant="all" aria-live="polite" class="OrderFields" role="alert">
                            <?php echo $this->element('schedule_requests_table'); ?>  
                        </tbody>

                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" style="display:none;">
                        </tbody>

                    </table>
                    <hr>

                    <div class="paging" id="item_type_pagination">
                            <?php
                           
                            echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'ClientOrder','model' => 'ClientOrder'), null, array('class' => 'disable','model' => 'ClientOrder'));
                            echo $this->Paginator->numbers(array('separator' => '','paginate' => 'ClientOrder'), array('paginate' => 'ClientOrder'));
                            echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'ClientOrder','model' => 'ClientOrder'), null, array('class' => 'disable'));

                            ?>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</div>

<script>

    $("body").on('keyup','.searchOrder', function(e){

        var searchInput = $(this).val();
    
        
        //alert(searchInput);
        if(searchInput != ''){

            $('.OrderFields').hide();
            $('.searchAppend').show();
            //alert('hide');

        }else{
            $('.OrderFields').show();
            $('.searchAppend').hide();
            //alert('show');
        }
        
        $.ajax({
            type: "GET",
            url: serverPath + "delivery/deliveries/search_order/"+searchInput,
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