<?php
require_once(FILE_ROOT.'/classes/class_competition.php');
$Competition=new Competition($_GET);
$competition=$Competition->Detail();

$title='提交数据';
?>
<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div id="wrap">
  <div id="main">
    <div id="competition">
    
      <?php require(FILE_ROOT.'/views/view_competition_header.php'); ?>
      <?php require(FILE_ROOT.'/views/view_competition_left.php'); ?>
      
      <!--中间-->
      <div class="description comp-content with-sidebar _panel">
        
        <div class="comp-content-inside">
          <div id="competition-intro"> </div>
          <h3>提交数据</h3>
          <form id="submitAsForm" method="POST" action="" class="_buttons">
            <input name="id_acception" id="id_acception" type="hidden" value="<?php echo $competition['id_acception']; ?>">
            <div>
              <?php
			  if($_SESSION['user']['is_leader']==1){
			  ?>
                  <input type="button" value="个人参与" onClick="alert('团队领袖不能以个人的名义提交！')">
              <?php
			  }else{
			  ?>
                  <!--<input type="button" value="个人参与" onClick="window.location='<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_submission&id_competition=<?php echo $competition['id_competition']; ?>'">-->
                  <input type="button" value="个人参与" onClick="subchoose(2)" />
              <?php
			  }
			  ?>
              <p>&nbsp;<!--（稍后也可以添加成员）--></p>
              <img src="<?php echo LINK_ROOT; ?>/images/compete-alone.png"> </div>
            <div>
              <!--<input type="button" value="团队参与" onClick="window.location='<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_team&id_competition=<?php echo $competition['id_competition']; ?>&team=1'">-->
              <input type="button" value="团队参与" onClick="subchoose(3)" />
              
              <p>&nbsp;</p>
              <img src="<?php echo LINK_ROOT; ?>/images/compete-team.png"> </div>
          </form>
        </div>
        
        
      </div>
      
    </div>
  </div>
</div>

<script type="text/javascript">
function subchoose(choose){
	var id_competition=url_get('id_competition');
	//var id_acception=url_get('id_acception');
	var id_acception=$('#id_acception').val();
	$.ajax({
		url:$('#competition_index').val()+"/index.php?ajax=competition&op=choose&time="+ new Date().getTime(),
		data:'id_acception='+id_acception+'&choose='+choose,
		type:'POST',
		async:true,
		beforeSend: function(){
			pop_loading();
		},
		success: function(text){
			pop_loading_close();
			if(choose==2){
				window.location=$('#competition_index').val()+'/index.php?view=competition_submission&id_competition='+id_competition;
			}else{
				window.location=$('#competition_index').val()+'/index.php?view=competition_team&id_competition='+id_competition+'&team=1';
			}
		}
		
	});
}
</script>

<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
