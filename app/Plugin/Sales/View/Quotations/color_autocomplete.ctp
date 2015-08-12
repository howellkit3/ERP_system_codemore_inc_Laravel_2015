<ul id="color-list">
	<?php foreach($colorData as $colorList) { ?>
		<li onClick="selectColor('<?php echo $colorList['QuotationDetail']['color']; ?>');"><?php echo $colorList['QuotationDetail']['color']; ?></li>
	<?php } ?>
</ul>
