<style type="text/css">.main-box > h1 {padding: 20px 0 6px 20px;}</style>
<?php echo $this->Html->css('/Sales/css/default'); ?>

<?php 
$active_page = !empty($this->params['controller']) ? $this->params['controller'] : '';
$active_action = !empty($this->params['action']) ? $this->params['action'] : '';
?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="">

            <?php $page =($active_page == 'customer_sales' && $active_action == 'index') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Categories</span>",
             array('controller' => 'categories',
              'action' => 'add'),
              array('escape' => false,
                'class' => 'btn'
              )); ?>
           
        </li>
        <li class="">

            <?php $page =($active_page == 'customer_sales' && $active_action == 'index') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Crease</span>",
             array('controller' => 'categories',
              'action' => 'add'),
              array('escape' => false,
                'class' => 'btn'
              )); ?>
           
        </li>

        <li class="">

            <?php $page =($active_page == 'customer_sales' && $active_action == 'index') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Machine</span>",
             array('controller' => 'categories',
              'action' => 'machines'),
              array('escape' => false,
                'class' => 'btn'
              )); ?>
           
        </li>

      </ul>
</div>