<?php
if(!isset($_SESSION['user'])){
	header('location:'.UNITY_INDEX.'/index.php?view=login&site=datatool');
}

$title='我的工作空间';
?>

<?php require(FILE_ROOT.'/php/views/view_header.php'); ?>

<div class="Main">
  <?php //require(FILE_ROOT.'/wp.html'); ?>
  
  <input type="hidden" id="id_user" value="<?php echo $_SESSION['user']['id_user']; ?>" /> 
  <input type="hidden" id="editor_para"  value="" />
  <iframe src="<?php echo LINK_ROOT ?>/wp.html" width="100%" height="1000" frameborder="0" id="datatool_iframe"></iframe>
</div>

<?php require(FILE_ROOT.'/php/views/view_footer.php'); ?>
