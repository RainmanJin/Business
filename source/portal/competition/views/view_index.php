<?php
require_once(FILE_ROOT.'/classes/class_competition.php');
$Competition=new Competition($_GET);
$index_result=$Competition->Index_result();
$active_list=$index_result['active_list'];
$competitions_list=$index_result['competitions_list'];
$competitions_num=$index_result['competitions_num'];
$active_num=$index_result['active_num'];
?>

<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div id="wrap">

  <div id="competitions-intro-container" style="background:#df614b;">
    <div id="competitions-intro">
      <div>
        <h1>欢迎来到数据竞赛，国内最领先的数据竞赛平台。以下例举可以教您如何融入到竞赛当中 —</h1>
        <p> 想成为数据专家？ <a href="<?php echo CLOUD_INDEX; ?>/index.php/0" target="_blank">访问我们的知识库 »</a><br>
          了解一下 <a href="<?php echo CLOUD_INDEX; ?>/index.php/0" target="_blank">如何创建一个竞赛 »</a><br>
          <a href="<?php echo CLOUD_INDEX; ?>/index.php/0" target="_blank">学习者 &amp; 参与研究一个竞赛 »</a> </p>
      </div>
      <ul>
        <li> <img src="<?php echo LINK_ROOT; ?>/images/competitions-intro-step1.png" alt="Enter">
          <h2>参与</h2>
          <p>选择一个竞赛项目 &amp; 下载练习数据。 您不需要新的技能或软件才能提交。 </p>
        </li>
        <li> <img src="<?php echo LINK_ROOT; ?>/images/competitions-intro-step2.png" alt="Build">
          <h2>创建</h2>
          <p>建立一个您符合您意愿的模型并上传您预先准备好的数据到我们的平台。 </p>
        </li>
        <li> <img src="<?php echo LINK_ROOT; ?>/images/competitions-intro-step3.png" alt="Win">
          <h2>...赢取!</h2>
          <p>我们的平台会对您所提出的解决方案打分并且您可以看到您分数的<a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=leaderboard" target="_blank">排名</a>。</p>
        </li>
      </ul>
    </div>
  </div>
  
  <div id="competitions" class="content">
  
    <!--左侧-->
    <div id="competitions-page-sidebar">
      <ul id="view-switch">
        <li id="recent-switch" data-target="competitions-recent" class="">进行中的竞赛</li>
        <li id="all-switch" data-target="competitions-all" class="active">所有竞赛</li>
      </ul>
      <div id="sidebar-all-competitions" style="display: block;">
        <form id="competitions-sidebar" action="<?php echo COMPETITION_INDEX; ?>/index.php?ajax=competition&op=all" method="POST">
          <h2 id="competitions-found">
          <span id="sidebar-total-comps-found"><?php echo $competitions_num; ?></span> 个已找到, 
          <span id="sidebar-active-comps-found"><?php echo $active_num; ?></span> 个进行中的 
          <img src="<?php echo LINK_ROOT; ?>/images/spinner-small.gif" alt="Wait cursor" class="spinner" style="display:none;">
          </h2>
          <input id="search" name="Query" type="text" placeholder="搜索竞赛">
          <input type="hidden" id="active-sort" name="reward" value="desc"><!--默认排序-->
          <div id="competitions-filter">
            <div class="filter" id="all-or-enterable">
              <ul>
                <li>
                  <input value="AllCompetitions" id="all" type="radio" name="SearchVisibility" checked="checked">
                  <label for="all" class="checked">所有的</label>
                </li>
                <li>
                  <input value="EnterableCompetitions" id="enterable" type="radio" name="SearchVisibility">
                  <label for="enterable">可参与的</label>
                </li>
                <!-- only show if user has entered a comp -->
              </ul>
            </div>
            <div class="filter">
              <h3>状态</h3>
              <ul>
                <li>
                  <input name="ShowActive" id="active" type="checkbox" value="true" checked="checked">
                  <label class="active checked" for="active">进行中的</label>
                </li>
                <li>
                  <input name="ShowCompleted" id="completed" type="checkbox" value="true">
                  <label class="active" for="completed">完成的</label>
                </li>
              </ul>
            </div>
            <div class="filter" style="display: none">
              <h3>类型</h3>
              <ul>
                <li>
                  <input name="ShowProspect" id="prospect" type="checkbox" value="true" checked="checked">
                  <label class="prospect checked" for="prospect">Prospect</label>
                </li>
                <li>
                  <input name="ShowOpenToAll" id="open" type="checkbox" value="true" checked="checked">
                  <label class="open checked" for="open">Open to all</label>
                </li>
                <li>
                  <input name="ShowPrivate" id="private" type="checkbox" value="true" checked="checked">
                  <label class="private checked" for="private">Private</label>
                </li>
                <li>
                  <input name="ShowLimited" id="limited" type="checkbox" value="true" checked="checked">
                  <label class="limited checked" for="limited">Limited</label>
                </li>
              </ul>
            </div>
            <div class="filter">
              <h3>发起者</h3>
              <ul>
                <li>
                  <input name="ShowInclass" id="inclass" type="checkbox" value="true">
                  <label class="inclass" for="inclass">学习者（实习竞赛）</label>
                </li>
              </ul>
            </div>
          </div>
          <input type="submit" value="Update" style="display: none;">
        </form>
      </div>
    </div>
    
    <!--中间-->
    <div id="competitions-content">
      <!--进行中的-->
      <div id="competitions-recent" style="display: none;">
        <li class="home-item current-comps _panel">
          <header class="homepage-heading comp-type" id="active-heading">
            <div class="heading-icon"></div>
            <h1> <a href="<?php echo COMPETITION_INDEX; ?>">进行中的竞赛</a> </h1>
          </header>
          <form id="open_competition" method="post" target="_blank" style="display:none"></form>
		  <?php 
		  foreach($active_list as $key=>$active){
			  if(count($active['competition'])>0){
			  ?>
                  <div class="front-current-container" id="<?php echo $key ?>-container">
                   <ul class="front-current multiple" id="<?php echo $key ?>">
                   
                    <?php
                    foreach($active['competition'] as $competition){
                    ?>
                    <li onclick="open_competition(<?php echo $competition['id_competition']; ?>)"> 
                      <a class="comp-link" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $competition['id_competition']; ?>" target="_blank">
                        <img class="front-current-image" src="<?php echo $competition['image'] ?>" width="76" height="76">
                      </a>
                      <div class="front-comp-details">
                        <div class="comp-desc-column">
                          <h3> <a class="comp-link" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $competition['id_competition']; ?>" target="_blank"><?php echo $competition['name_competition'] ?></a> </h3>
                          <div class="front-comp-desc"><?php echo $competition['introduce'] ?></div>
                        </div>
                        <div class="comp-stats-column">
                          <div class="stats stats-ending"> <strong><?php echo $competition['deadline'] ?></strong> </div>
                          <div class="stats stats-teams"> <strong><?php echo $competition['teams'] ?>支团队</strong> </div>
                          <div class="stats stats-prize"> <strong><?php echo $competition['reward'] ?></strong> </div>
                        </div>
                      </div>
                    </li>
                    <?php
                    }
                    ?>
                   
                   </ul>
                   <div class="tooltip">
                     <div class="tooltip-text" style="top: 6px;"><?php echo $active['cn'] ?></div>
                   </div>
                  </div>
				  <?php
			  }
		  }
		  if($active_num==0){
		  ?>
              <div class="front-current-container" id="featured-container">
               <ul class="front-current multiple">
                 <li>暂无任何竞赛</li>
               </ul>
               <div class="tooltip">
                 <div class="tooltip-text" style="top: 6px;">暂无任何竞赛</div>
               </div>
              </div>
          <?php
          }
          ?>
		</li>
      </div>
      
      <!--所有的-->
      <div id="competitions-all" style="display: block;">
        <table id="competitions-table">
          <colgroup>
          <col width="52%">
          <col width="16%">
          <col width="16%">
          <col width="16%">
          </colgroup>
          <thead>
            <tr>
              <th class="not-sorted"> 
              <a href="javascript:;" onclick="sort_all('name_competition')"><img class="sort_img" id="sort_img_name_competition" src="<?php echo LINK_ROOT; ?>/images/sort-not-sorted.png"> 名称 </a> 
              </th>
              
              <th class="sorted descending"> 
              <a href="javascript:;" onclick="sort_all('reward')"><img class="sort_img" id="sort_img_reward" src="<?php echo LINK_ROOT; ?>/images/sort-descending.png"> 报酬 &nbsp;</a>
              </th>
              
              <th class="not-sorted"> 
              <a href="javascript:;" onclick="sort_all('teams')"><img class="sort_img" id="sort_img_teams" src="<?php echo LINK_ROOT; ?>/images/sort-not-sorted.png"> 团队 &nbsp;</a> 
              </th>
              
              <th class="not-sorted"> 
              <a href="javascript:;" onclick="sort_all('deadline')"><img class="sort_img" id="sort_img_deadline" src="<?php echo LINK_ROOT; ?>/images/sort-not-sorted.png"> 剩余时间 &nbsp;</a> 
              </th>
            </tr>
          </thead>
          <tbody id="competitions_all">
			<?php
			if($competitions_num>0){
				foreach($competitions_list as $competition){
				?>
					<tr class="active-comp">
					  <td><a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $competition['id_competition']; ?>" target="_blank"><img class="competition-image" src="<?php echo $competition['image']; ?>" width="76" height="76" alt="seizure-prediction Image"></a>
						<div class="competition-details">
						  <div class="competitions-types"> </div>
						  <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $competition['id_competition']; ?>" target="_blank">
						  <h4><?php echo $competition['name_competition']; ?></h4>
						  </a>
						  <p class="competition-summary"> <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $competition['id_competition']; ?>" target="_blank"><?php echo $competition['introduce']; ?></a> </p>
						</div></td>
					  <td><?php echo $competition['reward']; ?></td>
					  <td><?php echo $competition['teams']; ?></td>
					  <td><?php echo $competition['deadline']; ?></td>
					</tr>
				 <?php
				}
			}else{
				?>
                    <tr class="active-comp">
                      <td colspan="4" style="height:50px">暂无任何竞赛</td>
                    </tr>
                <?
			}
            ?>
          </tbody>
        </table>
        <div id="page-number" class="page-number"> 
          显示 <strong>1–<span id="show_comps_found"><?php echo $competitions_num; ?></span></strong> 
          在 <span id="total-comps-found"><?php echo $competitions_num; ?></span> 个已找到的竞赛
          中 （<span id="active-comps-found"><?php echo $active_num; ?></span> 个进行中的） 
        </div>
      </div>
      
    </div>
    
  </div>
</div>
<!-- wrap -->

<script type="text/javascript">
$(document).ready(function () {
	$('.front-current-container .tooltip').mousemove(function(e) {
		$(this).find('.tooltip-text').css('top', e.offsetY-15);
	});
							

	$('#view-switch li').click(function () {
		$('#view-switch li').not(this).removeClass('active');
		$(this).addClass('active');
		
		var target = $(this).data('target');
		$('#competitions-content').children().not('#' + target).hide();
		$('#' + target).show();
		
		if ($(this).attr('id') == 'all-switch') {
			$('#sidebar-all-competitions').slideDown();
		} else {
			$('#sidebar-all-competitions').slideUp();
		}

	});

	if ($('body.logged-in').length) {
		$('#all-switch').click();
	} else {
		$('#recent-switch').click();
	}

	// find a comp bolding of checked boxes
	$('#competitions-sidebar input:checked').next('label').addClass('checked');
	$('#competitions-sidebar input[type=checkbox]').click(function () {
		$(this).next('label').toggleClass('checked');
	});

	$('#competitions-sidebar input[type=radio]').click(function () {
		$(this).parent().parent().find('label').removeClass('checked');
		$(this).next('label').addClass('checked');
	});

	$('#competitions-sidebar input[type=submit]').css('display', 'none');

	var currentCompetitionsSidebarAjaxRequest = null;

	// find-a-comp submit
	$('#competitions-sidebar').submit(function (e) {
		// stop submit and show spinner
		e.preventDefault();
		$('#competitions-sidebar h2 .spinner').css('display', 'inline');

		// get form action URL
		url = $(this).attr('action');

		// create form data array
		dataArray = $(this).serializeArray();

		if (currentCompetitionsSidebarAjaxRequest) {
			currentCompetitionsSidebarAjaxRequest.abort();
		}

		currentCompetitionsSidebarAjaxRequest = $.post(url, dataArray, function (data) {
			// display new content
			//var content = $(data).find('#competitions-all').contents();
			var content = data;
			$('#competitions_all').html(content);
			//$('#active-sort').name = content.find('#current-sort-column-name').attr("value");
			//$('#active-sort').value = content.find('#current-sort-direction').attr("value");

			// update totals
			//$('#competitions-found').html($(data).find('#competitions-found').html());
			//$('#page-number').html($(data).find('#page-number').html());
			
			//结果个数左侧和底部显示
			$('#sidebar-total-comps-found').html($('#competition_num').val());
			$('#sidebar-active-comps-found').html($('#active_num').val());
			$('#show_comps_found').html($('#competition_num').val());
			$('#total-comps-found').html($('#competition_num').val());
			$('#active-comps-found').html($('#active_num').val());

			//hide spinner
			$('#competitions-sidebar h2 .spinner').css('display', 'none');
		});
	});

	$('#competitions-sidebar input[type=text]').bind('input keyup', function () {
		// Wait 300 milli after last input to submit
		var delay = 300;
		var $this = $(this);

		clearTimeout($this.data('timer'));
		$this.data('timer', setTimeout(function () {
			$this.removeData('timer');
			$('#competitions-sidebar').submit();
		}, delay));
	});

	$('#competitions-sidebar input[type=radio], #competitions-sidebar input[type=checkbox]').click(function () {
		$('#competitions-sidebar').submit();
	});
});

//排序
function sort_all(index){
	var sort_not=$('#link_root').val()+'/images/sort-not-sorted.png';
	var sort_asc=$('#link_root').val()+'/images/sort-ascending.png';
	var sort_desc=$('#link_root').val()+'/images/sort-descending.png';
	
	$('.sort_img').attr('src',sort_not);
	$('#active-sort').attr('name',index);
	
	switch($('#active-sort').val()){
		case 'asc':
		$('#sort_img_'+index).attr('src',sort_desc);
		$('#active-sort').val('desc');
		break;
		
		case 'desc':
		$('#sort_img_'+index).attr('src',sort_asc);
		$('#active-sort').val('asc');
		break;
		
		default:
		break;
	}
	$('#competitions-sidebar').submit();
}

function open_competition(id_competition){
	$('#open_competition').attr('action',$('#competition_index').val()+'/index.php?view=competition&id_competition='+id_competition);
	$('#open_competition').submit();
}
</script>

<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
