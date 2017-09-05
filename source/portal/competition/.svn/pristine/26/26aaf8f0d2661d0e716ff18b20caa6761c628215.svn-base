<?php
require_once(FILE_ROOT.'/classes/class_competition.php');
$Competition=new Competition($_GET);
$competition=$Competition->Detail();

$title='评价';
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
          
           <?php echo $competition['evaluation']; ?>
            
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
