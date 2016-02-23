<?php //echo $this->Html->script('Deliveries.searchOrder');?>
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

                   <a href="#CustomerDr" class="" data-toggle="modal"><button class="btn btn-success"> <i class="fa fa-paper"></i> Create DR </button></a>
 

             </div> 
                
            </header>

            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box clearfix">
                        <ul class="nav nav-tabs">
                                    <li class="<?php echo ($active_tab == 'tab-waiting') ? 'active' : '' ?> statusclick" alt="tab-waiting" value = "1"><a href="#tab-waiting" data-toggle="tab">Clients Orders</a></li>
                                    <li class="<?php echo ($active_tab == 'tab-dr-num') ? 'active' : '' ?> statusclick" alt="tab-waiting" value="-1"><a href="#tab-dr-num" data-toggle="tab">DR #</a></li>
                                   <!--  <li class="<?php echo ($active_tab == 'tab-due') ? 'active' : '' ?> statusclick" alt="tab-due" value = "2"><a href="#tab-due" id = 'itemType' data-toggle="tab">Due</a></li>
                                    <li class="<?php echo ($active_tab == 'tab-approved') ? 'active' : '' ?> statusclick" alt="tab-approved" value = "3"><a href="#tab-approved" id = 'itemType' data-toggle="tab">Approved</a></li>
                                    <li class="<?php echo ($active_tab == 'tab-closed') ? 'active' : '' ?> statusclick" alt="tab-closed" value = "4"><a href="#tab-closed" id = 'itemType' data-toggle="tab">Closed</a></li>
                                    <li class="<?php echo ($active_tab == 'tab-completed') ? 'active' : '' ?> statusclick" alt="tab-completed" value = "5"><a href="#tab-completed" id = 'itemType' data-toggle="tab">Completed</a></li> -->
                         </ul>
                        <div class="main-box-body clearfix">
                            <div class="tabs-wrapper">                  
                                <div class="tab-content">
                                
                                    <section class = "appendHere">
                                    </section>
                                    

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             
        </div>
    </div>
</div>

 <div class="modal fade" id="CustomerDr" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content margintop">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Create Delivery Reciept</h4>
                </div>
                 <?php echo $this->Form->create('Delivery',array('url' => array(
                        'controller' => 'deliveries',
                        'action' => 'create_delivery_dr'
                 ))); ?>
                     
                    <div class="modal-body">

                        <div class="form-group" id="existing_items">

                            <label class="col-lg-2 control-label"><span style="color:red">*</span> Customer </label>
                            
                            <div class="col-lg-10">
                                <?php 
                                    
                                    echo $this->Form->input('company_id', array(
                                                            'class' => 'form-control item_type required',
                                                            'label' => false,
                                                            'required' => 'required',
                                                            'options' => $companyData
                                                           // 'value' => $deliveryDataList['Delivery']['dr_uuid']
                                                            ));


                                 ?>
                            </div>

                            

                        </div> 

                        <div class="clearfix"></div>
                        <br>
                    <div class="form-group" id="existing_items">

                           

                              <label class="col-lg-2 control-label"><span style="color:red">*</span> DR # </label>
                            
                            <div class="col-lg-4">
                                <?php 
                                    
                                    echo $this->Form->input('dr_uuid', array(
                                                            'class' => 'form-control item_type required',
                                                            'label' => false,
                                                            'required' => 'required',
                                                           // 'value' => $deliveryDataList['Delivery']['dr_uuid']
                                                            ));


                                 ?>
                            </div>

                             <label class="col-lg-2 control-label"><span style="color:red">*</span> DR Type </label>
                            
                            <div class="col-lg-4">
                                <?php 
                                    
                                    echo $this->Form->input('dr_type', array(
                                                            'class' => 'form-control item_type required',
                                                            'label' => false,
                                                            'required' => 'required',
                                                            'options' => array(
                                                                'dr' => 'Regular',
                                                                'apc' => 'APC',
                                                            )
                                                           // 'value' => $deliveryDataList['Delivery']['dr_uuid']
                                                            ));


                                 ?>
                            </div>

                        </div> 

                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group" >
                        <div class="table-responsive">
                            <table class="table table-bordered">
                            <thead>
                                <tr>
                                 <th><input type="checkbox" name="select_all" id="selectAll"></th>
                                <th><a href="#"><span>Item</span></a></th>
                                <th><a class="desc" href="#"><span> Po Number </span></a></th>
                                <th><a class="asc" href="#"><span>Quantity</span></a></th>
                                <th class="text-left"><span>Pieces</span></th>
                                <th class="text-right"><span>Remarks</span></th>
                                </tr>
                                </thead>
                                <tbody id="resultBox">

                                </tbody>
                            </table>
                        </div>
                        </div>
                        <div class="clearfix"></div>
                         <div class="form-group" >
                               <label class="col-lg-3 control-label"> Remarks </label>
                            

                                <?php echo $this->Form->input('remarks',array(
                                        'label' => false,
                                        'class' => 'form-control',
                                        'type' => 'text',
                                        'type' => 'textarea'
                                )); ?>
                         </div>
                         <div class="clearfix"></div>
                        <div class="result"></div>
                            <br>
                        <div class="modal-footer">
                            <a href="/delivery/">
                             <a class="print_dr" href="#">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-lg"></i> Submit </button>
                         </a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>
                   
                </div>

                    <?php echo $this->Form->end(); ?>   
                
            </div>
        </div>
    </div>


<script>

    function searchOrder(searchInput) {

        $this = $('.searchOrder');


        $('.main-box-body .searchAppend').html('<img class="loader" src="'+serverPath+'/img/loader.gif">');

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
          $append = $('.searchAppend');
        
        var url = serverPath + "delivery/deliveries/search_order/"+searchInput;

        if ( $this.hasClass('by_dr') == true) {

             url = serverPath + "delivery/deliveries/search_by_number?s="+searchInput; 

             $append = $('.appendHere');
        }

        $.ajax({
            type: "GET",
            url: url,
            dataType: "html",
            'data': {'search' : searchInput } ,
            success: function(data) {

                 $('.loader').remove();
                //alert(data);

                if(data){

                    $append.html(data);

                         if(searchInput != ''){

                            $('#item_type_pagination').hide();
                         } else {
                                 $('#item_type_pagination').show();
                         }

                } 
                if (data.length < 5 ) {

                    $append.html('<font color="red"><b>No result..</b></font>');
                     
                }



                
            }
        });

           //$('#item_type_pagination').show();
    }


        function selectStatus(deliveryStatus) {

    $('.main-box-body .appendHere').html('<img class="loader" src="'+serverPath+'/img/loader.gif">');

     var url =  serverPath + "delivery/deliveries/index_status/"+deliveryStatus;

       if (deliveryStatus == '-1') {

            url =  serverPath + "delivery/deliveries/search_by_number/"+deliveryStatus;

            $('.searchOrder').addClass('by_dr');
        } else {
             $('.searchOrder').removeClass('by_dr');
        }

    
        $.ajax({
            type: "GET",
            url: url,
            dataType: "html",
            success: function(data) {
                
                $('.loader').remove();

                if(data){

                    $('.appendHere').html(data);

                } 


                $('#item_type_pagination').show();
            }
        });
    }


    $( document ).ready(function($) {

        var timeout;

        $('.searchOrder').keypress(function() {


            if(timeout) {
                clearTimeout(timeout);
                timeout = null;
            }

            timeout = setTimeout(searchOrder,600)
        })

        deliveryStatus = 1;

        selectStatus(deliveryStatus);

    $('.statusclick').click(function() {

        deliveryStatus = $(this).val();
        console.log(deliveryStatus);
        selectStatus(deliveryStatus);

    });

    $('body').on('click','#item_type_pagination a',function(e) {

        $url = $(this).attr('href');


        $.ajax({
            type: "GET",
            url: $url,
            dataType: "html",
            success: function(data) {
                
                if (data) {
                    
                    $('.appendHere').html(data);
                
                } 
            
            }
        });


        e.preventDefault();
    });


    $('#selectAll').click(function() {
    var checkboxes = $('#DeliveryIndexForm #resultBox :checkbox');
         if($(this).prop('checked')) {

            checkboxes.prop('checked', true);

        } else {
          
          checkboxes.prop('checked', false);
        }
    });

    $('a[href="#CustomerDr"]').click(function(e){

        $('#DeliveryCompanyId').change();
    });

    $('#DeliveryCompanyId').change(function(e){

        $url = serverPath + 'delivery/deliveries/find_clients_order/';

        $value = $(this).val();

        $container = $('#resultBox');

        $container.html('<img class="loader" src="'+serverPath+'/img/loader.gif">');

        $.ajax({
            type: "GET",
            url: $url,
            data : { 'company_id' : $value },
            dataType: "Html",
            success: function(data) {
                    
            // $html = '';

            // $keys = 0;
            //  $.each(data, function (key, item) {
                
            //               $html = "<tr>";
            //               $html += "<td> <input class='form-control' type='checkbox' value="+item.ClientOrder.id+" name='data[Item]["+$keys+"][client_order_id]'/> ";
            //               $html += "<input class='form-control' type='hidden' value="+item.ClientOrderDeliverySchedule.id+" name='data[Item]["+$keys+"][client_order_delivery_schedule]'/>"; 
            //               $html += "<input class='form-control' type='hidden' value="+item.ClientOrder.uuid+" name='data[Item]["+$keys+"][client_order_id]'/>"; 
            //               $html += "</td>";

            //               $html += "<td></td>"; 
            //               $html += "<td>" + item.Product.name + " <input class='form-control' type='hidden' value="+item.ClientOrder.id+" name='data[Item]["+$keys+"][product_id]'/> </td>";
            //               $html += "<td>" + item.ClientOrder.po_number + "</td>";  
            //               $html += "<td><input class='form-control required' type='text' name='data[Item]["+$keys+"][quantity]'/></td>";  
            //               $html += "<td><input class='form-control required' type='text' name='data[Item]["+$keys+"][pieces]'/></td>";
            //                $html += "<td><input class='form-control required' type='text' name='data[Item]["+$keys+"][remarks]'/></td>";
            //               $html += '</tr>'; 

            //                $keys++;
            // });

             $container.html(data);

            }
        });

        e.preventDefault();
    });


  });

</script>