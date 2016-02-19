<?php //echo $this->Html->script('Deliveries.searchOrder');?>
<?php echo $this->element('deliveries_options'); ?><br><br>

<?php $active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : 'tab-waiting';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Plants</b></h2>

                <div class="filter-block pull-right">


                <div class="form-group pull-left">
                
                        <input placeholder="Search..." class="form-control searchOrder"  />
                        <i class="fa fa-search search-icon"></i>
                 </div>

                 
                   <?php echo $this->Html->link('Add Plant',array(
                        'controller' => 'plants',
                        'action' => 'add'
                   ),
                        array(
                            'class' => 'btn btn-success'
                        )
                   ); ?>
             </div> 
                
            </header>

            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box clearfix">
                        <div class="main-box-body clearfix appendtable" >
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Name</span></a></th>
                                <th><a href="#"><span>Description</span></a></th>
                                <th>Action</th>
                            </tr>
                        </thead>

                         <tbody aria-relevant="all" aria-live="polite" class="supplierFields" role="alert" >
                        <?php if(!empty($plants)) :?>
                        <?php foreach ($plants as $key => $plant) : ?>
                            <tr>
                                <td> <?php echo $plant['Plant']['name']; ?></td>

                                <td><?php echo $plant['Plant']['description']; ?> </td>

                                <td></td>
                            </tr> 
                        <?php endforeach; ?>
                         <?php endif; ?>
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
             
        </div>
    </div>
</div>