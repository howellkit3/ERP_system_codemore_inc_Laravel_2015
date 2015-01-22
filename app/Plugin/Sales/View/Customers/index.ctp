<div class="users form">
    <?php
        echo $this->Html->link( "Sales",   array('plugin' => 'sales', 'controller' => 'customers', 'action' => 'index'));
        echo "---";
        echo $this->Html->link('Add', array('plugin' => 'sales', 'controller' => 'customers', 'action' => 'add'));
        echo "---";
        echo $this->Html->link( "View",   array('controller' =>'sales','action'=>'') );

     
    ?>
 
</div>
<?php
    if($this->Session->check('Auth.User')){
        echo $this->Html->link( "Return to Dashboard",   array('controller' => '../dashboards','action'=>'index') );
        echo "<br>";
        //echo $this->Html->link( "Customer Info",   array('action'=>'add') );

        echo "<br>";
        echo $this->Html->link( "Logout",   array('controller'=>'../users','action'=>'logout') );

    }else{
        echo $this->Html->link( "Return to Login Screen",   array('action'=>'index') );
    }
?>