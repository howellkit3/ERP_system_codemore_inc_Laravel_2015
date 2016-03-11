<?php $this->Html->addCrumb('Suppliers', array('controller' => 'suppliers', 'action' => 'index')); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<div style="clear:both"></div>
<?php echo $this->element('purchasings_option');?><br><br>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
             <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Purchased Items</b></h2>

                <div class="filter-block pull-right">
                    
                       <?php 

                                echo $this->Html->link(
                                        '<button class="form-control btn btn-success">EXPORT</button>',array(
                                            'controller' => 'purchase_orders','action' => 'purchase_item_data','class' => 'btn btn-success'),
                                        array('escape' => false)
                                );

                            ?>
                        </div>
                <div class="filter-block pull-right">
                    
                    <div class="form-group pull-left">

                         
                        
                            <input placeholder="Search..." class="form-control searchItem"  />
                            <i class="fa fa-search search-icon"></i>
                        
                    </div>
                   
                </div>
            </header>

            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Item Name</span></a></th>
                                <th><a href="#"><span>Supplier</span></a></th>
                                <th><a href="#"><span>Quantity</span></a></th>
                                <th><a href="#"><span>Unit Price</span></a></th>
                                <th><a href="#"><span>Total</span></a></th>
                            </tr>
                        </thead>

                        <tbody aria-relevant="all" aria-live="polite" class="supplierFields" role="alert" >
                            <?php echo $this->element('purchased_item_table'); ?>
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

    function searchItem(searchInput) {

        var searchInput = $('.searchItem').val();

        var view = "index";

        if(searchInput != ''){

            $('.searchAppend').show();
            $('.supplierFields').hide();

        }else{

            $('.searchAppend').hide();
            $('.supplierFields').show();

        }

        $.ajax({
                type: "GET",
                url: serverPath + "purchasing/purchase_orders/search_item/"+searchInput,
                dataType: "html",
                success: function(data) {

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

    $('.searchItem').keypress(function() {

        if(timeout) {
            clearTimeout(timeout);
            timeout = null;
        }

        timeout = setTimeout(searchItem,600)
    })

</script>
