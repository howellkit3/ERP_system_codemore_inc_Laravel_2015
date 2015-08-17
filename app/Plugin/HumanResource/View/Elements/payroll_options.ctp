<style type="text/css">.main-box > h1 {padding: 20px 0 6px 20px;}</style>
<?php echo $this->Html->css('/Sales/css/default'); ?>

<?php 
$active_page = !empty($this->params['controller']) ? $this->params['controller'] : '';
$active_action = !empty($this->params['action']) ? $this->params['action'] : '';
?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="">
          <?php $page =($active_page == 'salaries')  && !in_array($active_action,array('reports')) ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Salaries</span>",
             array('controller' => 'salaries',
              'action' => 'export'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
        </li>

        <li class="">
          <?php $page = ($active_page == 'salaries') && in_array($active_action,array('reports')) ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Salary Reports</span>",
             array('controller' => 'salaries',
              'action' => 'reports'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
        </li>
      
    </ul>
</div>
<br><br><br><br>