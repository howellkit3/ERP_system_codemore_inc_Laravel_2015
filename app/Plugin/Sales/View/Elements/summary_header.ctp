<div class="row">
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="main-box infographic-box colored emerald-bg">
            <i class="fa fa-shopping-cart"></i>
            <span class="headline">Sales Order</span>
            <span class="value"><?php echo count($salesOder) ?></span>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="main-box infographic-box colored green-bg">
            <i class="fa fa-dedent"></i>
            <span class="headline">Inquiry</span>
            <span class="value"><?php echo count($inquiryId)?></span>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="main-box infographic-box colored red-bg">
            <i class="fa fa-building-o"></i>
            <span class="headline">Customer</span>
            <span class="value"><?php echo count($companyData)?></span>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="main-box infographic-box colored purple-bg">
            <i class="fa fa-quote-left"></i>
            <span class="headline">Quotation</span>
            <span class="value"><?php echo count($quoteName)?></span>
        </div>
    </div>
</div>