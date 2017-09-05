      <!--标题-->
      <header id="comp-header"> 
        <div style=" width:215px; float:left; text-align:center">
          <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $competition['id_competition']; ?>">
            <img id="comp-image" src="<?php echo $competition['image']; ?>" style="width:auto; max-height:125px">
          </a>
        </div>
        
        <div id="comp-header-details">
          <h2> <?php echo $competition['reward']; ?> • <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_leaderboard&id_competition=<?php echo $competition['id_competition']; ?>"><?php echo $competition['teams']; ?> 个团队</a> </h2>
          <h1>
            <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $competition['id_competition']; ?>" style="font-size: 26px;"><?php echo $competition['name_competition']; ?> </a> 
          </h1>
          <div id="comp-header-stats">
            <div id="comp-header-stats-progress-section">
              <div id="comp-header-stats-progress">
                <div id="comp-header-stats-teams" style="width:<?php echo $competition['percent']; ?>%"> </div>
              </div>
              <div id="comp-progress-start"></div>
              <div id="comp-progress-end"></div>
              <!--<div class="comp-progress-milestone prohibit-entrants" style="left:87.30398%;">
                <div class="circle" style="background:blue"></div>
                <div class="milestone-key">进入/并入</div>
                <div class="milestone-caption">
                  <h2> <strong><?php echo date('m月d日',time()); ?></strong><br>
                    <?php echo $competition['togo']; ?> 天 </h2>
                  <h3> 到期于新的进入 &amp; 队伍合并 </h3>
                </div>
              </div>-->
            </div>
            
            <div id="comp-header-stats-start"> <?php echo $competition['start_time']; ?> </div>
            <div id="comp-header-stats-end"> <?php echo $competition['end_time']; ?> 
                <span class="to-go-note"> 
                <?php
				if($competition['deadline']>0){
				?>
                    （剩余<?php echo $competition['deadline']; ?>天） 
               	<?php
				}else{
				?>
                    （已过期<?php echo abs($competition['deadline']); ?>天） 
                <?php
				}
				?>
                </span> 
            </div>
          </div>
        </div>
        <div style="clear:both"></div>
      </header>
