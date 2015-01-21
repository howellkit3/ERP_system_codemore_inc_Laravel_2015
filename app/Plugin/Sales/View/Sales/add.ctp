<div class="users form">
 
    <?php //echo $this->Form->create('Sale',array('controller' => 'sales','action' => 'add','plugin' => 'sales')); 
echo $this->Form->create(null, array(
    'url' => array('controller' => 'sales', 'action' => 'add')
));
    ?>

        <fieldset>
            <legend><?php echo __('Company Information'); ?></legend>
            <?php 
                echo $this->Form->input('company_name');
                echo $this->Form->input('middlename');
                echo $this->Form->input('lastname');
                echo $this->Form->input('email');
                echo $this->Form->input('password', array('label' => 'Password ', 'maxLength' => 255, 'title' => 'Password', 'type'=>'password'));
                echo $this->Form->submit('Add User', array('class' => 'form-submit',  'title' => 'Click here to add the user') );
            ?>
        </fieldset>
    <?php echo $this->Form->end(); ?>
</div>