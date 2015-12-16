<style type="text/css">.main-box > h1 {padding: 20px 0 6px 20px;}</style>
<?php echo $this->Html->css('/Sales/css/default'); ?>

<?php 
$active_page = !empty($this->params['controller']) ? $this->params['controller'] : '';
$active_action = !empty($this->params['action']) ? $this->params['action'] : '';

?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="">
            <?php $page =($active_page == 'deliveries' && $active_action == 'index') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>DR Monitoring</span>", array(
                                                                                            'controller' => 'deliveries', 
                                                                                            'action' => 'index?'.rand(1000,9999).'='.date("is")
                                                                                            ),
                                                                                     array(
                                                                                            'escape' => false,
                                                                                            'class' => 'btn '.$page.' '.$noPermissionSales 
                                                                                            )); 
            ?>
           
        </li>

 <!--        <li class="">
            <?php $page =($active_page == 'deliveries' && $active_action == 'apc_index') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>APC</span>", array(
                                                                                            'controller' => 'deliveries', 
                                                                                            'action' => 'apc_index?'.rand(1000,9999).'='.date("is")
                                                                                            ),
                                                                                     array(
                                                                                            'escape' => false,
                                                                                            'class' => 'btn '.$page.' '.$noPermissionSales 
                                                                                            )); 
            ?>
           
        </li> -->

        <li class="">
            <?php $page =($active_page == 'deliveries' && $active_action == 'delivery_replacing') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>DR Replacing</span>", array(
                                                                                   'controller' => 'deliveries', 
                                                                                    'action' => 'delivery_replacing'
                                                                                    ),
                                                                            array(
                                                                                   'escape' => false,
                                                                                   'class' => 'btn '.$page.' '.$noPermissionSales 
                                                                                   )); 
            ?>
           
        </li>

        <li class="dropdown hidden-xs">
            <?php $page =($active_page == 'deliveries' && $active_action == 'dr_record') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>DR Records</span>", array(
                                                                                   'controller' => 'deliveries', 
                                                                                    'action' => 'dr_record?'.rand(1000,9999).'='.date("is")
                                                                                    ),
                                                                            array(
                                                                                   'escape' => false,
                                                                                   'class' => 'btn '.$page.' '.$noPermissionSales 
                                                                                   )); 
            ?>
           
        </li>

        <li class="dropdown hidden-xs">
            <?php $page =($active_page == 'deliveries' && $active_action == 'dr_summary') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>DR Summary</span>", array(
                                                                                   'controller' => 'deliveries', 
                                                                                    'action' => 'dr_summary?'.rand(1000,9999).'='.date("is")
                                                                                    ),
                                                                            array(
                                                                                   'escape' => false,
                                                                                   'class' => 'btn '.$page.' '.$noPermissionSales 
                                                                                   )); 
            ?>
           
        </li>

         <li class="dropdown hidden-xs">
            <?php $page =($active_page == 'deliveries' && $active_action == 'delivery_transmittal_record') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Transmittal Records</span>", array(
                                                                                   'controller' => 'deliveries', 
                                                                                    'action' => 'delivery_transmittal_record?'.rand(1000,9999).'='.date("is")
                                                                                    ),
                                                                            array(
                                                                                   'escape' => false,
                                                                                   'class' => 'btn '.$page.' '.$noPermissionSales 
                                                                                   )); 
            ?>
           
        </li>

        <li class="dropdown hidden-xs">
            <?php $page =($active_page == 'deliveries' && $active_action == 'gate_pass') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Trucks Gatepass</span>", array(
                                                                                   'controller' => 'deliveries', 
                                                                                    'action' => 'gate_pass?'.rand(1000,9999).'='.date("is")
                                                                                    ),
                                                                            array(
                                                                                   'escape' => false,
                                                                                   'class' => 'btn '.$page.' '.$noPermissionSales 
                                                                                   )); 
            ?>
           
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