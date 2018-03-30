<?php
include 'header.php';
require './data/config.php';
$flag=$_POST['flag'];
$id=$_SESSION['id'];
$chall=AllChall();
  foreach ($chall as $c) {
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
        if(strlen($c[2])>1){
        ?>
        <a href="<?=$c[2]?>" target="_blank"><button type="button" class="btn btn-primary">Link</button></a>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>
  <?php
  }
if(isset($flag)){
    if(flagCheck($flag,$id)){
        ?>
        <li id="alert" class="alert list-group-item list-group-item-danger">
            There are overlapping flags!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
        </li>
        <?php
    }else{

        if(flag($flag,$id)){
            ?>
            <li id="alert" class="alert list-group-item list-group-item-success">FLAG IS CORRECT!!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
            </li>
            <?php
        }else{
            ?>
            <li id="alert" class="alert list-group-item list-group-item-danger">FLAG IS INCORRECT!!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
            </li>
            <?php
        }
    }
}
?>
<link href="../assets/css/chall.css" rel="stylesheet">
<div class="site-wrapper">
          
    
            <div class="cover-container">
            <div class="masthead clearfix">
              <div class="inner">
                <form method="POST">
                <input type="text" class="form-control" name="flag" placeholder="FLAG">
                </form>
              </div>
              <ul class="list-group">
              <h3>WEB_HACKING</h3>
              <?php
              $chall=webList();
              foreach($chall as $c){
              ?>
                <a data-toggle="modal" data-target="#myModal<?=$c[2]?>"><li id=<?=$c[2]?> class="list-group-item">
                <span class="badge"><?=$c[1]?></span>
                <?=$c[0]?>
                </li></a>
                <?php
              }
                ?>
                </ul>
                <ul class="list-group">
              <h3>PWNABLE</h3>
              <?php
              $chall=pwnList();
              foreach($chall as $c){
              ?>
                <a data-toggle="modal" data-target="#myModal<?=$c[2]?>"><li id=<?=$c[2]?> class="list-group-item">
                <span class="badge"><?=$c[1]?></span>
                <?=$c[0]?>
                </li></a>
                <?php
              }
                ?>
                </ul>
                <ul class="list-group">
              <h3>REVERSING</h3>
              <?php
              $chall=revList();
              foreach($chall as $c){
              ?>
                <a data-toggle="modal" data-target="#myModal<?=$c[2]?>"><li id=<?=$c[2]?> class="list-group-item">
                <span class="badge"><?=$c[1]?></span>
                <?=$c[0]?>
                </li></a>
                <?php
              }
                ?>
                </ul>
                <ul class="list-group">
              <h3>CRYPTO</h3>
              <?php
              $chall=cryptoList();
              foreach($chall as $c){
              ?>
                <a data-toggle="modal" data-target="#myModal<?=$c[2]?>"><li id=<?=$c[2]?> class="list-group-item">
                <span class="badge"><?=$c[1]?></span>
                <?=$c[0]?>
                </li></a>
                <?php
              }
                ?>
                </ul>
                <ul class="list-group">
              <h3>MISC</h3>
              <?php
              $chall=miscList();
              foreach($chall as $c){
              ?>
                <a data-toggle="modal" data-target="#myModal<?=$c[2]?>"><li id=<?=$c[2]?> class="list-group-item">
                <span class="badge"><?=$c[1]?></span>
                <?=$c[0]?>
                </li></a>
                <?php
              }
                ?>
                </ul>
              </div>
            </div>
    
</div>

<?php
$solve=solveList($id);

foreach ($solve as $s) {
    ?>
    <script>
        document.getElementById("<?=$s?>").className = "list-group-item list-group-item-success";
    </script>
    <?php
}
include 'footer.php';
?>
