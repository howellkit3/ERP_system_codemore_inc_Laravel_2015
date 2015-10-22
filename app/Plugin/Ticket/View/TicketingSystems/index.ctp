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
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Ticket id</span></a></th>
                                <th><a href="#"><span>Product No. </span></a></th>
                                <th><a href="#"><span>PO No. </span></a></th>
                                <th><a href="#"><span>Item Name </span></a></th>
                                <th><a href="#"><span>Company </span></a></th>
                                <th><a href="#"><span>Created</span></a></th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>

                        <?php echo $this->element('ticket_table'); ?>


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

<script>
    
    $('document').ready(function(e){

function searchJobTicket() {

        $this = $('.searchTickets');

        $container = $('.result_ticket_table');

        $container.html('<img src="'+serverPath+'/img/loader.gif"/>');

        $.ajax({

        url: serverPath + "ticket/ticketing_systems/index/",
        type: "GET",
        dataType: "html",
        data : {'name' : $this.val() },
        success: function(data) {
            

             $container.html(data); 
            
            }
        }); 
}

var timeout;

$('.searchTickets').keypress(function() {
    if(timeout) {
        clearTimeout(timeout);
        timeout = null;
    }

    timeout = setTimeout(searchJobTicket,400)
})


     });




</script>