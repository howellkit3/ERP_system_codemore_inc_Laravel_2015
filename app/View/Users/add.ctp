
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div id="login-box">
                <div class="row">
                    <div class="col-xs-12">
                        <?php echo $this->Session->flash(); ?>
                        <header id="login-header">
                            <div id="login-logo">
                                <!-- <img src="img/logo.png" alt="Koufu Net"/> -->
                                <?php //echo $this->Html->image('koufu.png'); ?>
                                Koufu Net
                            </div>
                        </header>
                        <div id="login-box-inner">
                            <?php echo $this->Form->create('User',array('class' => 'form-horizontal'));?>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <?php
                                        echo $this->Form->input('first_name', array('class' => 'form-control col-lg-6','label' => false,'placeholder' => 'Firstname'));
                                    ?>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <?php
                                        echo $this->Form->input('last_name', array('class' => 'form-control col-lg-6','label' => false,'placeholder' => 'Lastname'));
                                    ?>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <?php
                                        echo $this->Form->input('email', array('class' => 'form-control col-lg-6','label' => false,'placeholder' => 'Email'));
                                    ?>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                                    <?php
                                         echo $this->Form->input('password', array('label' => 'Password ', 'maxLength' => 255, 'title' => 'Password', 'type'=>'password','class' => 'form-control col-lg-6','label' => false,'placeholder' => 'Password'));
                                    ?>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                                    <?php
                                         echo $this->Form->input('repassword', array('label' => 'Confirm Password ', 'maxLength' => 255, 'title' => 'Password', 'type'=>'password','class' => 'form-control col-lg-6','label' => false,'placeholder' => 'Confirm Password'));
                                    ?>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <?php 
                                        echo $this->Form->input('Role.id', array(
                                            'options' => array($roleDatList),
                                            'label' => false,
                                            'style' => 'text-transform:capitalize',
                                            'class' => 'form-control editRole',
                                            'empty' => '--Select Role Description--'));
                        
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <?php
                                             echo $this->Form->submit('Register', array('class' => 'btn btn-success col-xs-12',  'title' => 'Click here to add the user') );
                                        ?>
                                    </div>
                                </div>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
       
    
