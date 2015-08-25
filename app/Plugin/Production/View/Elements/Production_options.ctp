<style type="text/css">.main-box > h1 {padding: 20px 0 6px 20px;}</style>
<?php echo $this->Html->css('/Sales/css/default'); ?>

<?php 
$active_page = !empty($this->params['controller']) ? $this->params['controller'] : '';
$active_action = !empty($this->params['action']) ? $this->params['action'] : '';
?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <br>
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="">
            <?php $page =($active_page == 'jobs') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Jobs</span>",
             array('controller' => 'jobs',
              'action' => 'plans'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'settings') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Settings</span>",
             array('controller' => 'settings',
              'action' => 'machines'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li>
    </ul>
</div>
<br><br>