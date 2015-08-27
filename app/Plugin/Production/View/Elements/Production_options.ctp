<style type="text/css">.main-box > h1 {padding: 20px 0 6px 20px;}</style>
<?php echo $this->Html->css('/Sales/css/default'); ?>

<?php 
$active_page = !empty($this->params['controller']) ? $this->params['controller'] : '';
$active_action = !empty($this->params['action']) ? $this->params['action'] : '';
?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <br>
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <!-- <li class="">
            <?php $page =($active_page == 'jobs') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Jobs</span>",
             array('controller' => 'jobs',
              'action' => 'plans'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li> -->

        <li class="">
            <?php $page =($active_page == 'jobs') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Planner</span>",
             array('controller' => 'jobs',
              'action' => 'plans'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'jobs') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Sheehting / Cutting</span>",
             array('controller' => 'jobs',
              'action' => 'sheeting'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'jobs') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Printing</span>",
             array('controller' => 'jobs',
              'action' => 'printing'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'jobs') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Coating</span>",
             array('controller' => 'jobs',
              'action' => 'coating'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'jobs') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Corrugated Lamination</span>",
             array('controller' => 'jobs',
              'action' => 'corrugated_lamination'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'jobs') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>DieCutting</span>",
             array('controller' => 'jobs',
              'action' => 'diecutting'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'jobs') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Stripping</span>",
             array('controller' => 'jobs',
              'action' => 'stripping'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'jobs') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Browsing</span>",
             array('controller' => 'jobs',
              'action' => 'browsing'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'jobs') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Gluing</span>",
             array('controller' => 'jobs',
              'action' => 'gluing'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'jobs') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Final Inspection</span>",
             array('controller' => 'jobs',
              'action' => 'final_inspection'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'jobs') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Scrap Items</span>",
             array('controller' => 'jobs',
              'action' => 'scrap_items'),
              array('escape' => false,
                'class' => 'btn '.$page 
              )); ?>
           
        </li>

        <li class="">
            <?php $page =($active_page == 'jobs') ? 'active' : '' ?>
            <?php echo $this->Html->link("<span class='count'>Packing</span>",
             array('controller' => 'jobs',
              'action' => 'packing'),
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