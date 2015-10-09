<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php echo $this->Html->script('Sales.searchQuotation');?>
<div style="clear:both"></div>

<?php 
  /* echo $this->Html->script('jquery');
   $this->Paginator->options(array(
      'update' => '#CompanyTable',
      'before' => $this->Js->get("#loader")->effect('fadeIn', array('buffer' => false)),
      'complete' => $this->Js->get("#loader")->effect('fadeOut', array('buffer' => false)),
   )); */
?>
<div id="CompanyTable">
<?php echo $this->element('settings_option');?><br><br>
        <?php echo phpversion()  ?>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Machines</b></h2>
                
                <div class="filter-block pull-right">
                    <div class="form-group pull-left">
                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
                            <input placeholder="Search..." class="form-control searchCustomer <?php echo $noPermission; ?>"  />
                            <i class="fa fa-search search-icon"></i>
                         <?php //echo $this->Form->end(); ?>
                    </div>
                    <?php

                        echo $this->Html->link('<i class="fa fa-plus-circle fa-lg"></i> Add Machine ','#machineModal',array('class' =>'btn btn-primary pull-right '. $noPermission,'escape' => false,'data-toggle' => 'modal'));
                       
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
                                <th><a href="#"><span>Plate</span></a></th>
                                <th><a href="#"><span>Paper Gripper</span></a></th>
                                <th><a href="#"><span>Plate Gripper</span></a></th>

                                <th><a href="#"><span>Actions</span></a></th>
                               <!--  <th>Action</th> -->
                            </tr>
                        </thead>

                        <tbody aria-relevant="all" aria-live="polite" class="customerFields" role="alert">
                        	<?php foreach ($machines as $key => $list) { ?>
                        			<tr>
                            			<td> <?php echo $list['Machine']['name'] ?></td>
                            			<td> <?php echo $list['Machine']['description'] ?> </td>
                                        <td> <?php echo $list['Machine']['plate'] ?> </td>
                                        <td> <?php echo $list['Machine']['paper_gripper'] ?> </td>
                                        <td> <?php echo $list['Machine']['plate_gripper'] ?> </td>
                                        <td> 


                                         <?php
                                                        echo $this->Html->link('<span class="fa-stack">
                                                                                <i class="fa fa-square fa-stack-2x"></i>
                                                                                <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                                                                                </span>', 
                                                                                        array(
                                                                               'controller' => 'settings', 
                                                                               'action' => 'delete_machine',
                                                                               $list['Machine']['id']

                                                                                        ), 
                                                                                        array(
                                                                                'class' =>' table-link', 
                                                                                'escape' => false, 
                                                                                'title'=>'Delete Machine', 
                                                                                'confirm' => 'Do you want to delete this machine ?'
                                                                                ));
                                                    ?>
                                         </td>
                            	</tr>	
                        	<?php } ?>
                            	
                        </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" style="display:none;">
                        </tbody>
 
                    </table>
                    <hr>

                <div class="paging">
                <?php

                echo $this->Paginator->prev('< ' . __('previous'), null, null, array('class' => 'disable'));
                echo $this->Paginator->numbers(array('separator' => ''));
                echo $this->Paginator->next(__('next') . ' >', null, null, array('class' => 'disable'));
                ?>
                </div>
                <?php //echo $this->Html->image('loader.gif', array('class' => 'hide', 'id' => 'loader')); ?>
                <?php //echo $this->Js->writeBuffer(); ?>
                </div>
                <div hidden>
                    <ul class="pagination pull-right" >
                        <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
    
        </div>
    </div>
</div>
</div>
<?php echo $this->element('modal/machine');?>