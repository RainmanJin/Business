<?php
require_once(FILE_ROOT.'/classes/class_competition.php');
$Competition=new Competition($_GET);
$competition=$Competition->Detail();
$sub_limit=$Competition->Sub_limit();

$title='个人参与';
?>
<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div id="wrap">
  <div id="main">
    <div id="competition">
    
      <?php require(FILE_ROOT.'/views/view_competition_header.php'); ?>
      <?php require(FILE_ROOT.'/views/view_competition_left.php'); ?>
      
      <!--中间-->
      <div class="attach-submission---titanic:-machine-learning-from-disaster-page comp-content with-sidebar _panel">
		<?php require(FILE_ROOT.'/views/view_competition_title.php'); ?>
        
        <div class="comp-content-inside">
          <div id="competition-intro"> </div>
          <h3>提交数据</h3>
          <div class="information-message"> 
            <strong> 您今天已经提交<span id="sub_num"><?php echo $sub_limit['sub_num']; ?></span>次了，还可以再提交<span id="remain_num"><?php echo $sub_limit['remain_num']; ?></span>次。 </strong> 
            这个限制将在<?php echo $sub_limit['remain_reset']; ?>后重置 
          </div>
          <form action="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_end&id_competition=<?php echo $competition['id_competition']; ?>" enctype="multipart/form-data" id="submission-form" method="post">
            <!--<input name="__RequestVerificationToken" type="hidden" value="Pw7WnKyx4u6fJWNNX2OCw3A8GoVeUIZ8B_NYpUz4znYccwzxmw__c4uQl4v0mY97SSBenKt78KUvudZiewf8s4AlSH81">-->
            <div id="upload-div" class="submission-item" style="padding-top:20px">
              <!--<input data-val="true" data-val-number="The field CompetitionId must be a number." data-val-required="The CompetitionId field is required." id="CompetitionId" name="CompetitionId" type="hidden" value="3136">
              <input id="SubmissionUpload" name="SubmissionUpload" type="file">
              <input type="button" value="选择文件">
              <div id="upload-name"></div>-->
              <div style="width:200px; border:0px solid #ccc; margin:auto">
              <input type="file" name="submission_file" id="submission_file" />
              <!--<input type="hidden" id="id_submission" value="<?php //echo $competition['id_submission'] ?>" />-->
              </div>
            </div>
            <fieldset>
              <textarea name="SubmissionDescription" id="SubmissionDescription" rows="8" data-val-length-max="16384" placeholder="添加一个文件描述"></textarea>
            </fieldset>
            <fieldset id="submit-progress" class="step2 _buttons">
              <input type="submit" value="提交" onclick="upload();return false" />
            </fieldset>
          </form>
          
          <ul id="submission-requirements">
            <li> <img src="<?php echo LINK_ROOT; ?>/images/file.png" alt="File Format">
              <h3>文件格式</h3>
              <p>您提交的竞赛文件必须是CVS格式的</p>
              <p>如果您有多个文件，可以用 zip/gz/rar/7z 这几种压缩格式来打包提交，不需要提交多次</p>
            </li>
            <li> <img src="<?php echo LINK_ROOT; ?>/images/rows.png" alt="Rows">
              <h3># 预先说明</h3>
              <p><!--我们希望您提交的解决方案至少有XXX个预报。--> 文件必须包含头部。 请参见有效的例子<a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_data&id_competition=<?php echo $competition['id_competition']; ?>" target="_blank"> 数据例子 </a></p>
            </li>
          </ul>
          <!--<script type="text/javascript">
			  $('#SubmissionUpload').change(function () {
				  $('#upload-name').text($(this).val().replace("C:\\fakepath\\", ""));
			  });
		  </script>-->
        </div>
      </div>
      
    </div>
  </div>
</div>
          
<script type="text/javascript">
$(document).ready(function(){
	$("#submission_file").uploadify({	
		swf:$('#competition_index').val()+"/js/uploadify.swf",
		//uploader:$('#competition_index').val()+"/index.php?ajax=competition&op=upload&description="+$('#SubmissionDescription').val()+'&time='+ new Date().getTime(),
		auto:false,
		width:200,
		height:30,
		queueSizeLimit : 1,
		buttonText:"选择文件",
		onUploadSuccess:function(file, data, response){
			if(data){
				alert(data);
			}else{
				window.location=$('#competition_index').val()+"/index.php?view=competition_sublist&id_competition="+url_get('id_competition');
			}
		}
	});
});

function upload(){
	if(parseInt($('#remain_num').html())<=0){
		alert('您今天已经提交了'+$('#sub_num').html()+'次了，不能再提交了！');
		return false;
	}
	var url=$('#competition_index').val()+"/index.php?ajax=competition&op=submission&id_competition="+url_get('id_competition')+"&description="+$('#SubmissionDescription').val()+'&time='+ new Date().getTime()
	$("#submission_file").uploadify("settings","uploader",url);
	$("#submission_file").uploadify("upload");
}
</script>

<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
