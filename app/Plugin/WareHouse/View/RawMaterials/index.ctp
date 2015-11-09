<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Raw Materials', array('controller' => 'raw_materials', 'action' => 'index')); ?>

<?php echo $this->Html->script('WareHouse.custom'); ?>
<div style="clear:both"></div>
<?php echo $this->element('ware_house_option');?>
<br>

<?php $page = !empty($this->params['named']['page']) ? $this->params['named']['page'] : ''; ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Raw Materials</b></h2>

                  <div class="filter-block pull-right">
                    

                    <div class="form-group pull-left">
                        <input class="form-control searchItem" onkeyup="searchItem(this)" placeholder="Search...">
                            <i class="fa fa-search search-icon"></i>
                    </div>
                    
                    <?php echo $this->Html->link('<i class="fa fa-plus-circle fa-lg"></i> Add Raw Material ', array('controller' => 'raw_materials', 'action' => 'add'),array('class' =>'btn btn-primary pull-right','escape' => false));
                     ?>
                </div>
             
            </header>
            
        <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Name</span></a></th>
                                <th><a href="#"><span>Description</span></a></th>
                                <th><a href="#"><span>Measure</span></a></th>
                                <th><a href="#"><span>Type</span></a></th>

                                <th><a href="#"><span>Quantity</span></a></th>
                                <th><a href="#"><span>Stocks</span></a></th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                     
                          <tbody id="result-table">
                               <?php if (!empty($items)) :  ?>
                            <?php foreach ($items  as $key => $list) { ?>
                       
                            <tr>
                                <td>
                                    <?php echo $list['Item']['name'] ?>
                                </td>
                                <td>
                                    <?php echo $list['Item']['description'] ?>
                                </td>
                                <td>
                                    <?php 

                                        if (!empty($list['ItemSpec'][0]['id'])) {


                                                    foreach ($list['ItemSpec'] as $key => $measure) {
                                                        
                                                        echo $measure['width'].' X '.$measure['length'].' '.$measure['unit'];

                                                         echo  ($key >= 0) ? '<br>' : '';
                                                    }
                                        } else {

                                        if (!empty($list['Item']['width']) && !empty($list['Item']['length'])) {


                                            echo $list['Item']['width'].' mm'.' X '. $list['Item']['length'].' mm';

                                        } else {

                                            if (!empty($list['Item']['measure'])) {

                                                echo  $list['Item']['measure'];
                                            }
                                        }

                                        }
                                      
                                  ?>
                                </td>
                                
                                <td>
                                    <?php 
                                    if (!empty($list['ItemCategory']['name'])) {
                                         echo $list['ItemCategory']['name'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo !empty($list['Item']['quantity']) ?  $list['Item']['quantity'] : '-' ?>
                                </td>
                                <td>
                                    <?php echo !empty($list['Item']['remaining_stocks']) ? $list['Item']['remaining_stocks'] : '-';  ?>
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
                                    'action' => 'edit',
                                    $list['Item']['id'],
                                    'page' => $page
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
                                    'action' => 'delete',$list['Item']['id']
                                    ),
                                    array('class' =>' table-link',
                                    'escape' => false,
                                    'list'=>'Delete Information',
                                    'confirm' => 'Do you want to delete this Item?'));
                                ?>
                                </td>
                            </tr>

                            <?php  } ?>
                    <?php endif; ?>
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
