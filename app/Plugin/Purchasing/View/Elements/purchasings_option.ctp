<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Supplier Info</span>", array('controller' => 'suppliers', 'action' => 'index'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
   		
   		<li class="dropdown hidden-xs active">
           
            <?php echo $this->Html->link("<span class='count'>Request List</span>", array('controller' => 'suppliers', 'action' => 'request_list'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
    </ul>
</div>
<br><br>