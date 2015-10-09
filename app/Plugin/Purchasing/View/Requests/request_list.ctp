<?php $this->Html->addCrumb('Request List', array('controller' => 'requests', 'action' => 'request_list')); ?>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?><br><br>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">

          <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Request List</b></h2>
                
                <div class="filter-block pull-right">
                    <div class="form-group pull-left">
                        
                            <input placeholder="Search..." class="form-control searchRequest "  />
                            <i class="fa fa-search search-icon"></i>
                        
                    </div>
                    <?php

                         echo $this->Html->link('<i class="fa fa-plus-circle fa-lg"></i> Add Request ', array('controller' => 'requests', 'action' => 'create'),array('class' =>'btn btn-primary pull-right','escape' => false));
                       
                    ?>
                </div>
            </header>

         
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Request #</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Prepared by</th>
                                <th class="text-center">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody aria-relevant="all" aria-live="polite" class="requestFields" role="alert" >
                          
                            <?php 
                                echo $this->element('request_table'
                            ); 
                            ?>
                         
                        </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
                        </tbody>
                     </table>
                    <hr>
                </div>

          <div class="paging" id="item_type_pagination">
                                <?php
                                echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                                echo $this->Paginator->numbers(array('separator' => ''));
                                echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                                ?>
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

</script>