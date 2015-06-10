<li class="ui-state-default">
  <section class="dragField">
      <header class="main-box-header dragHeader clearfix">
          <h2 class="pull-left">Component</h2>
          <?php if ($varCounter > 1) { ?>
            <a href="#" class="remove_field pull-right">
                <i class="fa fa-times-circle fa-fw fa-lg"></i>
            </a>
          <?php } ?>
      </header>
      <div class="form-group">
          <div class="col-lg-2"><span class="pull-right" style="color:red">*</span></div>
          <div class="col-lg-8">
              <!-- <div class="form-group"> -->
                 <!--  <div class="input-group-addon"><i class="fa fa-reorder"></i></div> -->
              <input name="<?php echo $realName ;?>" class="required form-control label<?php echo $varCounter ;?>" type="text">
              <div class="top-pad"></div>
             <!--  </div> -->
          </div>
      </div>
      
  </section>
  <input type="hidden" name="data[ProductSpecificationDetail][]" value="Component">
</li>