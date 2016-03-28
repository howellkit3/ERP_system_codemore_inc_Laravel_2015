<?php echo $this->element('deliveries_options'); ?><br><br>
<?php $active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : 'tab-waiting';
?>

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
               <!--   <a href="#CustomerDr" class="" data-toggle="modal"><button class="btn btn-success"> <i class="fa fa-paper"></i> Create APC DR </button></a>
 -->
                 <?php 
                 echo $this->Html->link('Create APC DR',array(
                        'controller' => 'deliveries',
                        'action' => 'create_apc_dr'
                        ),
                    array(
                        'class' => 'btn btn-success'
                    )
                 ); ?>
 
            </div> 
                
            </header>

            <div class="row">
                <div class="col-lg-12">


            
            <div class="main-box-body clearfix ">
                <div class="table-responsive">
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr >
                                <th class="text-left"><a href="#"><span>APC DR</span></a></th>
                                <th class="text-left"><a href="#"><span>Customer</span></a></th>
                                <th class="text-left"><a href="#"><span> Schedule </span></a></th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody aria-relevant="all" aria-live="polite" class="OrderFields" role="alert" >
                          <?php if (!empty($deliveries)) : ?>
                          
                                <?php foreach($deliveries as $key => $list) : ?>
                                    <tr>
                                        <td><?php echo $list['ApcDelivery']['apc_dr']; ?></td>

                                        <td><?php echo $list['Company']['company_name']; ?></td>

                                        <td><?php echo !empty($list['ClientOrderDeliverySchedule']['schedule']) ? date('Y/m/d',strtotime($list['ClientOrderDeliverySchedule']['schedule'])) : ''; ?></td>
                                        <td class="text-right">
                                           

                                           <?php 

                            echo $this->Html->link('<span class="fa-stack">
                                                     <i class="fa fa-square fa-stack-2x"></i>
                                                  <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;
                                                      <span class ="post"><font size = "1px">View</font></span>
                                                      </span> ', array('controller' => 'deliveries', 
                                                                     'action' => 'view_apc_dr',
                                                     $list['ApcDelivery']['id']),
                                                      array('class' =>' table-link small-link-icon '.$noPermissionSales,'escape' => false,'title'=>'Edit Information'
                                                 )); 
                            ?>


                                        </td>
                                    </tr>
                            <?php endforeach;?>
                        <?php endif; ?>
                        </tbody>  
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
                        </tbody>

                       <!--  <tbody aria-relevant="all" aria-live="polite" class="" role="alert" style="display:none;">
                        </tbody> -->

                    </table>
                    <hr>
                    <div class="paging" id="dr_pagination">
                    
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
    </div>
</div>


<script>

    function searchOrder(searchInput) {

        $this = $('.searchOrder');

        var searchInput = $('.searchOrder').val();

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
    }

    var timeout;

    $('.searchOrder').keypress(function() {


        if(timeout) {
            clearTimeout(timeout);
            timeout = null;
        }

        timeout = setTimeout(searchOrder,600)
    })


    function selectStatus(deliveryStatus) {

        $.ajax({
            type: "GET",
            url: serverPath + "delivery/deliveries/index_status/"+deliveryStatus,
            dataType: "html",
            success: function(data) {

                if(data){

                    $('.appendHere').html(data);

                } 
                
            }
        });
    }

    $( document ).ready(function() {

        deliveryStatus = 1;

        selectStatus(deliveryStatus);

    });

    $('.statusclick').click(function() {

        deliveryStatus = $(this).val();

        selectStatus(deliveryStatus);

    });
     $('body').on('click','#item_type_pagination a',function(e) {

        $url = $(this).attr('href');


        $.ajax({
            type: "GET",
            url: $url,
            dataType: "html",
            success: function(data) {

                if(data){

                    $('.appendHere').html(data);

                } 
                
            }
        });


        e.preventDefault();
    });


</script>