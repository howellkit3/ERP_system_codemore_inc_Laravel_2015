<?php echo $this->element('deliveries_options'); ?><br><br>
<?php echo $this->Html->script('Delivery.gatepass'); ?>
<div class="row">
    <div class="col-lg-12">
        
        <div class="row">
            <div class="col-lg-12">
                <header class="main-box-header clearfix">
                    
                    
                    <h1 class="pull-left">
                        Create Gate Pass
                    </h1>
                    <?php 

                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'deliveries', 'action' => 'view',$deliveryScheduleId,$quotationId,$clientsOrderUuid),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
                </header>
            </div>
        </div>
        <?php echo $this->Form->create('GatePass',array('url'=>(array('controller' => 'deliveries','action' => 'add_gatepass')), 'target' => '_blank'));?>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <div class="top-space"></div>
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Search DR</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('GatePassTruck.dr', array(
                                                        'label' => false,
                                                        'class' => 'form-control',
                                                        'id' => 'searchDr'
                                                    )); 
                                         
                                                echo $this->Form->input('GatePassTruck.deliveries', array(
                                                        'label' => false,
                                                        'type' => 'hidden'
                                                    )); 
                                            ?>
                                        </div>
                                    </div>

                                    <div class="select_cont">

                                    </div>
                                    <br>
                                    <div class="form-group form-height ">
                                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Select DR No.</label>
                                        
                                    </div>

                                
                                    <div class="dr-numbers">

                                    </div>

                                    <?php if(!empty($drNos)){ ?>

                                   <!--  <div class="form-group">
                                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Type of Gatepass</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('GatePassTruck.truck_id', array(
                                                    'options' => array('Delivery', 'Pickup'),
                                                    'value' => 0,
                                                    'type' => 'select',
                                                    'label' => false,
                                                    'class' => 'form-control required',
                                                    'empty' => '---Type of Gatepass---',
                                                    'required' => 'required'
                                                    )); 
                                            ?>
                                        </div>
                                    </div> -->

                                    <!-- <div class="form-group form-height gatePickUp ">
                                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Select DR No.</label>
                                        
                                    </div>

                                
                                    <div class="dr-numbers">

                                    </div> -->

                                     <?php foreach ($drNos as $key => $value) { ;?>
                                     <!--    <div class="form-group form-height gatePickUp">
                                            <label class="col-lg-2 control-label"> </label>
                                            <div class="col-lg-8">
                                                <div class="checkbox-nice">
                                                    <input type="checkbox" class="check-ref-uuid " id="checkbox-<?php echo $key ?>">
                                                    <label for="checkbox-<?php echo $key ?>">
                                                        <?php echo $value['Delivery']['dr_uuid'] ;?>
                                                    </label>
                                                    <?php 
                                                        echo $this->Form->input('GatePass.'.$key.'.ref_uuid', array('class' => 'form-control ref-uuid',
                                                            'type' => 'hidden',
                                                            'disabled' => false,
                                                            'label' => false,
                                                            'value' => $value['Delivery']['dr_uuid']));
                                                    ?>

                                                    <?php 
                                                        echo $this->Form->input('GatePass.'.$key.'.model', array('class' => 'form-control ref-uuid',
                                                            'type' => 'hidden',
                                                            'disabled' => false,
                                                            'label' => false,
                                                            'value' => 'Deliveries'));
                                                    

                                                    $keyholder = $key ?>

                                                </div>
                                            </div>
                                        </div> -->
                                    <?php } ?>

                                    <?php if($keyholder >= 4){?>
                                    <br>
                                    <div class="form-group form-height gatePickUp">
                                            <label class="col-lg-2 control-label"> </label>
                                            <label for="checkbox-<?php echo $key ?>"> <I><span style="color:red">*</span>Gatepass details will be summarized once item number is greater than 4. </I> </label>
                                    </div>

                                    <?php } 

                                    }else{?>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Type of Gatepass</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('GatePassTruck.truck_id', array(
                                                    'options' => array('Delivery', 'Pickup'),
                                                    'value' => 1,
                                                    'type' => 'select',
                                                    'disabled' => 'disabled',
                                                    'label' => false,
                                                    'class' => 'form-control required gatefield gateType',
                                                    'empty' => '---Type of Gatepass---',
                                                    'required' => 'required'
                                                    )); 
                                            ?>
                                        </div>
                                    </div>

                                    <?php } ?>

                                    <?php 

                                        echo $this->Form->input('Direct.one', array('class' => 'form-control item_type one',
                                            'type' => 'hidden',
                                            'label' => false,
                                            'value' => $deliveryScheduleId));

                                        echo $this->Form->input('Direct.two', array('class' => 'form-control item_type two',
                                            'type' => 'hidden',
                                            'label' => false,
                                            'value' => $quotationId));

                                        echo $this->Form->input('Direct.three', array('class' => 'form-control item_type three',
                                            'type' => 'hidden',
                                            'label' => false,
                                            'value' => $clientsOrderUuid));

                                        // echo $this->Form->input('GatePass.model', array('class' => 'form-control item_type',
                                        //     'type' => 'hidden',
                                        //     'label' => false,
                                        //     'value' => 'Deliveries'));
                                    
                                    ?>
                                     
                                    <div class="form-group gatePickUp">
                                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Truck No.</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('GatePassTruck.truck_id', array(
                                                    'options' => array($truckListUpper),
                                                    'type' => 'select',
                                                    'label' => false,
                                                    'class' => 'form-control required',
                                                    'empty' => '---Select Item Truck---',
                                                    'required' => 'required'
                                                    )); 
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group gatePickUp">
                                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Driver Name</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo ucfirst($this->Form->input('GatePassTruck.driver_id', array(
                                                        'options' => array($driverListUpper),
                                                        'type' => 'select',
                                                        'label' => false,
                                                        'class' => 'form-control required gatefield ',
                                                        'empty' => '---Select Driver---',
                                                        'required' => 'required'
                                                        )));
                                            ?>
                                        </div>
                                    </div>

                                    <section class="appendHelper">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Helper Name</label>
                                            <div class="col-lg-8">
                                                <?php 
                                                    echo $this->Form->input('GatePassAssistant.0.helper_id', array(
                                                        'options' => array($helperListUpper),
                                                        'type' => 'select',
                                                        'label' => false,
                                                        'class' => 'form-control',
                                                        'empty' => '---Select Helper---'
                                                        )); 
                                                ?>
                                            </div>
                                            <div class="col-lg-2 plusbtn">
                                                <button type="button" onclick="cloneData('appendHelper',this)" class="add-gatepass danger btn btn-success"> <i class="fa fa-plus"></i></button>
                                                <button type="button" style="display:none;" class="remove-field btn btn-danger remove" onclick="removeClone('appendHelper')"><i class="fa fa-minus"></i> </button>
                                            </div>
                                        </div>
                                    </section>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Remarks</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('GatePassTruck.remarks', array(
                                                    'type' => 'textarea',
                                                    'class' => 'form-control item_type',
                                                    'label' => false));
                                            ?>
                                        </div>
                                    </div>

                                       <div class="form-group">
                                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Approved by:</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo ucfirst($this->Form->input('GatePassTruck.approver_id', array(
                                                        'options' => array($deliveryUserFName),
                                                        'type' => 'select',
                                                        'label' => false,
                                                        'class' => 'form-control required gatefield',
                                                        'empty' => '---Select Approver---',
                                                        'required' => 'required'
                                                        )));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                            <button type="submit" class=" btn btn-primary pull-left">Submit</button>&nbsp;
                                            <?php 
                                                echo $this->Html->link('Cancel', array('controller' => 'deliveries', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php echo $this->Form->end(); ?>

    </div>
</div>


<script>
    
    jQuery(document).ready(function(){


    function searchOrder(searchInput) {

        $this = $('.searchOrder');

        var searchInput = $('#searchDr').val();
        
        $.ajax({
            type: "GET",
            url: serverPath + "delivery/deliveries/search_dr/"+searchInput,
            dataType: "html",
            data : {'dr' : searchInput },
            success: function(data) {
                //alert(data);
                if (data) {

                    $('.dr-numbers').html(data);

                } 
                if (data.length < 5 ) {

                    $('.searchAppend').html('<font color="red"><b>No result..</b></font>');
                     
                }
                
            }
        });
    }

    var timeout;

    $('#searchDr').keypress(function() {


        if(timeout) {
            clearTimeout(timeout);
            timeout = null;
        }

        timeout = setTimeout(searchOrder,600)
    })


    $('body').on('click','.dr-numbers .check-ref-uuid',function(){
         
        $this = $(this);
        
        $values = $('#GatePassTruckDeliveries').val();

        if ($('.select_cont .tags').length < 4) {

        

        if ($this.is(':checked')) {

            $tags = '<li>';
            $tags += '<div class="tags" data-id="'+$this.val()+'">'
            $tags += $this.val();
            $tags += '<i class="fa fa-close"></i></div>';
            $tags += '</li>';

            $('.select_cont').append($tags);

            $values =  $values + (!$values ? '' : ',') + $this.val();

            $('#GatePassTruckDeliveries').val($values);

         }
     } else {

        alert('Maximum Dr per gatepass,Create another or remove existing dr');
     }

    });

       $('body').on('click','.tags .fa-close',function(){

            $parent = $(this).parent();

            $parent.parent().remove();

            $list = $('#GatePassTruckDeliveries').val();

              $text =  $list.replace($parent.data('id'),'');

             $('#GatePassTruckDeliveries').val($text);
      });


        // $('#GatePassGatePassForm').on('submit',function(e) {

        // $this = $(this);

        // $url = $(this).attr('action');

        // alert('wewe');

        //   e.preventDefault();

        // // $.ajax({
        // //     url: $url,
        // //     type: "POST",
        // //      data: $this.serialize() ,
        // //     //dataType: "json",
        // //     success: function(data) {

        // //          //window.location.href = $url

        // //         }
        // //     });

   

   // });

        
        $("#GatePassGatePassForm").validate();

         var type = $('.gateType').val();

       if(type == 1){

            $('.gatePickUp').hide();

            $('.gatePickUp').attr('diabled', true);

       }

       if(type == 0){

            $('.gatePickUp').show();

       }
        
    });


    $('.gateType').on("change",function(){
        
       var type = $('.gateType').val();

       if(type == 1){

            $('.gatePickUp').hide();

            $('.gatePickUp').attr('disabled', true);

       }

       if(type == 0){

            $('.gatePickUp').show();

       }
        
    });

</script>
<style type="text/css">
.form-height{
    margin-top: -15px !important;
}
.form-group.form-height.gatePickUp {
    display: inline-block;
    width: 20%;
}
.dr-numbers {
  margin: 0 172px;
  width: 829px;
}

.tags {
  background:#03a9f4;
  border-radius: 6px;
  color: #fff;
  margin: 3px 4px;
  text-align: center;
  padding: 0 5px;
}

.select_cont > li {
  display: inline-block;
  list-style: outside none none;
}

.tags .fa.fa-close {
  float: right;
  margin: 3px;
  cursor: pointer;
}

.select_cont {
  margin: 0 175px;
}


</style>