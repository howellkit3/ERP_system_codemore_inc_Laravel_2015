<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           <?php $page = ''; //($active_page == 'receivings' && $active_action == 'index') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'> Departments / User </span>", array('controller' => 'warehous', 'action' => 'index'),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li>

        <li class="dropdown hidden-xs">
           <?php $page = ''; //($active_page == 'receivings' && $active_action == 'index') ? 'active tab' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Categories</span>", array('controller' => 'receivings', 'action' => 'index'),array('escape' => false,'class' => 'btn '.$page )); ?>
           
        </li> 

    </ul>
</div>  