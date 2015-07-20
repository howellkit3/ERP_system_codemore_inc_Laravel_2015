<?php $this->Html->addCrumb('Request List', array('controller' => 'requests', 'action' => 'request_list')); ?>
<?php $this->Html->addCrumb('view', array('controller' => 'requests', 'action' => 'view',$requestId)); ?>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?><br><br>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>View Request</b></h2>

                  <div class="filter-block pull-right">
                    
                    <?php 
                    	echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'requests', 'action' => 'request_list'),array('class' =>'btn btn-primary pull-right','escape' => false));
                     ?>
                </div>
                
            </header>

        </div>
    </div>
</div>