<style type="text/css">.main-box > h1 {padding: 20px 0 6px 20px;}</style>
<?php echo $this->Html->css('/Sales/css/default'); ?>

<?php 
$active_page = !empty($this->params['controller']) ? $this->params['controller'] : '';
$active_action = !empty($this->params['action']) ? $this->params['action'] : '';
?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           <?php $page =($active_page == 'suppliers' && $active_action == 'index') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Supplier Info</span>", array('controller' => 'suppliers', 'action' => 'index'),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>
   		
   		<li class="dropdown hidden-xs active">
           <?php $page =($active_page == 'requests' && $active_action == 'request_list') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Request List</span>", array('controller' => 'requests', 'action' => 'request_list'),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>

        <li class="dropdown hidden-xs active">
           <?php $page =($active_page == 'requests' && $active_action == 'purchase_order_list') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Purchase Order</span>", array('controller' => 'requests', 'action' => 'purchase_order_list'),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>
    </ul>
</div>
<br><br>

<style>

.tab{

box-shadow: inset 0 3px 5px rgba(0,0,0,0.125);

}
/*  webkit-box-shadow: inset 0 3px 5px rgba(0,0,0,0.125);*/
 

</style>