<?php $this->Html->addCrumb('Ticketing System', array('controller' => 'ticketing_systems', 'action' => 'index')); ?>
<?php echo $this->Html->script('underscore'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Ticketing Lists</b></h2>
                   <div class="filter-block pull-right">
                    <div class="form-group pull-left">
                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
                            <input placeholder="Search..." class="form-control searchTickets"  />
                            <i class="fa fa-search search-icon"></i>
                         <?php //echo $this->Form->end(); ?>
                    </div>
                    <?php

                    ?>
                </div>
            </header>

            <div class="clearfix"></div>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover sortable">
                        <thead>
                            <tr>
                                <th class="table-header" >Ticket id</th>
                                <th class="table-header">Company</th>
                                <th class="table-header" >Client Order #</th>
                             <!--    <th class="table-header" >Product No.</th> -->
                                <th class="table-header">PO No.</th>
                                <th class="table-header">Item Name </th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>

                        <tbody aria-relevant="all" aria-live="polite" class="requestFields" role="alert" >
                          
                              <?php echo $this->element('ticket_table'); ?>
                         
                        </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
                        </tbody>

                    </table>
                    <hr>
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
</div>
<?php //echo $this->element('sql_dump'); ?>
<style type="text/css">
    .table-header:hover{
        color: #03A9F4;
    }
    .table-header{
        cursor: pointer;
    }
</style>
<script>

    $("body").on('keyup','.searchTickets', function(e){

        var searchInput = $(this).val();
      
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
            url: serverPath + "ticket/ticketing_systems/search_ticket/"+searchInput,
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




