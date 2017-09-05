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
if(isset($product['name'])){
	echo $product['name'].' - ';
}
if(isset($title)){
	echo $title.' - ';
}
?>
数据商城
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
           <!-- <div id="gl-menu-solutions" class="gl-has-submenu"> <a href="<?php echo CLOUD_INDEX; ?>/index.php/2-uncategorised/3-datatools" target="_blank" class="gl-submenu-wrapper">数据工具</a> </div>-->
            <div id="gl-menu-solutions" class="gl-has-submenu"> <a href="<?php echo DATATOOL_INDEX; ?>" class="gl-submenu-wrapper">数据工具</a> </div>
            <!--<div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo COMMUNITY_INDEX; ?>" class="gl-submenu-wrapper">知识论坛</a> </div>-->
            <div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo CLOUD_INDEX; ?>/index.php/0" class="gl-submenu-wrapper">知识论坛</a> </div>
            <div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo COMPETITION_INDEX; ?>" class="gl-submenu-wrapper">数据竞赛</a> </div>
            <div id="gl-menu-support" class="gl-has-submenu"> 
              <a href="<?php echo MARKET_INDEX; ?>/index.php?view=my" class="gl-submenu-wrapper zq">
				<?php
                if(isset($_SESSION['customer'])){
                ?>
                    <?php echo $_SESSION['customer']['lastname']; ?>
                <?php
                }else{
                ?>
                    我的专区
                <?php
                }
                ?>
              </a> 
            </div>
            <?php
			if(isset($_SESSION['customer'])){
			?>
                <div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo MARKET_INDEX; ?>/index.php?ajax=customer&op=logout" class="gl-submenu-wrapper dl">登出</a></div>
            <?php
			}else{
			?>
                <div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo UNITY_INDEX; ?>/index.php?view=login&site=market" class="gl-submenu-wrapper dl">登录</a> </div>
                <div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo UNITY_INDEX; ?>/index.php?view=regist&site=market" class="gl-submenu-wrapper zc">注册</a> </div>
            <?php
			}
			?>
            <input type="hidden" id="unity_index" value="<?php echo UNITY_INDEX; ?>" />
            <input type="hidden" id="market_index" value="<?php echo MARKET_INDEX; ?>" />
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
      <a href="<?php echo CLOUD_INDEX; ?>">首页</a>&nbsp;&nbsp;>&nbsp;&nbsp;<a href="<?php echo MARKET_INDEX; ?>">数据商城</a>&nbsp;&nbsp;>&nbsp;&nbsp;<?php if(isset($title)){echo $title;}else{echo '所有数据';} ?>
      
      <span class="search">
      	<form>
          <input  type="text" class="input_ys"  id="index_keyword" name="index_keyword" 
          value="<?php if(!isset($_GET['kw'])){echo KEYWORD_DEFAULT;}else{echo $_GET['kw'];$clear_arr['kw']=$_GET['kw'];} ?>" 
          onClick="keyword_default('index','click','<?php echo KEYWORD_DEFAULT; ?>')" 
          onBlur="keyword_default('index','blur','<?php echo KEYWORD_DEFAULT; ?>')" 
		  <?php if(!isset($_GET['kw'])){?>style="color:#ccc"<?php } ?> />
          
          <input type="submit" onclick="<?php if(isset($_GET['view'])){ ?> other_search() <?php }else{ ?> list_search('index','<?php echo KEYWORD_DEFAULT; ?>') <?php } ?>;return false" style="display:none" />
        </form>
        <!--position:absolute; top:16px; left:955px;-->
        <span style="position:absolute; top:19px; left:955px;">
          <a href="javascript:;" onclick="<?php if(isset($_GET['view'])){ ?> other_search() <?php }else{ ?> list_search('index','<?php echo KEYWORD_DEFAULT; ?>') <?php } ?>">
            <img src="<?php echo LINK_ROOT; ?>/images/search.jpg" width="16" height="16" />
          </a>
        </span>
      </span>
      
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
