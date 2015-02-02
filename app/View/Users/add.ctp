<div class="users form">
 
    <?php //echo $this->Form->create('User');?>
       <!--  <fieldset>
            <legend><?php echo __('Add User'); ?></legend>
            <?php 
                echo $this->Form->input('firstname');
                echo $this->Form->input('middlename');
                echo $this->Form->input('lastname');
                echo $this->Form->input('email');
                echo $this->Form->input('password', array('label' => 'Password ', 'maxLength' => 255, 'title' => 'Password', 'type'=>'password'));
                echo $this->Form->submit('Add User', array('class' => 'form-submit',  'title' => 'Click here to add the user') );
            ?>
        </fieldset> -->
    <?php //echo $this->Form->end(); ?>
     <?php echo $this->Form->create('User',array('class' => 'form-horizontal'));?>

    
        
            <div id="login-box-holder">
                <div class="row">
                    <div class="col-xs-3">
                    </div>
                    <div class="col-xs-9">
                        <div class="main-box-body clearfix">
                            <legend><?php echo __('Register Account'); ?></legend>   
                            <div class="form-group">
                                <label for="inputEmail1" class="col-lg-2 control-label">Firstname</label>
                                <div class="col-lg-5">
                                    <?php
                                        echo $this->Form->input('firstname', array('class' => 'form-control col-lg-6','label' => false));
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 control-label">Middlename</label>
                                <div class="col-lg-5">
                                    <?php
                                        echo $this->Form->input('middlename', array('class' => 'form-control col-lg-6','label' => false));
                                    ?>
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 control-label">Lastname</label>
                                <div class="col-lg-5">
                                    <?php
                                        echo $this->Form->input('lastname', array('class' => 'form-control col-lg-6','label' => false));
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-5">
                                    <?php
                                        echo $this->Form->input('email', array('class' => 'form-control col-lg-6','label' => false));
                                    ?>
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 control-label">Password</label>
                                <div class="col-lg-5">
                                    <?php
                                         echo $this->Form->input('password', array('label' => 'Password ', 'maxLength' => 255, 'title' => 'Password', 'type'=>'password','class' => 'form-control col-lg-6','label' => false));
                                    ?>
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                <div class="col-lg-5">
                                    <?php
                                         echo $this->Form->submit('Add User', array('class' => 'form-submit btn btn-success',  'title' => 'Click here to add the user') );
                                    ?>
                                </div>
                            </div>

                        </div> 
                        <?php echo $this->Form->end(); ?>
                        <?php
                            if($this->Session->check('Auth.User')){
                                echo $this->Html->link( "Return to Dashboard",   array('action'=>'index') );
                                echo "<br>";
                                echo $this->Html->link( "Logout",   array('action'=>'logout') );
                            }else{
                                echo $this->Html->link( "Return to Login Screen",   array('action'=>'login') );
                            }
                        ?>
                    </div>
                    
                </div>
            </div>
       
    
