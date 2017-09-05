<?php
require_once(FILE_ROOT.'/classes/class_competition.php');
$Competition=new Competition($_GET);
$competition=$Competition->Detail();

$title='奖励';
?>
<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div id="wrap">
  <div id="main">
    <div id="competition">
    
      <?php require(FILE_ROOT.'/views/view_competition_header.php'); ?>
      <?php require(FILE_ROOT.'/views/view_competition_left.php'); ?>
      
      <!--中间-->
      <div class="description comp-content with-sidebar _panel">
		<?php require(FILE_ROOT.'/views/view_competition_title.php'); ?>
        
        <div class="comp-content-inside">
          <div id="competition-intro"> </div>
          <div id="comp-homepage-content" class="cms-page _buttons">
          
          <p>第一名：￥<?php echo $competition['prize_1']; ?></p>
          <?php
		  if($competition['prize_2']){
		  ?>
              <p>第二名：￥<?php echo $competition['prize_2']; ?></p>
          <?php
		  }
		  ?>
          
          <?php
		  if($competition['prize_3']){
		  ?>
          <p>第三名：￥<?php echo $competition['prize_3']; ?></p>
          <?php
		  }
		  ?>
          
          <p><?php echo $competition['prize']; ?></p>
          
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
