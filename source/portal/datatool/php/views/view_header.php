<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo LINK_ROOT; ?>/php/css/gl-styles.en.css">
<link rel="stylesheet" href="<?php echo LINK_ROOT; ?>/php/css/style.css" type="text/css" />
<link rel="stylesheet" href="<?php echo LINK_ROOT; ?>/php/css/css.css" type="text/css" />
<link rel="stylesheet" href="<?php echo LINK_ROOT; ?>/php/css/jquery-ui.css" type="text/css" />
<link rel="stylesheet" href="<?php echo LINK_ROOT; ?>/php/css/index.css" type="text/css" />

<script type="text/javascript" src='<?php echo LINK_ROOT; ?>/php/js/jquery.js'></script>
<script type="text/javascript" src="<?php echo LINK_ROOT; ?>/php/js/gl-head-scripts.en.js"></script>
<script type="text/javascript" src='<?php echo LINK_ROOT; ?>/php/js/home1.js'></script>
<script type="text/javascript" src="<?php echo LINK_ROOT; ?>/php/js/scrollFix.js"></script>
<script type="text/javascript" src='<?php echo LINK_ROOT; ?>/php/js/index.js'></script>
<script type="text/javascript" src='<?php echo LINK_ROOT; ?>/php/js/jquery-ui.js'></script>
<title>
<?php 
if(isset($title)){
	echo $title.' - ';
}
?>
数据工具
</title>
</head>
<body>
<div id="Container" class="col">
  <div class="Header">
    <div  class="gl-zh cf">
      <div id="gl-header" class="cf">
        <div id="gl-header-top"> </div>
        <div id="gl-header-bottom" class="cf">
          <div id="gl-logo"> <a href="<?php echo CLOUD_INDEX; ?>" class="cf"> <img src="<?php echo LINK_ROOT; ?>/php/images/logo.jpg" width="258" height="46"  id="gl-logo-wolfram" /> </a> </div>
          <div id="gl-menu" class="cf">
            <div id="gl-menu-technologies" class="gl-has-submenu"> <a href="<?php echo MARKET_INDEX; ?>" class="gl-submenu-wrapper">数据商城</a> </div>
            <div id="gl-menu-solutions" class="gl-has-submenu"> <a href="<?php echo DATATOOL_INDEX; ?>" class="gl-submenu-wrapper">数据工具</a> </div>
            <div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo CLOUD_INDEX; ?>/index.php/0" class="gl-submenu-wrapper">知识论坛</a> </div>
            <div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo COMPETITION_INDEX; ?>" class="gl-submenu-wrapper">数据竞赛</a> </div>
            <div id="gl-menu-support" class="gl-has-submenu">
            <?php
			if(isset($_SESSION['user'])){
			?>
                 <a href="<?php echo DATATOOL_INDEX; ?>" class="gl-submenu-wrapper zq"><!--我的专区--><?php echo $_SESSION['user']['display_name']; ?></a> 
            <?php
			}else{
			?>
                 <a href="<?php echo DATATOOL_INDEX; ?>" class="gl-submenu-wrapper zq">我的专区</a> 
            <?php
			}
			?>
            </div>
            <?php
			if(isset($_SESSION['user'])){
			?>
                <div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo DATATOOL_INDEX; ?>/index.php?ajax=user&op=logout" class="gl-submenu-wrapper dl">登出</a></div>
            <?php
			}else{
			?>
                <div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo UNITY_INDEX; ?>/index.php?view=login&site=datatool" class="gl-submenu-wrapper dl">登录</a> </div>
                <div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo UNITY_INDEX; ?>/index.php?view=regist&site=datatool" class="gl-submenu-wrapper zc">注册</a> </div>
            <?php
			}
			?>
            <input type="hidden" id="datatool_index" value="<?php echo DATATOOL_INDEX; ?>" />
            <input type="hidden" id="link_root" value="<?php echo LINK_ROOT; ?>" />
          </div>
          <!--/#gl-menu --> 
        </div>
        <!--/#gl-header-bottom --> 
      </div>
      <!--/#gl-header -->
      <div id="gl-header-bg"><span></span></div>
      <div id="gl-header-offset"><span></span></div>
    </div>
  </div>
  
  <div class="clear"></div>
  <div class="wk">
    <div class="title" >
      <a href="<?php echo CLOUD_INDEX; ?>">首页</a>&nbsp;&nbsp;>&nbsp;&nbsp;<a href="<?php echo DATATOOL_INDEX; ?>">数据工具</a>&nbsp;&nbsp;>&nbsp;&nbsp;<?php if(isset($title)){echo $title;}else{echo '所有数据';} ?>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
