<style type="text/css">.main-box > h1 {padding: 20px 0 6px 20px;}</style>
<?php echo $this->Html->css('/Sales/css/default'); ?>

<?php 
$active_page = !empty($this->params['controller']) ? $this->params['controller'] : '';
$active_action = !empty($this->params['action']) ? $this->params['action'] : '';
?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           <?php $page =($active_page == 'receivings' && $active_action == 'index') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Receivings</span>", array('controller' => 'receivings', 'action' => 'index'),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>
        
        <li class="dropdown hidden-xs active">
           <?php $page =($active_page == 'receivings' && $active_action == 'receive') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>In Record</span>", array('controller' => 'receivings', 'action' => 'receive'),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>

         <li class="dropdown hidden-xs active">
           <?php $page =($active_page == 'receivings' && $active_action == 'out_record') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Out Record</span>", array('controller' => 'receivings', 'action' => 'out_record'),array('escape' => false,'class' => 'btn '.$page )); ?>
           
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