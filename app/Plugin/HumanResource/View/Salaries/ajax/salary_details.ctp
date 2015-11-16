<table class="table table-bordered table-hover text-left">
      <tr>
        <td> Employee Name : </td>
        <td> <?php echo ucwords($employee['Employee']['full_name']); ?></td>
      </tr>
         <tr>
        <td> Code : </td>
        <td> <?php echo $employee['Employee']['code']; ?></td>
      </tr>
      </tr>
        
</table>

<div class="col-lg-9 col-md-8 col-sm-8">
        <div class="main-box clearfix">
          <div class="tabs-wrapper profile-tabs">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab-ainfo" data-toggle="tab">Days Work</a></li>
            
              <li><a href="#tab-cperson" data-toggle="tab">Deductions</a></li>
              <!-- <li><a href="#tab-chat" data-toggle="tab">Email</a></li>
              <li><a href="#tab-friends" data-toggle="tab">Contact Person</a></li>
              <li><a href="#tab-products" data-toggle="tab">Products</a></li> -->
              <?php 
                            // echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'customer_sales', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
            </ul>
            
            <div class="tab-content">
            
                  <div class="tab-pane fade active in" id="tab-ainfo">
                      this is a test
                  </div>
          </div>
        </div>
      </div>
</div>