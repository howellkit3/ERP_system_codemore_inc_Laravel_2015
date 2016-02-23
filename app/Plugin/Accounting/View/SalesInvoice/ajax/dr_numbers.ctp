<ul>
    <?php foreach ($deliveries as $key => $value) { ?>
    <li>
            <input type="checkbox" value="<?php echo $value; ?>" name="data[SalesInvoice][dr_number][]">
            <?php echo $value; ?>
    </li>   
   <?php } ?>
</ul>