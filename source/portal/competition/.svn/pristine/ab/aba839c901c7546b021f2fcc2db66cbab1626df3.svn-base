      <!--左侧-->
      <div class="comp-sidebar">
      
	  <?php require(FILE_ROOT.'/views/view_competition_dashboard.php'); ?>

        <div id="partial-mini-leaderboard">
          <div class="widget _panel" id="compside-leaderboard">
            <header>
              <h1><a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_leaderboard&id_competition=<?php echo $competition['id_competition']; ?>">排行榜</a></h1>
            </header>
            <ol>
			  <?php
              if($competition['leaderboard']){
                  foreach($competition['leaderboard'] as $key=>$leaderboard){
                  ?>
                      <li value="<?php echo $key+1; ?>" style="list-style-type:decimal"><?php echo $leaderboard['display_name']; ?></li>
                  <?php	
                  }
              }else{
                  ?>
                  <li>暂无任何团队或个人参与</li>
                  <?php
              }
              ?>
            </ol>
          </div>
        </div>
        
        <!--<div class="widget _panel" id="compside-discussions">
          <header>
            <h1><a href="https://www.kaggle.com/c/afsis-soil-properties/forums">论坛 (43 topics)</a></h1>
          </header>
          <ul>
            <li>
              <div class="post-title"><a href="https://www.kaggle.com/c/afsis-soil-properties/forums/t/10557/leaderboards/55765#post55765">Leaderboards</a></div>
              <div class="post-time">14 minutes ago</div>
            </li>
            <li>
              <div class="post-title"><a href="https://www.kaggle.com/c/afsis-soil-properties/forums/t/10527/sentinel-landscape-analysis/55755#post55755">Sentinel Landscape Analysis</a></div>
              <div class="post-time">10 hours ago</div>
            </li>
            <li>
              <div class="post-title"><a href="https://www.kaggle.com/c/afsis-soil-properties/forums/t/10496/of-uploads-per-day-should-be-more-than-3/55742#post55742"># of uploads per day should be more than 3 </a></div>
              <div class="post-time">15 hours ago</div>
            </li>
            <li>
              <div class="post-title"><a href="https://www.kaggle.com/c/afsis-soil-properties/forums/t/10544/is-this-problem-difficult/55723#post55723">Is this problem difficult?</a></div>
              <div class="post-time">22 hours ago</div>
            </li>
            <li>
              <div class="post-title"><a href="https://www.kaggle.com/c/afsis-soil-properties/forums/t/10158/training-set-cross-validation/55662#post55662">Training set cross validation</a></div>
              <div class="post-time">2 days ago</div>
            </li>
            <li>
              <div class="post-title"><a href="https://www.kaggle.com/c/afsis-soil-properties/forums/t/10199/p-value-prediction/55648#post55648">P value prediction</a></div>
              <div class="post-time">2 days ago</div>
            </li>
          </ul>
        </div>-->
        
        <div id="partial-stats-ticker">
          <div id="stats-ticker">
            <div id="teams" class="ticker">
              <div class="numbers converted">
                <?php
				foreach(str_split($competition['teams']) as $num){
				?>
                    <div class="ticker-number ticker-<?php echo $num; ?>"></div>
                <?php
				}
				?>
              </div>
              <div class="ticker-caption">个团队</div>
            </div>
            <div id="players" class="ticker">
              <div class="numbers converted">
                <?php
				foreach(str_split($competition['players']) as $num){
				?>
                    <div class="ticker-number ticker-<?php echo $num; ?>"></div>
                <?php
				}
				?>
              </div>
              <div class="ticker-caption">个参与者</div>
            </div>
            <div id="entries" class="ticker">
              <div class="numbers converted">
                <?php
				foreach(str_split($competition['entries']) as $num){
				?>
                    <div class="ticker-number ticker-<?php echo $num; ?>"></div>
                <?php
				}
				?>
              </div>
              <div class="ticker-caption">个已提交</div>
            </div>
          </div>
        </div>
      </div>
