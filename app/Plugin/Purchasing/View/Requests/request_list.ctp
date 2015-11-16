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
                        <li class="<?php echo ($active_tab == 'tab-purchased') ? 'active' : '' ?> statusclick" alt="tab-purchased" value = "3"><a href="#tab-purchased" id = 'itemType' data-toggle="tab">Purchased Order</a></li>
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

    $("body").on('keyup','.searchRequest', function(e){

        var searchInput = $(this).val();
    
        
      // alert(searchInput);
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
            url: serverPath + "purchasing/requests/search_request/"+searchInput,
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



    function selectStatus(purchasingStatus) {



        $.ajax({
            type: "GET",
            url: serverPath + "purchasing/requests/index_status/"+purchasingStatus,
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

        //alert(purchasingStatus); 

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