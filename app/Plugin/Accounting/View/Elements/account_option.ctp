<style type="text/css">.main-box > h1 {padding: 20px 0 6px 20px;}</style>
<?php echo $this->Html->css('/Sales/css/default'); ?>

<?php 
$active_page = !empty($this->params['controller']) ? $this->params['controller'] : '';
$active_action = !empty($this->params['action']) ? $this->params['action'] : '';
?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="">
            <?php $page =($active_page == 'sales_invoice' && $active_action == 'index') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Invoice</span>",
             array('controller' => 'sales_invoice',
              'action' => 'index'),
              array('escape' => false,
                'class' => 'btn '.$page .' '.$noPermissionPay
              )); ?>
           
        </li>

       <li class="">
            <?php $page =($active_page == 'sales_invoice' && $active_action == 'statement') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Statement</span>",
             array('controller' => 'sales_invoice',
              'action' => 'statement'),
              array('escape' => false,
                'class' => 'btn '.$page .' '.$noPermissionPay
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'sales_invoice' && $active_action == 'receivable') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Receivable</span>",
             array('controller' => 'sales_invoice',
              'action' => 'receivable'),
              array('escape' => false,
                'class' => 'btn '.$page .' '.$noPermissionPay
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'sales_invoice' && $active_action == 'payable') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Payable</span>",
             array('controller' => 'sales_invoice',
              'action' => 'payable'),
              array('escape' => false,
                'class' => 'btn '.$page .' '.$noPermissionReciv
              )); ?>
           
        </li>

    </ul>
</div>
<br><br><br><br>