<?php
include './data/config.php';
$id=$_POST['id'];
$userinfo=search($id);
$solve=solveList($id);
if($userinfo[0]==null){
	header("location:/profile");
}
$chall=AllChall();
$rank=Rank($id);
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
<div class="site-wrapper">
	<div class="cover-container">
		<div class="masthead clearfix">
			<div class="inner">
			<p class="lead">
                <form method="POST">
                <input type="text" class="form-control" name="id" placeholder="Name">
				</form>
                </p>
				<h1><?=$id?><small>(<?=$userinfo[2]?>)</small></h1>
				<?=$userinfo[1]?>
			</div>
		</div>
	<h4><?="RANK : ".$rank[0]."/".$rank[1]?></h4>
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
