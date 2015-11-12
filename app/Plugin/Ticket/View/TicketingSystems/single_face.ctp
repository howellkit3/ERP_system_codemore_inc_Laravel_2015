<?php foreach ($corrugatedData['ItemGroupLayer'] as $corrugatedDataList ){ ?>
    <div class="form-group">
        <label for="inputPassword1" class="col-lg-4 control-label">Substrate</label>

        <div class="col-lg-7">
            <?php 
                echo $this->Form->input('substrate', array(
                    'label' => false,
                    'class' => 'form-control ',
                    'disabled' => 'disabled',
                    'value' => $corrugatedDataList['substrate']
            )); ?>
        </div>
    </div>

    <div class="form-group">
        <label for="inputPassword1" class="col-lg-4 control-label">Flute</label>

        <div class="col-lg-7">
            <?php 
                echo $this->Form->input('flute', array(
                    'label' => false,
                    'class' => 'form-control ',
                    'disabled' => 'disabled',
                    'value' => $corrugatedDataList['flute']
            )); ?>
        </div>
    </div>
        
<?php } ?> 