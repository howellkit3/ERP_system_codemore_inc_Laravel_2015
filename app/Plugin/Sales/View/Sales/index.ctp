<div class="users form">
 
    <?php echo $this->Form->create('Company',array('url'=>(array('controller' => 'sales','action' => 'add')),'plugin' => 'sales'));?>
        <fieldset>
            <legend><?php echo __('Company Information'); ?></legend>
            <?php 
                echo $this->Form->input('company_name');
                echo $this->Form->input('company_address');
                echo $this->Form->input('state_province');
                echo $this->Form->input('company_contact');
               	
                //echo $this->Form->submit('Add Customer Info', array('class' => 'form-submit',  'title' => 'Click here to add the user') );
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
        echo $this->Html->link( "Return to Dashboard",   array('action'=>'index') );
        echo "<br>";
        //echo $this->Html->link( "Customer Info",   array('action'=>'add') );

        echo "<br>";
        echo $this->Html->link( "Logout",   array('controller'=>'../users','action'=>'logout') );

    }else{
        echo $this->Html->link( "Return to Login Screen",   array('action'=>'index') );
    }
?>