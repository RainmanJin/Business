<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo LINK_ROOT; ?>/css/index.css" type="text/css" />
<link rel="stylesheet" href="<?php echo LINK_ROOT; ?>/css/gl-styles.en.css">
<link rel="stylesheet" href="<?php echo LINK_ROOT; ?>/css/style.css" type="text/css" />
<link rel="stylesheet" href="<?php echo LINK_ROOT; ?>/css/css.css" type="text/css" />
<link rel="stylesheet" href="<?php echo LINK_ROOT; ?>/css/jquery-ui.css" type="text/css" />

<script type="text/javascript" src='<?php echo LINK_ROOT; ?>/js/jquery.js'></script>
<script type="text/javascript" src="<?php echo LINK_ROOT; ?>/js/gl-head-scripts.en.js"></script>
<script type="text/javascript" src='<?php echo LINK_ROOT; ?>/js/home1.js'></script>
<script type="text/javascript" src="<?php echo LINK_ROOT; ?>/js/scrollFix.js"></script>
<script type="text/javascript" src="<?php echo LINK_ROOT; ?>/js/menu1.js"></script>
<script type="text/javascript" src='<?php echo LINK_ROOT; ?>/js/index.js'></script>
<script type="text/javascript" src='<?php echo LINK_ROOT; ?>/js/jquery-ui.js'></script>
<title>
<?php 
if(isset($title)){
	echo $title.' - ';
}
?>
大数据云平台
</title>
</head>
<body>
<div id="Container" class="col">
  <div class="Header">
    <div  class="gl-zh cf">
      <div id="gl-header" class="cf">
        <div id="gl-header-top"> </div>
        <div id="gl-header-bottom" class="cf">
          <div id="gl-logo"> <a href="<?php echo CLOUD_INDEX; ?>" class="cf"> <img src="<?php echo LINK_ROOT; ?>/images/logo.jpg" width="258" height="46"  id="gl-logo-wolfram" /> </a> </div>
          <div id="gl-menu" class="cf">
            <div id="gl-menu-technologies" class="gl-has-submenu"> <a href="<?php echo MARKET_INDEX; ?>" class="gl-submenu-wrapper">数据商城</a> </div>
            <div id="gl-menu-solutions" class="gl-has-submenu"> <a href="<?php echo DATATOOL_INDEX; ?>" class="gl-submenu-wrapper">数据工具</a> </div>
            <div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo CLOUD_INDEX; ?>/index.php/0" class="gl-submenu-wrapper">知识论坛</a> </div>
            <div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo COMPETITION_INDEX; ?>" class="gl-submenu-wrapper">数据竞赛</a> </div>
            <div id="gl-menu-support" class="gl-has-submenu"><a href="<?php echo UNITY_INDEX; ?>/index.php?view=login&site=<?php echo $_GET['site']; ?>" class="gl-submenu-wrapper zq">我的专区</a></div>
            <div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo UNITY_INDEX; ?>/index.php?view=login&site=<?php echo $_GET['site']; ?>" class="gl-submenu-wrapper dl">登录</a> </div>
            <div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo UNITY_INDEX; ?>/index.php?view=regist&site=<?php echo $_GET['site']; ?>" class="gl-submenu-wrapper zc">注册</a> </div>
            <input type="hidden" id="index_url" value="<?php echo $index_url; ?>" />
            <input type="hidden" id="unity_index" value="<?php echo UNITY_INDEX; ?>" />
            <input type="hidden" id="competition_index" value="<?php echo COMPETITION_INDEX; ?>" />
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
      <a href="<?php echo CLOUD_INDEX; ?>">首页</a>&nbsp;&nbsp;>&nbsp;&nbsp;<?php if(isset($title)){echo $title;}/*else{echo '所有数据';}*/ ?>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
