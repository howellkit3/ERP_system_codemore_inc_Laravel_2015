<style type="text/css">.main-box > h1 {padding: 20px 0 6px 20px;}</style>
<?php echo $this->Html->css('/Sales/css/default'); ?>

<?php 
$active_page = !empty($this->params['controller']) ? $this->params['controller'] : '';
$active_action = !empty($this->params['action']) ? $this->params['action'] : '';
?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">


        <?php if(in_array($userData['User']['role_id'],array('1','2','4','7','15','8','16','3'))) { ?>
        <li class="dropdown hidden-xs">
           <?php $page =($active_page == 'receivings' && $active_action == 'index') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Receivings</span>", array('controller' => 'receivings', 'action' => 'index?'.rand(1000,9999).'='.date("is")),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>
        
        <li class="dropdown hidden-xs active">
           <?php $page =($active_page == 'receivings' && $active_action == 'receive') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>In-Record</span>", array('controller' => 'receivings', 'action' => 'receive?'.rand(1000,9999).'='.date("is")),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>

        <?php } ?>

        <li class="dropdown hidden-xs active">
           <?php $page =($active_page == 'warehouse_requests' && $active_action == 'index') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Request</span>", array('controller' => 'warehouse_requests', 'action' => 'index?'.rand(1000,9999).'='.date("is")),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>
         <?php if(in_array($userData['User']['role_id'],array('1','2','4','7','15','8','16','3'))) { ?>
       
         <li class="dropdown hidden-xs active">
           <?php $page =($active_page == 'warehouse_requests' && $active_action == 'stock') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Stocks</span>", array('controller' => 'warehouse_requests', 'action' => 'stock?'.rand(1000,9999).'='.date("is")),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>



        <li class="dropdown hidden-xs active">
           <?php $page =($active_page == 'warehouse_requests' && $active_action == 'outrecord_list') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Out-Record List</span>", array('controller' => 'warehouse_requests', 'action' => 'outrecord_list?'.rand(1000,9999).'='.date("is")),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>

        <li class="dropdown hidden-xs active">
           <?php $page =($active_page == 'consumables' && $active_action == 'index') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Items</span>", array('controller' => 'items', 'action' => 'index?'.rand(1000,9999).'='.date("is")),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>

          <li class="dropdown hidden-xs active">
           <?php $page =($active_page == 'consumables' && $active_action == 'index') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Raw Materials</span>", array('controller' => 'raw_materials', 'action' => 'index?'.rand(1000,9999).'='.date("is")),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>

        <?php } ?>

         <!-- <li class="dropdown hidden-xs active">
           <?php $page =($active_page == 'warehouse_systems' && $active_action == 'settings') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Settings</span>", array('controller' => 'warehouse_systems', 'action' => 'settings'),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li> -->

        

    </ul>
</div>
<br><br>

<style>

.tab{

box-shadow: inset 0 3px 5px rgba(0,0,0,0.125);

}
/*  webkit-box-shadow: inset 0 3px 5px rgba(0,0,0,0.125);*/
 

</style>



<!-- <div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

 
        <li class="dropdown hidden-xs">
        <?php 
            echo $this->Html->link("<span class='count'>Request Stock List
</span>", array(
                                    'controller' => 'request_stocks', 
                                    'action' => 'index',
                                    'plugin' => 'ware_house'
                                    ),
                                    array(
                                    'escape' => false,
                                    'class' => 'btn'
                                    )); 
        ?>
        </li>
          <li class="dropdown hidden-xs">
        <?php 
            echo $this->Html->link("<span class='count'>Raw Materials
</span>", array(
                                    'controller' => 'raw_materials', 
                                    'action' => 'index',
                                    'plugin' => 'ware_house'
                                    ),
                                    array(
                                    'escape' => false,
                                    'class' => 'btn'
                                    )); 
        ?>
        </li>
   
   
    </ul>
</div>
<br><br>
<br><br> -->