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
                                    <li class="<?php echo ($active_tab == 'tab-waiting') ? 'active' : '' ?>" alt="tab-waiting"><a href="#tab-waiting" data-toggle="tab">Waiting</a></li>
                                    <li class="<?php echo ($active_tab == 'tab-due') ? 'active' : '' ?>" alt="tab-due"><a href="#tab-due" id = 'itemType' data-toggle="tab">Due</a></li>
                                    <li class="<?php echo ($active_tab == 'tab-approved') ? 'active' : '' ?>" alt="tab-approved"><a href="#tab-approved" id = 'itemType' data-toggle="tab">Approved</a></li>
                                    <li class="<?php echo ($active_tab == 'tab-closed') ? 'active' : '' ?>" alt="tab-closed"><a href="#tab-closed" id = 'itemType' data-toggle="tab">Closed</a></li>
                                    <li class="<?php echo ($active_tab == 'tab-completed') ? 'active' : '' ?>" alt="tab-completed"><a href="#tab-completed" id = 'itemType' data-toggle="tab">Completed</a></li>
                                </ul>
                        <div class="main-box-body clearfix">
                            <div class="tabs-wrapper">                  
                                <div class="tab-content">
                                    <div class="tab-pane fade  <?php echo ($active_tab == 'tab-waiting') ? 'in active' : '' ?>" id="tab-waiting">
                                         waiting
                                        <?php echo $this->element('index'); ?><br><br>
                                        
                                    </div>

                                    <div class="tab-pane fade  <?php echo ($active_tab == 'tab-due') ? 'in active' : '' ?>" id="tab-due">
                                         due
                                        <?php echo $this->element('index'); ?><br><br>
                                        
                                    </div>

                                     <div class="tab-pane fade  <?php echo ($active_tab == 'tab-approved') ? 'in active' : '' ?>" id="tab-approved">
                                         approved
                                        <?php echo $this->element('index'); ?><br><br>
                                    </div>       

                                    <div class="tab-pane fade  <?php echo ($active_tab == 'tab-closed') ? 'in active' : '' ?>" id="tab-closed">
                                         closed
                                        <?php echo $this->element('index'); ?><br><br>
                                    </div>

                                    <div class="tab-pane fade  <?php echo ($active_tab == 'tab-completed') ? 'in active' : '' ?>" id="tab-completed">
                                         completed
                                        <?php echo $this->element('index'); ?><br><br>
                                    </div>

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

</script>