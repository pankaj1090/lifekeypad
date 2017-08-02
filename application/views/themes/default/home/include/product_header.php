<!DOCTYPE html>
<html>
<head>
	
<meta charset="utf-8" />
<title><?php echo $productdetails[0]['prod_name'];?></title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />

<meta content="<?php echo $productdetails[0]['prod_name'];?>" property="og:title">

<meta content="website" property="og:type">

<meta content="<?php echo $basepath;?>item/<?php echo $productName.$productdetails[0]['prod_uniqid'];?>" property="og:url">
<meta content="<?php echo $basepath;?>repo/images/<?php echo $productdetails[0]['prod_image'];?>" property="og:image">
<meta content="<?php echo substr(strip_tags($productdetails[0]['prod_description']),0,150).' ...';?>" property="og:description">

<meta content="<?php echo $productdetails[0]['prod_name'];?>" property="og:site_name">

<meta name="description"  content="<?php echo substr(strip_tags($productdetails[0]['prod_description']),0,150).' ...';?>"/>
<meta name="keywords" content="<?php echo $productdetails[0]['prod_tags'];?>">
<meta name="author" content="<?php echo $this->ts_functions->getsettings('siteauthor','text');?>"/>
<meta name="MobileOptimized" content="320">
<!-- favicon links -->
<link rel="shortcut icon" type="image/png" href="<?php echo $this->ts_functions->getsettings('favicon','url');?>" />
<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800" rel="stylesheet">

<link href="<?php echo $basepath;?>themes/default/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $basepath;?>themes/default/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $basepath;?>themes/default/css/owl.carousel.css" rel="stylesheet">
<link href="<?php echo $basepath;?>themes/default/js/masonry/component.css" rel="stylesheet">
<link href="<?php echo $basepath;?>themes/default/css/style.css" rel="stylesheet">

	<style type="text/css">
		
		.ts_message_popup{
    right: 20px;
    top: 20px;
    width: 240px;
    position: fixed;
    padding: 15px;
	opacity:0;
	visibility:hidden;
	text-align:center;
	border-radius:4px;
	-webkit-box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.24);
    -moz-box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.24);
    -ms-box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.24);
    -o-box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.24);
    box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.24);
    -webkit-transform: -webkit-translateY(-15px);
    -moz-transform: -moz-translateY(-15px);
    -ms-transform: -ms-translateY(-15px);
    -o-transform: -o-translateY(-15px);
    transform: translateY(-15px);
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -ms-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.5s;
}
.ts_message_popup.ts_popup_error{
	color:#fff;
	background-color:#F44336;
	border-color:#F44336;
	opacity:1;
	visibility:visible;
	z-index:1000000000;
	-webkit-transform: -webkit-translateY(0px);
    -moz-transform: -moz-translateY(0px);
    -ms-transform: -ms-translateY(0px);
    -o-transform: -o-translateY(0px);
    transform: translateY(0px);
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -ms-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.5s;
}
.ts_message_popup.ts_popup_success{
	color:#fff;
	background-color: #66BB6A;
	border-color:#66BB6A;
	opacity:1;
	visibility:visible;
	z-index:1000000000;
	-webkit-transform: -webkit-translateY(0px);
    -moz-transform: -moz-translateY(0px);
    -ms-transform: -ms-translateY(0px);
    -o-transform: -o-translateY(0px);
    transform: translateY(0px);
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -ms-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.5s;
}
.ts_message_popup_text{
    float: left;
    width: 100%;
    color: #fff;
	margin:0px;
}


.lk_language_div span{
	display: inline-block;
    width: 70px;
    height: 91px;
    line-height: 71px;
    text-align: center;
    font-size: 25px;
    margin: 0px;
    font-weight: bold;
    text-transform: uppercase;
    color: #ffffff;
	background-image: url(<?php echo $basepath;?>themes/default/images/adobk.png);
}
	</style>
</head>
<body>


<div class="lk_preloader_wrapper">
	<div id="preloader">
		<span></span>
		<span></span>
		<span></span>
		<span></span>
	</div>
</div>

<!--Message Popup Start-->
<div class="ts_message_popup">
  <p class="ts_message_popup_text">
  
  </p>
</div>
<!--Message Popup End-->

<div class="sidebar_closer"></div>




