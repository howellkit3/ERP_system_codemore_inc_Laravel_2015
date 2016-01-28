<?php $this->Html->addCrumb('Suppliers', array('controller' => 'suppliers', 'action' => 'index')); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<div style="clear:both"></div>
<?php echo $this->element('purchasings_option');?><br><br>


<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            

             <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Suppliers List</b></h2>
                
                <div class="filter-block pull-right">
                    <div class="form-group pull-left">
                        
                            <input placeholder="Search..." class="form-control searchSupplier "  />
                            <i class="fa fa-search search-icon"></i>
                        
                    </div>
                    <?php

                         echo $this->Html->link('<i class="fa fa-plus-circle fa-lg"></i> Add Supplier ', array('controller' => 'suppliers', 'action' => 'add'),array('class' =>'btn btn-primary','escape' => false));
                       
                    ?>
                </div>
            </header>
            
            <div class="main-box-body clearfix appendtable" >
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Supplier</span></a></th>
                                <th><a href="#"><span>Website</span></a></th>
                                <th><a href="#"><span>Tin</span></a></th>
                                <th class="text-center"><a href="#"><span>Contact Person</span></a></th>
                                <th class="text-center"><a href="#"><span>Created</span></a></th>
                                <th>Action</th>
                            </tr>
                        </thead>

                         <tbody aria-relevant="all" aria-live="polite" class="supplierFields" role="alert" >
                          
                            <?php 
                        echo $this->element('supplier_order_table',array(
                                'suppliers' => $suppliers
                            )); 
                            ?>
                         
                        </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
                        </tbody>

                        
                            
                     </table>
                    <hr>
                </div>

                <ul class="pagination pull-right">
                        <?php 
                         echo $this->Paginator->prev('< ' . __('previous'), array('before' => 'a','tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'prev disabled'));
                         echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
                         echo $this->Paginator->next(__('next') . ' >', array('tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'next disabled')); ?>
                   
                  </ul>
              
            </div>
    
        </div>
    </div>
</div>

<script>

    $("body").on('keyup','.searchSupplier', function(e){

        var searchInput = $(this).val();
    
        
       // alert(searchInput);
        if(searchInput != ''){

            $('.supplierFields').hide();
            $('.searchAppend').show();
            //alert('hide');

        }else{
            $('.supplierFields').show();
            $('.searchAppend').hide();
            //alert('show');
        }
        
        $.ajax({
            type: "POST",
            url: serverPath + "purchasing/suppliers/search_supplier/"+searchInput,
            dataType: "html",
            success: function(data) {

                //alert(data);

                if(data){

                    $('.appendtable').html(data);

                } 
                if (data.length < 5 ) {

                    $('.appendtable').html('<font color="red"><b>No result..</b></font>');
                     
                }
                
            }
        });



          $('body').on('click','.pagination a',function(e) {

        $url = $(this).attr('href');


        $.ajax({
            type: "GET",
            url: $url,
            dataType: "html",
            success: function(data) {

                if(data){

                    $('.appendtable').html(data);

                } 
                
            }
        });


        e.preventDefault();
    });



    });

</script>

