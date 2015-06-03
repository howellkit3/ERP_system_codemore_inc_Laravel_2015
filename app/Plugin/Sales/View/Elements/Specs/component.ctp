<?php $plusCounter = $counter + 1; ?>
<div class="form-group">
  <div class="col-lg-2"></div>
  <div class="col-lg-8">
      	<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-reorder"></i></span>
			<input name="data[ProductSpecificationComponent][<?php echo $counter ;?>][name]" value="<?php echo $formatDataSpecs['ProductSpecificationComponent']['name'] ?>" class="form-control label<?php echo $plusCounter ;?> editMe" type="text" disabled />
			<input name="data[IdHolder][ProductSpecificationComponent][<?php echo $counter ;?>][id]" value="<?php echo $formatDataSpecs['ProductSpecificationComponent']['id'] ?>" class="form-control label<?php echo $plusCounter ;?> editMe" type="hidden" />
      	</div>
  </div>
</div>