<?php
require_once(FILE_ROOT.'/classes/class_competition.php');
$Competition=new Competition($_GET);
$competition=$Competition->Detail();
$sub_list=$Competition->Sub_list();

$title='详情';
?>
<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div id="wrap">
  <div id="main">
    <div id="competition">
    
      <?php require(FILE_ROOT.'/views/view_competition_header.php'); ?>
      <?php require(FILE_ROOT.'/views/view_competition_left.php'); ?>


      <div class="submissions---american-epilepsy-society-seizure-prediction-challenge-page comp-content with-sidebar _panel">
        <div class="comp-content-inside">
          <div id="competition-intro"> </div>
          <div class="submissions-section _buttons">
            <h3>我的提交（非公开）</h3>
            <div class="submissions-note">
              <p> 
                你可以作为一个团队领袖领导团队来参与 
                <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_team&id_competition=<?php echo $competition['id_competition']; ?>"><?php echo $_SESSION['user']['display_name']; ?></a>。
                <a class="comp-link" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_submission&id_competition=<?php echo $competition['id_competition']; ?>">提交数据 »</a> 
              </p>
              
              <p>
                <strong>注意：</strong> 
                你可以选择 <strong>2</strong> 个提交用于计算你最终在排行榜中分数，如果 2 个提交没有被选择，评委会被挑选你得分最高的提交显示在公开排行榜中。 
              </p>
              
              <!--<p> 你最终分数不是基于相同精确分段数据显示在排行榜中的，但是宁可一个不同的非公开的数据提交设置从你满你的提交公开分数是仅仅一个粗略的表示你最后的分数是。 
                因此你应该从所有的提交中选择最好的来提交，而不是在公开的提交设置中最有必要的
              </p>-->
              
              <p> <strong>你团队的最终分数将会是从非公开提交中的被选中的2个中评分最高的来决定。</strong> </p>
            </div>
            <form id="form_sublist" action="http://www.kaggle.com/c/3960/submissions/update-selected" method="post">
              <!--<input name="__RequestVerificationToken" type="hidden" value="eoubuFef5eAL0_fEmZlMRf3WSB8ppiG1Yqd_esq8WnkzpceQ7TZ-DONiU4pc-Ak7QdH3HNJqq64Ig_VLxunrCe9C_fA1">-->
              <table class="nicetable roomy align-top full submissions _buttons">
                <colgroup>
                <col class="leader-submission" width="35%">
                <col class="leader-files">
                <col class="leader-value" width="15%">
                <col class="leader-delete">
                </colgroup>
                <tbody>
                  <tr>
                    <th><a href="javascript:;">提交</a></th>
                    <th><a href="javascript:;">文件</a></th>
                    <th><a href="javascript:;">公开分数</a></th>
                    <th><a href="javascript:;">选择？</a></th>
                  </tr>
                </tbody>
                <tbody>
                
                <?php
				if($sub_list){
					foreach($sub_list as $key=>$sublist){
					?>
                        <tr>
                          <td>
						  <?php echo $sublist['submission_time']; ?>
                          <?php
						  if($sublist['description']){
						  ?>
                          		<br />（<?php echo $sublist['description']; ?>）
                          <?
						  }
						  ?>
                          </td>
                          <td>
                          <?php
						  if($sublist['url']){
						  ?>
                              <a href="<?php echo $sublist['url']; ?>"><?php echo $sublist['file']; ?></a>
                          <?php
						  }else{
						  ?>
                          	  <?php echo $sublist['file']; ?>
                          <?php
						  }
						  ?>
                          </td>
                          <td><?php echo $sublist['score']; ?></td>
                          <td><input type="checkbox" name="subchecked[]" class="subchecked" id="" <?php if($sublist['checked']==1){echo 'checked';} ?> value="<?php echo $sublist['id_submission']; ?>" />
                        </tr>
                    <?php	
					}
				}else{
					?>
                    <tr>
                      <td colspan="4">你暂无任何提交</td>
                    </tr>
                    <?php
				}
                ?>
                </tbody>
              </table>
              <input type="submit" id="submit-selection-changes" value="提交已选择的来评分" onclick="subchange();return false" />
              <!--<div id="submission-save-warning"></div>-->
            </form>
            <!--<div id="description-edit" title="Edit description">
              <form id="description-edit-form" action="http://www.kaggle.com/oldurl" method="POST" enctype="multipart/form-data">
                <label for="dialogtext">Description</label>
                <textarea id="dialogtext" class="submission-desc-textarea" name="newDescription"></textarea>
              </form>
            </div>-->
          </div>
          <script type="text/javascript">
          /*$(function () {
      
              function checkForBadSubmissions() {
                  if ($('tr.invalid.selected').length) {
                      $('#submission-save-warning').html('One or more of your selected entries contains error(s) &amp; cannot be scored. We recommend you unselect these entries.');
                  } else {
                      $('#submission-save-warning').html('');
                  }
              }
      
              $('a.show-submission-warnings').click(function (e) {
                  e.preventDefault();
                  $(this).next('ul').slideToggle('fast');
                  if ($(this).find('.arrow').html() == '▼') {
                      $(this).find('.arrow').html('&#9650;');
                  } else {
                      $(this).find('.arrow').html('&#9660;');
                  }
              });
      
              // submission table highlight checked
              $('.submission-check:checked').parent().parent().addClass('selected');
              $('.submission-check').change(function () {
                  $(this).parent().parent().toggleClass('selected');
                  checkForBadSubmissions();
              });
      
              checkForBadSubmissions();
      
              $('.submission-desc-edit').click(function (e) {
      
                  e.preventDefault();
                  var desc = $(this).parents('tr').find('td:first-child').find('.submission-desc').html().trim();
                  var currentHash = $(this).parents('tr').find('.current-hash').text().trim();
                  var actionUrl = $(this).attr('href');
                  $('#description-edit-form').attr('action', actionUrl);
      
                  $('.submission-desc-textarea').val(desc);
                  if (currentHash != '') {
                      $('#hash-edit').val(currentHash).removeClass('placeholder');
                  }
      
                  $("#description-edit").dialog({
                      resizable: false,
                      width: 370,
                      modal: true,
                      buttons: {
                          "Submit": function () {
                              $('#description-edit-form').submit();
                          },
                          Cancel: function () {
                              $(this).dialog("close");
                          }
                      }
                  });
      
                  if ($(this).hasClass('hash-edit-link')) {
                      $('#hash-edit').focus().select();
                  } else if ($(this).hasClass('desc-edit')) {
                      $('.submission-desc-textarea').focus().select();
                  }
      
              });
      
			});*/
		function subchange(){
			var num=0;
			$('.subchecked').each(function(){
				if(this.checked){
					num++;
				}
			});
			if(num>2){
				alert('请最多选择2个！');
				return false;
			}
			$.ajax({
				url:$('#competition_index').val()+"/index.php?ajax=competition&op=subchecked&time="+ new Date().getTime(),
				data:$('#form_sublist').serialize(),
				type:'POST',
				async:true,
				beforeSend: function(){
					pop_loading();
				},
				success: function(text){
					pop_loading_close();
					if(text){
						alert(text);
					}else{
						window.location.reload();
					}
				}
			});
		}
		</script>
        </div>
      </div>

    </div>
  </div>
</div>

<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
