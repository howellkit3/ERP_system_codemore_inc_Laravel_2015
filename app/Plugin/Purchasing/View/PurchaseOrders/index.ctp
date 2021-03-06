<?php $this->Html->addCrumb('Request List', array('controller' => 'requests', 'action' => 'request_list')); ?>

<?php $active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : 'tab-waiting'; ?>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?><br><br>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix">
            <ul class="nav nav-tabs">
                        <li class="<?php echo ($active_tab == 'tab-waiting') ? 'active' : '' ?> statusclick" alt="tab-waiting" value = "1"><a href="#tab-waiting" data-toggle="tab">Waiting</a></li>
                        <li class="<?php echo ($active_tab == 'tab-approved') ? 'active' : '' ?> statusclick" alt="tab-approved" value = "2"><a href="#tab-approved" id = 'itemType' data-toggle="tab">Approved</a></li>
                        <li class="<?php echo ($active_tab == 'tab-received') ? 'active' : '' ?> statusclick" alt="tab-received" value = "3"><a href="#tab-received" id = 'itemType' data-toggle="tab">Received by Warehouse</a></li>
                        <li class="<?php echo ($active_tab == 'tab-received') ? 'active' : '' ?> statusclick" alt="tab-received" value = "4"><a href="#tab-received" id = 'itemType' data-toggle="tab">Received by Cash</a></li>
                    </ul>

            <div class="main-box-body clearfix">
                <div class="tabs-wrapper">                  
                    <div class="tab-content">
                             
                            <section class = "requestStatusAppend">
                            </section>
                                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var timeout;

    $("body").on('keyup','.searchOrder', function(e){

        if(timeout) {
            clearTimeout(timeout);
            timeout = null;
        }

        timeout = setTimeout(searchSI,600)
    })

    function searchSI(searchInput) {

        var searchInput = $('.searchOrder').val();
        var status = $('.searchOrder').attr("val"); 

        if(searchInput != ''){

            $('.requestFields').hide();
            $('.searchAppend').show();
            //alert('hide');

        }else{
            $('.requestFields').show();
            $('.searchAppend').hide();
            //alert('show');
        }
        
        $.ajax({
            type: "GET",
            url: serverPath + "purchasing/purchase_orders/search_order/"+searchInput+"/"+status,
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

    // $("body").on('keyup','.searchOrder', function(e){

    //     var searchInput = $(this).val();
    //     var status = $(this).attr("val");
        
      
    //     if(searchInput != ''){

    //         $('.requestFields').hide();
    //         $('.searchAppend').show();
    //         //alert('hide');

    //     }else{
    //         $('.requestFields').show();
    //         $('.searchAppend').hide();
    //         //alert('show');
    //     }
        
    //     $.ajax({
    //         type: "GET",
    //         url: serverPath + "purchasing/purchase_orders/search_order/"+searchInput+"/"+status,
    //         dataType: "html",
    //         success: function(data) {

    //             //alert(data);

    //             if(data){

    //                 $('.searchAppend').html(data);

    //             } 
    //             if (data.length < 5 ) {

    //                 $('.searchAppend').html('<font color="red"><b>No result..</b></font>');
                     
    //             }
                
    //         }
    //     });

    // });



    function selectStatus(purchasingStatus) {

        $.ajax({
            type: "GET",
            url: serverPath + "purchasing/purchase_orders/index_status/"+purchasingStatus,
            dataType: "html",
            success: function(data) {

                if(data){

                    $('.requestStatusAppend').html(data);

                } 
                
            }
        });
    }

    $( document ).ready(function() {

        purchasingStatus = 1;

        selectStatus(purchasingStatus);

    });

    $('.statusclick').click(function() {

        purchasingStatus = $(this).val();

        selectStatus(purchasingStatus);

    });
     $('body').on('click','#item_type_pagination a',function(e) {

        $url = $(this).attr('href');


        $.ajax({
            type: "GET",
            url: $url,
            dataType: "html",
            success: function(data) {

                if(data){

                    $('.requestStatusAppend').html(data);

                } 
                
            }
        });


        e.preventDefault();
    });

</script>