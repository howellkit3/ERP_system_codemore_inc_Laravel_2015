<div class="users form">
   <?php
        echo $this->Html->link( "Sales",   array('plugin' => 'sales', 'controller' => 'sales', 'action' => 'index'));
        echo "---";
        echo $this->Html->link(__('Add'), array('controller' => 'customers', 'action' => 'add', 'plugin' => 'sales'));
        //echo $this->Html->link("Add", array('plugin' => 'sales', 'controller' => 'customers', 'action' => 'add'));
        echo "---";
        //echo $this->Html->link( "View",   array('controller' =>'sales','action'=>'') );
        echo "<br>";
        echo "<br>";
     
    ?>
 
    <?php echo $this->Form->create('Customer',array('url'=>(array('controller' => 'customers','action' => 'add','plugin' => 'sales'))));?>

        <fieldset>
            <legend><?php echo __('Company Information'); ?></legend>
            <?php 
                echo $this->Form->input('company_name');
                echo $this->Form->input('company_address');
                echo $this->Form->input('state_province');
                echo $this->Form->input('company_contact');
                
            ?>
            <hr>
            <br>
            <legend><?php echo __('Contact Information'); ?></legend>
            <?php 
                echo $this->Form->input('Customer.firstname');
                echo $this->Form->input('Customer.middlename');
                echo $this->Form->input('Customer.lastname');
                echo $this->Form->input('Customer.email');
                echo $this->Form->input('Customer.contact_number');
                echo $this->Form->input('Customer.address');
               
                echo $this->Form->submit('Add Customer Info', array('class' => 'form-submit',  'title' => 'Click here to add the user') );
            ?>
        </fieldset>
    <?php echo $this->Form->end(); ?>
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