<head>
<title>Koufu Email</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<div style="position: relative; margin: 0 auto;width:100%;font-family: 'Helvetica', Arial, sans-serif; font-size: 15px; background-image:url(<?php echo $this->Html->url('/', true) ?>img/whitey.png); background-color: #f7f7f7;">
    <div style="margin:0 auto;text-align:center;width:146px;padding:18px 0; ">
    <a  href="<?php echo $this->Html->url('/', true) ?>">
        <img src="<?php echo $this->Html->url('/', true) ?>img/koufu.png" width="">
        </a>
    </div>

    <div style="width:600px;margin:0 auto;background:#fff;">                                
       
            <?php echo $message; ?>

        <div>
            <ul style="margin:0;background:#80c908;background: none repeat scroll 0 0 #80c908;padding-left: 0;text-align:center">
        <li style="display:inline-block;padding:16px 5px;text-decoration:none;font-size:15px;"><a style="font-size:14px;color:#fff;text-decoration:none;" href="#">ABOUT</a></li>
        <li style="display:inline-block;padding:16px 5px;text-decoration:none;font-size:14px;"><a style="font-size:14px;color:#fff;text-decoration:none;"  href="<?php echo $this->html->url('/', true); ?>terms-and-conditions">TERMS & CONDITIONS</a></li>
        <li style="display:inline-block;padding:16px 5px;text-decoration:none;"><a  style="color:#fff;font-size:14px;text-decoration:none;"  href="<?php echo $this->html->url('/', true); ?>privacy-policy">PRIVACY POLICY</a></li>
        </ul>
        </div>
    </div>
</div>
</body>
</html>