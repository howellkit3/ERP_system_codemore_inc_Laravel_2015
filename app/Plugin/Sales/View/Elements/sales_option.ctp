<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">
        <li class="dropdown hidden-xs">
            <a data-toggle="dropdown" class="btn dropdown-toggle">
                <span class="count">Quotation</span>
            </a>
            <ul class="dropdown-menu notifications-list">
                <li class="pointer">
                    <div class="pointer-inner">
                        <div class="arrow"></div>
                    </div>
                </li>
            </ul>
        </li>
        <li class="dropdown hidden-xs">
            <a data-toggle="dropdown" class="btn dropdown-toggle">
                <span class="count">Settings</span>
            </a>
            <ul class="dropdown-menu notifications-list messages-list">
                <li class="item-footer">
                    <?php echo $this->Html->link(__('Add Custom field'), array('controller' => 'customer_sales','action' => 'custom_field')); ?>
                </li>
            </ul>
        </li>
   
    </ul>
</div>
<br><br>