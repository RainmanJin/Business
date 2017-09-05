<?php
//longcredit copyright

defined('_JEXEC') or die;

$document = $this;
// Shortcut for template base url:
$templateUrl = $document->baseurl . '/templates/' . $document->template;

//获得文章列表
$db=JFactory::getDBO();
$db->setQuery("select #__content.*,#__categories.path from #__content,#__categories where #__content.state=1 and #__content.featured=1 and #__categories.id=#__content.catid");
$result=$db->loadObjectList();

/*foreach($result as $row){
	if($row->alias=='datatools'){
		$datatools_url=$document->baseurl.'/index.php/'.$row->catid.'-'.$row->path.'/'.$row->id.'-'.$row->alias;
	}
}*/

$url_arr=explode('/',$_SERVER['REQUEST_URI']);

if(count($url_arr)<=3){
	
}else{
	if ($url_arr[3]==0){
		
	}else{
		$wenzhang_arr=explode('-',$url_arr[4]);
		if($wenzhang_arr[1]=='datatools'){
			
		}else{
			//获得文章内容
			$db=JFactory::getDBO();
			$db->setQuery("select title,introtext,modified,hits from #__content where id=".$wenzhang_arr[0]);
			$result=$db->loadObjectList();
			
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/style.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/css.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/gl-styles.en.css">
<link rel="stylesheet" href="<?php echo $templateUrl; ?>/js/jquery.bxSlider/jquery.bxslider.css" type="text/css" />
<script src="<?php echo $templateUrl; ?>/js/jquery.js"></script>
<script src="<?php echo $templateUrl; ?>/js/gl-head-scripts.en.js"></script>
<script src="<?php echo $templateUrl; ?>/js/jquery.bxSlider/jquery.bxSlider.min.js"></script>
<title>大数据云平台</title>
</head>
<body>
<div id="Container">
  <div class="Header">
    <div  class="gl-zh cf">
      <div id="gl-header" class="cf">
        <div id="gl-header-top"> </div>
        <div id="gl-header-bottom" class="cf">
          <div id="gl-logo"> <a href="<?php echo $document->baseurl; ?>" class="cf"> <img src="<?php echo $templateUrl; ?>/images/logo.jpg" width="258" height="46"  id="gl-logo-wolfram" /> </a> </div>
          <div id="gl-menu" class="cf">
            <div id="gl-menu-technologies" class="gl-has-submenu"> <a href="../market" class="gl-submenu-wrapper">数据商城</a> </div>
            <div id="gl-menu-solutions" class="gl-has-submenu"> <a href="../datatool" class="gl-submenu-wrapper">数据工具</a> </div>
            <div id="gl-menu-support" class="gl-has-submenu"> <a href="<?php echo $document->baseurl; ?>/index.php/0" class="gl-submenu-wrapper">知识论坛</a> </div>
            <div id="gl-menu-support" class="gl-has-submenu"> <a href="../competition" class="gl-submenu-wrapper">数据竞赛</a> </div>
          </div>
          <!--/#gl-menu -->
        </div>
        <!--/#gl-header-bottom -->
      </div>
      <!--/#gl-header -->
      <div id="gl-header-bg"><span>
        <!-- -->
        </span></div>
      <div id="gl-header-offset"><span>
        <!-- -->
        </span></div>
    </div>
  </div>
  
  <?php if (count($url_arr)<=3) : ?>
  <!--幻灯片 开始-->
  <div class="picture">
    <ul class="bxslider">
    <?php
	foreach($result as $row){
		//if($row->alias=='datatools'){
			//$datatools_url=$document->baseurl.'/index.php/'.$row->catid.'-'.$row->path.'/'.$row->id.'-'.$row->alias;
		//}else{
			$image=json_decode($row->images,true)['image_intro'];
			$link=json_decode($row->urls,true)['urla'];
			//echo '<li title="'.$row->title.'"><a href="'.$document->baseurl.'/index.php/'.$row->catid.'-'.$row->path.'/'.$row->id.'-'.$row->alias.'"><img src="'.$images_arr['image_intro'].'" width="100%" height="550px" /></a></li>';
			?>
            <li title="<?php echo $row->title; ?>"><a href="<?php echo $link; ?>" target="_blank"><img src="<?php echo $image; ?>" width="100%" height="550px" /></a></li>
            <?php
		//}
	}	
	?>
    </ul>
  </div>
  <!--幻灯片 结束-->
  <div class="clear"></div>
  <div class="contont1">
    <div  class="contont_T">
      <ul>
        <li class="num1"><a href="../market/" target="_blank"><img src="<?php echo $templateUrl; ?>/images/num_1.jpg" /></a></li>
        <li class="num2"><a href="<?php //echo $datatools_url; ?>../datatool/" target="_blank"><img src="<?php echo $templateUrl; ?>/images/num_2.jpg" /></a></li>
        <li class="num3"><a href="<?php echo $document->baseurl; ?>/index.php/0" target="_blank"><img src="<?php echo $templateUrl; ?>/images/num_3.jpg" /></a></li>
      </ul>
    </div>
  </div>
  <div class="clear"></div>
  <!--contont1 结束-->
  <div class="contont2">
    <div  class="contont_C">
      <div class="Data_provider">
        <h1>数据供应商</h1>
        <h2><a href="../market/" target="_blank"><img src="<?php echo $templateUrl; ?>/images/more.jpg" width="56" height="11" /></a></h2>
      </div>
      <div class="Date-Con">
        <ul>
          <li class="view second-effect"><a href="../market/index.php?manufacturer=2" target="_blank"><img src="<?php echo $templateUrl; ?>/images/logo_1.jpg" width="245" height="124" /></a>
            <div class="mask"> <a href="../market/index.php?manufacturer=2" target="_blank" class="info">Image</a></div>
          </li>
          <li class="view second-effect"><a href="../market/index.php?manufacturer=6" target="_blank"><img src="<?php echo $templateUrl; ?>/images/logo_2.jpg" width="245" height="124" /></a>
            <div class="mask"> <a href="../market/index.php?manufacturer=6" target="_blank" class="info"> Image</a></div>
          </li>
          <li class="view second-effect"><a href="../market/index.php?manufacturer=7" target="_blank"><img src="<?php echo $templateUrl; ?>/images/logo_3.jpg" width="245" height="124" /></a>
            <div class="mask"> <a href="../market/index.php?manufacturer=7" target="_blank" class="info"> Image</a></div>
          </li>
          <li class="view second-effect"><a href="../market/index.php?manufacturer=8" target="_blank"><img src="<?php echo $templateUrl; ?>/images/logo_4.jpg" width="245" height="124" /></a>
            <div class="mask"> <a href="../market/index.php?manufacturer=8" target="_blank" class="info"> Image</a></div>
          </li>
        </ul>
      </div>
      <div class="clear"></div>
      <div class="Data_provider">
        <h1>数据产品</h1>
        <h2><a href="../market/" target="_blank"><img src="<?php echo $templateUrl; ?>/images/more.jpg" width="56" height="11" /></a></h2>
      </div>
      <div class="Date-Con1">
        <ul>
          <li>
            <span class="D_right"><a href="../market/index.php?productype=36" target="_blank">数据集</a></span>
            <span class="D_left"><img src="<?php echo $templateUrl; ?>/images/num_4.jpg" width="43" height="41" /></span>
          </li>
          <li>
            <span class="D_right"><a href="../market/index.php?productype=37" target="_blank">分析报告</a></span>
            <span class="D_left"><img src="<?php echo $templateUrl; ?>/images/num_5.jpg" width="43" height="41" /></span>
          </li>
          <li>
            <span class="D_right"><a href="../market/index.php?productype=38" target="_blank">数学模型</a></span>
            <span class="D_left"><img src="<?php echo $templateUrl; ?>/images/num_6.jpg" width="43" height="41" /></span>
          </li>
          <li>
            <span class="D_right"><a href="../market/index.php?productype=39" target="_blank">BI产品</a></span>
            <span class="D_left"><img src="<?php echo $templateUrl; ?>/images/num_7.jpg" width="43" height="41" /></span>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--contont2 结束-->
  <div class="clear"></div>
  
  <?php else: ?>
      <!--建设中页面-->
	  <?php if ($url_arr[3]==0) : ?>
          <div align="center">
            <img src="<?php echo $templateUrl; ?>/images/building.jpg" />
          </div>
      <?php else: ?>
          <?php if($wenzhang_arr[1]=='datatools'): ?>
              <!--数据工具-->
              <?php require(dirname(__FILE__).'/datatools.php'); ?>
          <?php else: ?>
              <!--文章-->
              <div class="contont2">
                <div  class="contont_C">
                  <div style="margin-top:10px">
                    <strong><?php echo $result[0]->title; ?></strong>
                  </div>
                  <div>
                    <?php echo $result[0]->introtext; ?>
                  </div>
                </div>
              </div>
          <?php endif; ?>
      <?php endif; ?>
  <?php endif; ?>
  
  <div class="clear"></div>
  <div class="footer">
    <div class="foot">
      <ul>
        <li><a href="<?php echo $document->baseurl; ?>/index.php/0">公司概况</a></li>
        <li><a href="<?php echo $document->baseurl; ?>/index.php/0">联系我们</a></li>
        <li><a href="<?php echo $document->baseurl; ?>/index.php/0">隐私声明</a></li>
        <li><a href="<?php echo $document->baseurl; ?>/index.php/0">使用条例</a></li>
      </ul>
      <div class="clear"></div>
      <span>Copyright © 2007 LongCredit Institue Inc. All Rights Reserved　　<!--<a href="http://www.miibeian.gov.cn" target="_blank" style="color:#8e8f91">-->京ICP备13012612号-<!--1</a>--></span><span class="blue">8610-88861266</span><span class="mail">marketing@longcredit.com</span> </div>
    </div>
  </div>
  <!--footer 结束-->
  <div class="clear"></div>
</div>
<!--Container 结束-->
</body>
</html>

<script type="text/javascript">
$(document).ready(function(){
	//幻灯片开启
	$('.bxslider').bxSlider({'mode':'fade','captions':true,'pager':true,'auto':true});
});
</script>
