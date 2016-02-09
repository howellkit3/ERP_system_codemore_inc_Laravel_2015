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

                } 
                if (data.length < 5 ) {

                    $append.html('<font color="red"><b>No result..</b></font>');
                     
                }
                
            }
        });
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

                if(data){

                    $('.appendHere').html(data);

                } 
                
            }
        });


        e.preventDefault();
    });

  });

</script>