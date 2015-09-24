<div class="row">
    <?php 

        $serverPath = $this->Html->url('/',true);

    ?>
    <a href="<?php echo $serverPath?>/ware_house/consumables/">
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="main-box infographic-box colored emerald-bg">
            <i class="fa fa-shopping-cart"></i>
            <span class="headline">Consumables</span>
            <span class="value"> &nbsp </span>
        </div>
    </div>
    </a>
    
    <a href="<?php echo $serverPath?>/ware_house/ware_house_systems/dashboard">
       <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="main-box infographic-box colored green-bg">
                <i class="fa fa-dedent"></i>
                <span class="headline">Raw Materials</span>
                <span class="value"> &nbsp </span>
            </div>
        </div>
    </a>
    <a href="<?php echo $serverPath?>/ware_house/ware_house_systems/dashboard">
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="main-box infographic-box colored red-bg">
            <i class="fa fa-building-o"></i>
            <span class="headline">Finished Goods</span>
            <span class="value"> &nbsp </span>
        </div>
    </div>
    </a>
</div>