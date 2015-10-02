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
            <?php echo $this->Html->link("<span class='count'>Customer Info</span>",
             array('controller' => 'customer_sales',
              'action' => 'index'),
              array('escape' => false,
                'class' => 'btn '.$page.' '.$noPermission
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'customer_sales' && $active_action == 'inquiry') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Inquiry</span>",
             array('controller' => 'customer_sales',
              'action' => 'inquiry'),
              array('escape' => false,
                'class' => 'btn '.$page .' '.$noPermission
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'quotations'  ) ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Quotation</span>",
             array('controller' => 'quotations',
              'action' => 'index'),
              array('escape' => false,
                'class' => 'btn '.$page .' '.$noPermission
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'sales_orders'  ) ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Clients Order</span>",
             array('controller' => 'sales_orders',
              'action' => 'index'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'products'  ) ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Products</span>",
             array('controller' => 'products',
              'action' => 'index'),
              array('escape' => false,
                'class' => 'btn '.$page .' '.$noPermission
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'settings'  ) ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Settings</span>",
             array('controller' => 'settings',
              'action' => 'category'),
              array('escape' => false,
                'class' => 'btn '.$page .' '.$noPermission
              )); ?>
           
        </li>
   
    </ul>
</div>
<br><br>