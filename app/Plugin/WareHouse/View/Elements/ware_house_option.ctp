<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
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
<br><br>