<?php 
include('..\models\News.php');
$new = $_GET['news'];
?>
<h3><?php echo $new->getTitle();?></h3>
<p><?php echo $new->getAn_nt();?></p>
<p><?php echo $new->getText();?></p>
<p><b>Теги:</b> <?php echo $new->getTags();?></p>
<h5><?php echo $new->getDate();?></h5>