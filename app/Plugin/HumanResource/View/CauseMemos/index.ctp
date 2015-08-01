<?php echo $this->element('hr_options');
    $active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : 'tab-employee';
 ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <ul class="nav nav-tabs">
                    <li class="<?php echo ($active_tab == 'tab-employee') ? 'active' : '' ?>" alt="tab-category"><a href="#tab-employee" data-toggle="tab">Cause Memos</a></li>
                    <li class="<?php echo ($active_tab == 'tab-violation') ? 'active' : '' ?>" alt="tab-type"><a href="#tab-violation" id = 'itemType' data-toggle="tab">Violation</a></li>
                    <li class="<?php echo ($active_tab == 'tab-disciplinary') ? 'active' : '' ?>" alt="tab-type"><a href="#tab-disciplinary" id = 'itemType' data-toggle="tab">Disciplinary Action</a></li>
            </ul>
        <div class="main-box-body clearfix">
            <div class="tabs-wrapper">
                <div class="tab-content">
                    <div class="tab-pane fade  <?php echo ($active_tab == 'tab-employee') ? 'in active' : '' ?>" id="tab-employee">
                        <header class="main-box-header clearfix">
                            <h2 class="pull-left"><b>Cause Memo Request List</b></h2>
                            <div class="filter-block pull-right">
                             <div class="form-group pull-left">
                                    <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
                                        <input placeholder="Search..." class="form-control searchMemo"  />
                                        <i class="fa fa-search search-icon"></i>
                                     <?php //echo $this->Form->end(); ?>
                                </div>
                               <?php
                               
                                  echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add Request', 
                                        array('controller' => 'cause_memos', 
                                                'action' => 'add',),
                                        array('class' =>'btn btn-primary pull-right',
                                            'escape' => false));

                                ?> 
                              
                               <br><br>
                           </div>
                        </header>
                        <div class="main-box-body clearfix">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th><a href="#"><span>Code</span></a></th>
                                            <th><a href="#"><span>Employee</span></a></th>
                                            <th class=""><a href="#"><span>Description</span></a></th>
                                            <th class=""><a href="#"><span>Violation</span></a></th>
                                            <th class=""><a href="#"><span>Status</span></a></th>
                                            <th><a href="#"><span>Actions</span></a></th>
                                        </tr>
                                    </thead>

                        <tbody aria-relevant="all" aria-live="polite" class="OrderFields" role="alert" >
                            <!-- <div class ="field"> -->
                            <?php echo $this->element('cause_memos_table'); ?> 
                            <!-- </div> -->
                        </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
                        </tbody>


                                </table>    

                                <hr>

                                <div class="paging" id="item_type_pagination">
                                        <?php
                                       
                                        echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable','model' => 'ClientOrder'));
                                        echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Employee'), array('paginate' => 'Employee'));
                                        echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable'));

                                        ?>
                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade  <?php echo ($active_tab == 'tab-violation') ? 'in active' : '' ?>" id="tab-violation">
                        <header class="main-box-header clearfix">
                            <h2 class="pull-left"><b>Violation List</b></h2>
                            <div class="filter-block pull-right">
                             <div class="form-group pull-left">
                                   
                                </div>
                               <?php
                               
                                  echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add Violation', 
                                        array('controller' => 'cause_memos', 
                                                'action' => 'add_violation',),
                                        array('class' =>'btn btn-primary pull-right',
                                            'escape' => false));

                                ?> 
                              
                               <br><br>
                           </div>
                        </header>
                        <div class="main-box-body clearfix">
                            <div class="table-responsive">
                                 <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th><a href="#"><span>Name</span></a></th>
                                            <th class=""><a href="#"><span>Description/span></a></th>
                                            <th class=""><a href="#"><span>Created</span></a></th>
                                            <th class=""><a href="#"><span>Created by</span></a></th>
                                            <th><a href="#"><span>Actions</span></a></th>
                                        </tr>
                                    </thead>

                                    <?php echo $this->element('violation_table'); ?> 
                                
                                </table>    

                                <hr>

                                <div class="paging" id="item_type_pagination">
                                        <?php
                                       
                                        echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable','model' => 'ClientOrder'));
                                        echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Employee'), array('paginate' => 'Employee'));
                                        echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable'));

                                        ?>
                                </div>

                            </div>
                        </div>
                    </div>



                    <div class="tab-pane fade  <?php echo ($active_tab == 'tab-disciplinary') ? 'in active' : '' ?>" id="tab-disciplinary">
                        <header class="main-box-header clearfix">
                            <h2 class="pull-left"><b>Disciplinary Action</b></h2>
                            <div class="filter-block pull-right">
                             <div class="form-group pull-left">
                                    
                                </div>
                               <?php
                                    echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i>Add Disciplinary Action', 
                                        array('controller' => 'cause_memos', 
                                                'action' => 'add_disciplinary_action',),
                                        array('class' =>'btn btn-primary pull-right',
                                            'escape' => false));

                                ?> 
                              <br><br>
                           </div>
                        </header>
                        <div class="main-box-body clearfix">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th><a href="#"><span>Name</span></a></th>
                                            <th class=""><a href="#"><span>Created by</span></a></th>
                                            <th class=""><a href="#"><span>Created</span></a></th>
                                            <th><a href="#"><span>Actions</span></a></th>
                                        </tr>
                                    </thead>
                                      
                                    <?php echo $this->element('disciplinary_action_table'); ?> 
                                
                                </table>    

                                <hr>

                               <!--  <div class="paging" id="item_type_pagination">
                                        <?php
                                       
                                        echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable','model' => 'ClientOrder'));
                                        echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Employee'), array('paginate' => 'Employee'));
                                        echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable'));

                                        ?>
                                </div> -->

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

    $("body").on('keyup','.searchMemo', function(e){

        var searchInput = $(this).val();
    
        
       // alert(searchInput);
        if(searchInput != ''){

            $('.memoField').hide();
            $('.searchAppend').show();
            //alert('hide');

        }else{
            $('.memoField').show();
            $('.searchAppend').hide();
            //alert('show');
        }
        
        $.ajax({
            type: "GET",
            url: serverPath + "human_resource/cause_memos/search_memo/"+searchInput,
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