<style type="text/css">.main-box > h1 {padding: 20px 0 6px 20px;}</style>
<?php echo $this->Html->css('/Sales/css/default'); ?>

<?php 
$active_page = !empty($this->params['controller']) ? $this->params['controller'] : '';
$active_action = !empty($this->params['action']) ? $this->params['action'] : '';
//pr($this->params); exit;
?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">
    <?php  if(in_array($userData['User']['role_id'],array('1','2','7','10','6','8','4','16','3','15'))) { ?>

        <li class="dropdown hidden-xs">
          <?php $page =($active_page == 'suppliers' && $active_action == 'index') ? 'active tab' : '' ?>
          <?php echo $this->Html->link("<span class='count'>Supplier Info</span>", array('plugin' => 'purchasing', 'controller' => 'suppliers', 'action' => 'index?'.rand(1000,9999).'='.date("is")),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>

       <?php } ?> 
   		  <?php  if(in_array($userData['User']['role_id'],array('1','2','7','10','6','8','4','16','3','12','15'))) { ?>

   		 <li class="dropdown hidden-xs active">
          <?php $page =($active_page == 'requests' && $active_action == 'request_list') ? 'active tab' : '' ?>
          <?php echo $this->Html->link("<span class='count'>Request List</span>", array('plugin' => 'purchasing', 'controller' => 'requests', 'action' => 'request_list?'.rand(1000,9999).'='.date("is")),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>
        <?php } ?>

         <?php  if(in_array($userData['User']['role_id'],array('1','2','7','10','6','8','4','16','3','15'))) { ?>


        <li class="dropdown hidden-xs active">
          <?php $page =($active_page == 'purchase_orders' && $active_action == 'index') ? 'active tab' : '' ?>
          <?php echo $this->Html->link("<span class='count'>Purchase Order</span>", array('plugin' => 'purchasing', 'controller' => 'purchase_orders', 'action' => 'index?'.rand(1000,9999).'='.date("is")),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>

        <li class="dropdown hidden-xs active">
          <?php $page =($active_page == 'purchase_orders' && $active_action == 'purchased_items') ? 'active tab' : '' ?>
          <?php echo $this->Html->link("<span class='count'>Purchased Items</span>", array('plugin' => 'purchasing', 'controller' => 'purchase_orders', 'action' => 'purchased_items?'.rand(1000,9999).'='.date("is")),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>

        <li class="dropdown hidden-xs active">
          <?php $page =($active_page == 'settings' && $active_action == 'item_group') ? 'active tab' : '' ?>
          <?php echo $this->Html->link("<span class='count'>Item Group</span>", array('controller' => 'settings', 'action' => 'item_group' ,'purchasing?'.rand(1000,9999).'='.date("is"),'plugin' => false),array('escape' => false,'class' => 'btn'.$page)); ?>
           
        </li>

        <?php } ?>
 
    
    </ul>
</div>
<br><br>

<style>

.tab{

box-shadow: inset 0 3px 5px rgba(0,0,0,0.125);

}
/*  webkit-box-shadow: inset 0 3px 5px rgba(0,0,0,0.125);*/
 

</style>