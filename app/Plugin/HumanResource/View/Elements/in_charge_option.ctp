<style type="text/css">.main-box > h1 {padding: 20px 0 6px 20px;}</style>
<?php echo $this->Html->css('/Sales/css/default'); ?>

<?php 
$active_page = !empty($this->params['controller']) ? $this->params['controller'] : '';
$active_action = !empty($this->params['action']) ? $this->params['action'] : '';
?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

 
        <li class="">
          <?php $page =($active_page == 'schedules') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Schedule</span>",
             array('controller' => 'work_schedules',
              'action' => 'schedules',
              'in_charge' => true),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
        </li>

        
        <li class="">
          <?php $page =($active_page == 'overtimes') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Overtime</span>",
             array('controller' => 'overtimes',
              'action' => 'index?'.rand(1000,9999).'='.date("is")),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
        </li>
      
      
    </ul>
</div>
<br><br><br><br>