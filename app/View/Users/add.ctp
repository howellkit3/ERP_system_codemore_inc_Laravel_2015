<div class="users form">
 
    <?php echo $this->Form->create('User');?>
        <fieldset>
            <legend><?php echo __('Add User'); ?></legend>
            <?php 
                echo $this->Form->input('firstname');
                echo $this->Form->input('middlename');
                echo $this->Form->input('lastname');
                echo $this->Form->input('email');
                echo $this->Form->input('password', array('label' => 'Password ', 'maxLength' => 255, 'title' => 'Password', 'type'=>'password'));
                echo $this->Form->submit('Add User', array('class' => 'form-submit',  'title' => 'Click here to add the user') );
            ?>
        </fieldset>
    <?php echo $this->Form->end(); ?>
</div>
<?php
    if($this->Session->check('Auth.User')){
        echo $this->Html->link( "Return to Dashboard",   array('action'=>'index') );
        echo "<br>";
        echo $this->Html->link( "Logout",   array('action'=>'logout') );
    }else{
        echo $this->Html->link( "Return to Login Screen",   array('action'=>'login') );
    }
?>