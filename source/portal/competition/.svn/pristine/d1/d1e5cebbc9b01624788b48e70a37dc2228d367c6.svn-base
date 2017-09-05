<?php
require_once(FILE_ROOT.'/classes/class_competition.php');
$Competition=new Competition($_GET);
$competition=$Competition->Detail();
$file_list=$Competition->File_list();

$title='下载数据';
?>
<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div id="wrap">
  <div class="message success" style="display:none"><div class="message-inside">谢谢你同意该规则</div></div>
  <div id="main">
    <div id="competition">
    
      <?php require(FILE_ROOT.'/views/view_competition_header.php'); ?>
      <?php require(FILE_ROOT.'/views/view_competition_left.php'); ?>
      
      <!--中间-->
      <div class="description comp-content with-sidebar _panel">
		<?php require(FILE_ROOT.'/views/view_competition_title.php'); ?>
        
        <div class="comp-content-inside">
          <div id="competition-intro"> </div>
          <h3>数据文件</h3>
          <table id="data-files" class="nicetable full roomy align-top border">
            <thead>
              <tr>
                <th colspan="2">文件名称</th>
                <th>可用格式</th>
              </tr>
            </thead>
            <?php
			if($file_list){
				foreach($file_list as $file){
				?>
					<tbody>
					  <tr>
						<td class="file-name" colspan="2" rowspan="1"><?php echo $file['name']; ?></td>
						<td><a href="<?php echo $file['url']; ?>" target="_blank"><?php echo $file['extend_name']; ?> (<?php echo $file['size']; ?>)</a></td>
					  </tr>
					</tbody>
				<?php
				}
			}else{
				?>
                <tbody>
                  <tr>
                    <td class="file-name" colspan="3" rowspan="1">暂无任何文件</td>
                  </tr>
                </tbody>
                <?php
			}
			?>
          </table>
          
          <div class="cms-page">
          <?php echo $competition['data']; ?>
          </div>
          
          <div class="rules-overlay" style="display:none">
            <div class="rules-dialog">
              <div class="rules-dialog-text">
                <h2>你 <strong>必须</strong> 同意这个 <a href="https://www.kaggle.com/c/sentiment-analysis-on-movie-reviews/rules" target="_blank">竞赛规则</a><br>
                  在你将要下载文件之前。</h2>
                <p>点击 "我同意并我接受" 按钮后,<br>
                  表示你将同意并遵守该规则。</p>
              </div>
              <form action="https://www.kaggle.com/c/sentiment-analysis-on-movie-reviews/rules/accept?competitionId=sentiment-analysis-on-movie-reviews" class="rules-form _buttons" method="post">
                <input name="__RequestVerificationToken" type="hidden" value="yo9AJlEkbnJyt8GNXYn8hnyPUuAEPlKYEx5EB5S-roxm2ZI2nWBJ3oABAgsa4gG0EUAD9yPN09OobapHWype0pANHlo1">
                <input type="hidden" id="returnUrl" name="returnUrl" value="">
                <input type="submit" name="doAccept" value="我同意并接受">
                <a href="javascript:;" onclick="$('.rules-overlay').hide()">我不同意</a>
              </form>
            </div>
          </div>
          
          
        </div>
        
        
        
        
        
      </div>
      
    </div>
  </div>
</div>

<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
