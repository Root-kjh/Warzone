<?php
include 'header.php';
include './data/config.php';
$userinfo=search($_SESSION['id']);
$solve=solveList($_SESSION['id']);
$chall=AllChall();
foreach ($chall as $c) {
  foreach($solve as $s){
    if($s==$c)
      $check=true;
    else
      $check=false;
  }
  if($check)
    continue;
  ?>
  <div class="modal fade" id="myModal<?=$c[4]?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?=$c[0]?>(<?=$c[3]?>)</h4>
      </div>
      <div class="modal-body">
        <p><?=$c[1]?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?php
        if(isset($c[2])){
        ?>
        <a href="<?=$c[2]?>"><button type="button" class="btn btn-primary">Link</button></a>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>
<?php
}
?>
<link href="../assets/css/status.css" rel="stylesheet">
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../data/changePW.php" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="color: #333;">ChangePW</h4>
      </div>
      <div class="modal-body">
      <input type="password" class="form-control" name="pw" placeholder="Password" required>
        <input type="password" class="form-control" name="pwr" placeholder="Confirm Password" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Change</button>
      </div>
</form>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../data/changeComment.php" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="color: #333;">ChangeComment</h4>
      </div>
      <div class="modal-body">
      <input type="text" class="form-control" name="comment" placeholder="Comment" required>
        <input type="password" class="form-control" name="pw" placeholder="Password" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Change</button>
      </div>
</form>
    </div>
  </div>
</div>
<div class="site-wrapper">
	<div class="cover-container">
		<div class="masthead clearfix">
			<div class="inner">
				<h1><?=$_SESSION['id']?><small>(<?=$userinfo[2]?>)</small></h1>
				<p><?=$userinfo[1]?></p>
				<a data-toggle="modal" data-target="#myModal1"><button type="button" class="btn btn-default">Change PW</button></a>
				<a data-toggle="modal" data-target="#myModal2"><button type="button" class="btn btn-default">Change Comment</button></a>
			</div>
		</div>
	<ul class="list-group">
			  <?php
			  $count=0;
              foreach($solve as $s){
				  if($count!=0){
				  $chall=printChall($s);
              ?>
              <a data-toggle="modal" data-target="#myModal<?=$chall[2]?>">
              <li class="list-group-item  list-group-item-success">
                <span class="badge"><?=$chall[1]?></span>
                <?=$chall[0]?>
                </li></a>
				<?php
				  }
				  $count++;
              }
                ?>
				</ul>
			</div>
</div>
<?php
include 'footer.php';
?>