<?php $this->Html->addCrumb('Settings', array('controller' => 'settings', 'action' => 'department')); ?>
<?php $this->Html->addCrumb('Category', array('controller' => 'settings', 'action' => 'category','tab'=>'category')); ?>
<?php echo $this->element('hr_options');
    $active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : ' ';

 ?>

 <div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            
            <?php echo $this->element('tab/settings',array('active_tab' => $active_tab)); ?>

                <div class="main-box-body clearfix">
                    <div class="tabs-wrapper">
                        <div class="tab-content">
                            <!-- <div class="tab-pane <?php echo ($active_tab == 'position') ? 'active' : '' ?>" id="tab-position"> -->
                            <!-- <div class="tab-pane fade <?php echo ($active_tab == 'position' || $this->params['action'] == 'position') ? 'in active' : '' ?>" id="position"> -->
                            <div class="tab-pane active" id="tab-category">
                                <header class="main-box-header clearfix">
                                    <h2 class="pull-left"><b>Category</b></h2>
                                    <div class="filter-block pull-right">
                                     <div class="form-group pull-left">
                                            <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
                                                <input placeholder="Search..." class="form-control searchCustomer"  />
                                                <i class="fa fa-search search-icon"></i>
                                             <?php //echo $this->Form->end(); ?>
                                        </div>
                                       <?php
                                            echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add Category', 
                                                array('controller' => 'categories', 
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
                                                    <th><a href="#"><span>#</span></a></th>
                                                    <th><a href="#"><span>Name</span></a></th>
                                                    <th class="text-center"><a href="#"><span>Description</span></a></th>
                                                    <th><a href="#"><span>Actions</span></a></th>
                                                </tr>
                                            </thead>
                                              <?php if(!empty($categoryData)) {
                                                    foreach ($categoryData as $key => $categoryList): $key++ ?>
                                                            <tbody aria-relevant="all" aria-live="polite" role="alert">
                                                                <tr class="">
                                                                    <td class="">
                                                                        <?php echo $key;?> 
                                                                    </td>
                                                                    <td class="">
                                                                        <?php echo ucfirst($categoryList['Category']['name']);  ?>
                                                                    </td>
                                                                    
                                                                    <td class="text-center">
                                                                       <?php echo ucfirst($categoryList['Category']['description']);  ?>
                                                                    </td>

                                                                    <td>
                                                                        <?php 
                                                                        echo $this->Html->link('<span class="fa-stack">
                                                                            <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'categories', 'action' => 'view',$categoryList['Category']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Category'
                                                                            ));

                                                                        ?>

                                                                    <?php
                                                                    echo $this->Html->link('<span class="fa-stack">
                                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                                                                    </span> ', array('controller' => 'categories', 'action' => 'edit',$categoryList['Category']['id']),array('class' =>' table-link','escape' => false,'title'=>'Category Tool'));


                                                                    echo $this->Form->postLink('<span class="fa-stack">
                                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                                                                    </span>', array(
                                                                            'controller' => 'categories',
                                                                            'action' => 'delete',
                                                                            'plugin' => 'human_resource',
                                                                            $categoryList['Category']['id']),
                                                                                    array('escape' => false,'class'=> 'table-link'), 
                                                                                    __('Are you sure you want to delete %s?', 
                                                                                    $categoryList['Category']['name'])
                                                                            ); 
                                                                    ?>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                <?php 
                                                    endforeach; 
                                                } ?>  
                                        
                                        </table>    

                                        <hr>

                                        <div class="paging" id="item_type_pagination">
                                                <?php
                                               
                                                echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Category','model' => 'Category'), null, array('class' => 'disable','model' => 'ClientOrder'));
                                                echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Category'), array('paginate' => 'Category'));
                                                echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Category','model' => 'Category'), null, array('class' => 'disable'));

                                                ?>
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