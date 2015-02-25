<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Raw Materials', array('controller' => 'raw_materials', 'action' => 'index')); ?>

<div style="clear:both"></div>
<?php echo $this->element('ware_house_option');?>


<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Raw Materials</b></h2>

                  <div class="filter-block pull-right">
                    
                    <?php echo $this->Html->link('<i class="fa fa-plus-circle fa-lg"></i> Add New Raw Material ', array('controller' => 'raw_materials', 'action' => 'add'),array('class' =>'btn btn-primary pull-right','escape' => false));
                     ?>
                </div>
             
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Name</span></a></th>
                                <th><a href="#"><span>Unit</span></a></th>
                                <th><a href="#"><span>Unit/Cost</span></a></th>
                                <th><a href="#"><span>Quantity</span></a></th>
                                <th><a href="#"><span>Description</span></a></th>
                                <th class="text-center"><a href="#"><span>Created</span></a></th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($rawData  as $key => $list) { ?>
                            <tr>
                                <td>
                                    <?php echo $list['RawMaterial']['name'] ?>
                                </td>
                                <td>
                                    <?php echo $list['RawMaterial']['unit'] ?>
                                </td>
                                <td>
                                    <?php echo $list['RawMaterial']['unit_cost'] ?>
                                </td>
                                <td>
                                    <?php echo $list['RawMaterial']['qty'] ?>
                                </td>
                                <td>
                                    <?php echo $list['RawMaterial']['description'] ?>
                                </td>

                                <td class="text-center">
                                    <?php echo date('M d, Y', strtotime($list['RawMaterial']['created'])); ?>
                                </td>
                                <td  class="text-center">
                                <?php
                                // echo $this->Html->link('<span class="fa-stack">
                                //      <i class="fa fa-square fa-stack-2x"></i>
                                //      <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                //      </span> ',
                                //     array('controller' => 'ware_house',
                                //      'action' => 'view',
                                //      ),
                                //     array('class' =>' table-link',
                                //      'escape' => false
                                //      ,'title'=>'View Information'));
                                ?>
                                <?php
                                    echo $this->Html->link('<span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </span> ',
                                    array('controller' => 'raw_materials',
                                    'action' => 'edit',$list['RawMaterial']['id']
                                    ),
                                    array('class' =>' table-link',
                                    'escape' => false,
                                    'title'=>'Edit Information'));
                                ?>
                                <?php
                                    echo $this->Html->link('<span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                    </span>', 
                                    array('controller' => 'raw_materials', 
                                    'action' => 'delete',$list['RawMaterial']['id']
                                    ),
                                    array('class' =>' table-link',
                                    'escape' => false,
                                    'list'=>'Delete Information',
                                    'confirm' => 'Do you want to delete Raw Material?'));
                                ?>
                                </td>
                            </tr>
                            <?php  } ?>
                        </tbody>
                     </table>
                    <hr>
                </div>
<!-- 
            <ul class="pagination pull-right">
                    <?php 
                     echo $this->Paginator->prev('< ' . __('previous'), array('before' => 'a','tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'prev disabled'));
                     echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
                     echo $this->Paginator->next(__('next') . ' >', array('tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'next disabled')); ?>
               
              </ul> -->
              
            </div>
    
        </div>
    </div>
</div>
