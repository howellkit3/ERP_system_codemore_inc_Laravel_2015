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

            </div> 
                
            </header>

            <div class="row">
                <div class="col-lg-12">


            
            <div class="main-box-body clearfix ">
                <div class="table-responsive">
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr >
                                <th class="text-center"><a href="#"><span>Schedule#</span></a></th>
                                <th class="text-center"><a href="#"><span>Client Order#</span></a></th>
                                <th class="text-center"><a href="#"><span>P.O. Number</span></a></th>
                                <th class="text-center"><a href="#"><span>Customer Name</span></a></th>
                                <th class="text-center"><a href="#"><span>Item Name</span></a></th>
                                <th class="text-center"><a href="#"><span>Quantity</span></a></th>
                                <th class="text-center"><a href="#"><span>P.O. Balance</span></a></th>
                                <th class="text-center"><a href="#"><span>Status</span></a></th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody aria-relevant="all" aria-live="polite" class="OrderFields" role="alert" >
                            
                             <?php  if(!empty($clientsOrder)){ ?>
                                    <?php foreach ($clientsOrder as $scheduleDataList): 

                                        if($scheduleDataList['ClientOrder']['status_id'] == null  && $scheduleDataList['ClientOrderDeliverySchedule']['status_id'] == 0){ ?>

                                         <tr class="">

                                              <td class="text-center">
                                                  <?php  echo !empty($jobTicketData[$scheduleDataList['ClientOrder']['id']]) ? $jobTicketData[$scheduleDataList['ClientOrder']['id']] : "No Job Ticket yet"; ?>  
                                              </td>

                                              <td class="text-center">

                                                  <?php  echo $scheduleDataList['ClientOrder']['uuid']; ?>  
                                              
                                              </td>

                                              <td class="text-center">

                                                  <?php  echo $scheduleDataList['ClientOrder']['po_number']; ?>  
                                              
                                              </td>

                                              <td class="text-center">

                                              <?php echo substr($scheduleDataList['Company']['company_name'],0,25);  ?> ..

                                              
                                              </td>

                                              <td class="text-center">
                              
                                           <?php echo substr($scheduleDataList['Product']['name'],0,20);  ?>..
                                           
                                        </td>

                                              <td class="text-center">

                                                 <?php echo $scheduleDataList['ClientOrderDeliverySchedule']['quantity']; ?>  

                                              </td>

                                              <td class="text-center" >

                                                <?php 
                                                  
                                                  $uuidClients = $scheduleDataList['ClientOrderDeliverySchedule']['uuid'];
                                                      $arrholder = array();

                                                       foreach ($deliveryStatus as $key => $value) {

                                                    
                                                        $IdClientsOrder = !empty($scheduleDataList['Delivery']['dr_uuid']) ? $scheduleDataList['Delivery']['dr_uuid'] : "";

                                                                      
                                                          if($value['Delivery']['schedule_uuid'] == $scheduleDataList['ClientOrderDeliverySchedule']['uuid'] && $value['Delivery']['clients_order_id'] == $scheduleDataList['ClientOrder']['uuid']){  

                                                            if($value['DeliveryDetail']['status'] == 3 && $value['Delivery']['status'] == 1){
                                              
                                                                $difference = empty($value['DeliveryDetail']['delivered_quantity']) ? $value['DeliveryDetail']['quantity'] : $value['DeliveryDetail']['delivered_quantity'] ; 

                                                                  array_push($arrholder,$difference);
                                                                
                                                            }else if ($value['DeliveryDetail']['status'] != 5 && $value['Delivery']['status'] == 1){

                                                                $difference = $value['DeliveryDetail']['quantity']; 

                                                                  array_push($arrholder,$difference);
                                                  
                                                            }

                                                          }  
                                                                                                          
                                                        }


                                                   echo($scheduleDataList['ClientOrderDeliverySchedule']['quantity'] - array_sum($arrholder));?> 

                                                  <br>

                                              </td >

                                              <td class="text-center">

                                                      <?php 

                                                      $uuidClientsOrder = $scheduleDataList['ClientOrderDeliverySchedule']['uuid'];
                                                     

                                                      $arr = array();

                                                       foreach ($deliveryStatus as $key => $value) {

                                                        $IdClientsOrder = !empty($scheduleDataList['Delivery']['dr_uuid']) ? $scheduleDataList['Delivery']['dr_uuid'] : "";

                                                          if($value['Delivery']['schedule_uuid'] == $scheduleDataList['ClientOrderDeliverySchedule']['uuid'] &&  $value['DeliveryDetail']['status'] == 3 ){  

                                                            if($value['DeliveryDetail']['status'] != 5){
                                                         
                                                            array_push($arr,$value['DeliveryDetail']['delivered_quantity']);

                                                          }

                                                        }  
                                                          
                                                      }

                                                      $Scheddate = $scheduleDataList['ClientOrderDeliverySchedule']['schedule'];

                                                      $Currentdate = date("Y-m-d H:i:s");

                                                      $Scheddate = str_replace('-', '', $Scheddate);
                                                      
                                                      $Currentdate = str_replace('-', '', $Currentdate); 

                                                      if (array_sum($arr) == $scheduleDataList['ClientOrderDeliverySchedule']['quantity']){ 

                                                          echo "<span class='label label-success'>Completed</span>";
                                        
                                                      }elseif (array_sum($arrholder) != 0) { 
                                                            
                                                           echo "<span class='label label-warning'>Approved</span>"; ?> &nbsp<?php
                                                        

                                                      }else{

                                                          echo "<span class='label label-default'>Waiting</span>"; ?> &nbsp


                                                          <?php    

                                                            $Scheddate = date('Y-m-d',strtotime($Scheddate)).' 23:00:00';

                                                          if(strtotime($Currentdate) >= strtotime( $Scheddate ))
                                                          {
                                                              echo "<span class='label label-danger'>Due</span>"; 
                                                          } 
                                                            
                                                           
                                                  } ?>

                                                      
                                         
                                              </td>

                                              <td class="text-center">

                                                  <?php 

                                                      echo $this->Html->link('<span class="fa-stack">
                                                               <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;
                                                                <span class ="post"><font size = "1px"></font></span>
                                                                </span> ', array('controller' => 'deliveries', 
                                                                               'action' => 'view',
                                                               $scheduleDataList['ClientOrderDeliverySchedule']['id'], $scheduleDataList['ClientOrderDeliverySchedule']['uuid'], $scheduleDataList['ClientOrder']['uuid'], 1),
                                                                array('class' =>' table-link small-link-icon '.$noPermissionSales,'escape' => false,'title'=>'Edit Information'
                                                           )); 
                                                  ?>     

                                                  <?php 

                                                      echo $this->Html->link('<span class="fa-stack">
                                                          <i class="fa fa-square fa-stack-2x"></i>
                                                          <i class="fa fa-trash fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px">  </font></span>
                                                          </span>', array('controller' => 'deliveries', 'action' => 'terminate',$scheduleDataList['ClientOrderDeliverySchedule']['id'], 1),array('class' =>' table-link','escape' => false,'title'=>'Edit Information','confirm' => 'Do you want to remove this client order delivery schedule in the list?'));

                                                      ?>

                                                  <br>
                                                   
                                              </td>
                                          </tr>
                                          

                                      <?php 
                                          }
                                        endforeach; 
                                      } ?> 

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