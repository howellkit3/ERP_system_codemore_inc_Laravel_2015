<style type="text/css">.main-box > h1 {padding: 20px 0 6px 20px;}</style>
<?php echo $this->Html->css('/Sales/css/default'); ?>

<?php 
$active_page = !empty($this->params['controller']) ? $this->params['controller'] : '';
$active_action = !empty($this->params['action']) ? $this->params['action'] : '';
?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="">
            <?php $page =($active_page == 'employees') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Employees</span>",
             array('controller' => 'employees',
              'action' => 'index?'.rand(1000,9999).'='.date("is")),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li>

        <li class="">
          <?php $page =($active_page == 'schedules') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Schedule</span>",
             array('controller' => 'schedules',
              'action' => 'holiday?'.rand(1000,9999).'='.date("is")),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
        </li>
      
       <li class="">
          <?php $page =($active_page == 'attendances') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Attendance</span>",
             array('controller' => 'attendances',
              'action' => 'index?'.rand(1000,9999).'='.date("is")),
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

         <li class="">
          <?php $page =($active_page == 'cause_memos') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Cause Memo</span>",
             array('controller' => 'cause_memos',
              'action' => 'index?'.rand(1000,9999).'='.date("is")),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
        </li>

        <li class="">
          <?php $page =($active_page == 'contracts') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Contract</span>",
             array('controller' => 'contracts',
              'action' => 'index?'.rand(1000,9999).'='.date("is")),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
        </li>

         <li class="">
          <?php $page =($active_page == 'settings') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Settings</span>",
             array('controller' => 'settings',
              'action' => 'department?'.rand(1000,9999).'='.date("is")),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
        </li>
      
    </ul>
</div>
<br><br><br><br>