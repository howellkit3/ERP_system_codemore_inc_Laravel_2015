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

            </div> 
                
            </header>

            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box clearfix">
                        <ul class="nav nav-tabs">
                                    <li class="<?php echo ($active_tab == 'tab-waiting') ? 'active' : '' ?> statusclick" alt="tab-waiting" value = "1"><a href="#tab-waiting" data-toggle="tab">Waiting</a></li>
                                    <li class="<?php echo ($active_tab == 'tab-due') ? 'active' : '' ?> statusclick" alt="tab-due" value = "2"><a href="#tab-due" id = 'itemType' data-toggle="tab">Due</a></li>
                                    <li class="<?php echo ($active_tab == 'tab-approved') ? 'active' : '' ?> statusclick" alt="tab-approved" value = "3"><a href="#tab-approved" id = 'itemType' data-toggle="tab">Approved</a></li>
                                    <li class="<?php echo ($active_tab == 'tab-closed') ? 'active' : '' ?> statusclick" alt="tab-closed" value = "4"><a href="#tab-closed" id = 'itemType' data-toggle="tab">Closed</a></li>
                                    <li class="<?php echo ($active_tab == 'tab-completed') ? 'active' : '' ?> statusclick" alt="tab-completed" value = "5"><a href="#tab-completed" id = 'itemType' data-toggle="tab">Completed</a></li>
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