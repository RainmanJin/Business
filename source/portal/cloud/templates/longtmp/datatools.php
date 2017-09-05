<!--数据工具-->
<script src="<?php echo $templateUrl; ?>/js/swfobject.js"></script>

<div style="width:800px; height:600px; border:1px solid #CCC; margin:auto">
  <!--<noscript>-->
  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%" id="lipeixin">
      <param name="movie" value="<?php echo $templateUrl; ?>/lipeixin.swf" />
      <param name="quality" value="high" />
      <param name="bgcolor" value="#ffffff" />
      <param name="allowScriptAccess" value="sameDomain" />
      <param name="allowFullScreen" value="true" />
      
      <!--浏览器判断-->
      <?php if(!preg_match('/MSIE ([0-9].[0-9]{1,2})/', $_SERVER['HTTP_USER_AGENT'])): ?>
      <object type="application/x-shockwave-flash" data="<?php echo $templateUrl; ?>/lipeixin.swf" width="100%" height="100%">
          <param name="quality" value="high" />
          <param name="bgcolor" value="#ffffff" />
          <param name="allowScriptAccess" value="sameDomain" />
          <param name="allowFullScreen" value="true" />
      </object>
      <?php endif; ?>
  </object>
  <!--</noscript>  -->   
</div>

<script type="text/javascript">
$(document).ready(function(){
	flash();
});

function flash(){
	// For version detection, set to min. required Flash Player version, or 0 (or 0.0.0), for no version detection. 
	var swfVersionStr = "11.1.0";
	// To use express install, set to playerProductInstall.swf, otherwise the empty string. 
	var xiSwfUrlStr = "playerProductInstall.swf";
	var flashvars = {};
	var params = {};
	params.quality = "high";
	params.bgcolor = "#ffffff";
	params.allowscriptaccess = "sameDomain";
	params.allowfullscreen = "true";
	var attributes = {};
	attributes.id = "lipeixin";
	attributes.name = "lipeixin";
	attributes.align = "middle";
	swfobject.embedSWF(
		"lipeixin.swf", "flashContent", 
		"100%", "100%", 
		swfVersionStr, xiSwfUrlStr, 
		flashvars, params, attributes);
	// JavaScript enabled so display the flashContent div in case it is not replaced with a swf object.
	swfobject.createCSS("#flashContent", "display:block;text-align:left;");
}
</script>