        <header class="info">
          <div class="simple-steps"> 
          <a class="info" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $competition['id_competition']; ?>">竞赛详情</a> » 
          <a class="data" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_data&id_competition=<?php echo $competition['id_competition']; ?>">下载数据</a> » 
		  <?php
          if($competition['deadline']>0&&$competition['enterable']==1){
              if(isset($_SESSION['user'])){
				  if($_SESSION['user']['active']==1){
					  if($competition['choose']){
						  if($_SESSION['user']['team']){
							  if($_SESSION['user']['is_leader']==1){
								  ?>
								  <a class="submit" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_submission&id_competition=<?php echo $competition['id_competition']; ?>">提交数据</a>
								  <?php
							  }else{
								  ?>
								  <a class="submit" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_team&id_competition=<?php echo $competition['id_competition']; ?>&team=1">提交数据</a>
								  <?php
							  }
						  }else{
							  switch($competition['choose']){
								  case 1:
								  ?>
								  <a class="submit" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_subchoose&id_competition=<?php echo $competition['id_competition']; ?>">提交数据</a>
								  <?php
								  break;
								  
								  case 2:
								  ?>
								  <a class="submit" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_submission&id_competition=<?php echo $competition['id_competition']; ?>">提交数据</a>
								  <?php
								  break;
								  
								  case 3:
								  ?>
								  <a class="submit" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_team&id_competition=<?php echo $competition['id_competition']; ?>&team=1">提交数据</a>
								  <?php
								  break;
								  
								  default:
								  break;
							  }
						  }
					  }else{
					  ?>	
						  <a class="submit" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_rule&id_competition=<?php echo $competition['id_competition']; ?>&confirm=1">提交数据</a>
					  <?php
					  }
				  }else{
					  if($_SESSION['user']['m_active']==1){
						  ?>
						  <a class="submit" href="javascript:;" onclick="alert('您的帐号因违规或其他特殊原因被管理员禁用！请联系管理员。')">提交数据</a>
						  <?
					  }else{
						  ?>
						  <a class="submit" href="javascript:;" onclick="pop_validate_email()">提交数据</a>
						  <?
					  }
				  }
              }else{
              ?>
                  <!--<a class="submit" href="<?php echo UNITY_INDEX; ?>/index.php?view=login&site=competition">提交数据</a> -->
                  <a class="submit" href="javascript:;"  onclick="pop_div(360,390,'登录','login','reload')">提交数据</a>
              <?php
              }
          }
          ?>
        </header>
