<?php
include 'header.php';
require './data/config.php';
$users=AllUsers();
?>
<link href="../assets/css/rank.css" rel="stylesheet">
<div class="site-wrapper">
<div class="site-wrapper">
          
          <div class="site-wrapper-inner">
    
            <div class="cover-container">

              <div class="inner cover">
                <table class="table">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Score</th>
                    <th>Comment</th>
                    <th>Last_auth</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=1;
                        foreach($users as $u){
                            if($u[0]=="root")
                                continue;
                    ?>
                    <tr class="rank_tr" value="<?=$u[0]?>">
                    <th scope="row"><?=$i?></th>
                    <td><?=$u[0]?></td>
                    <td><?=$u[1]?></td>
                    <td><?=$u[2]?></td>
                    <td><?=$u[3]?></td>
                    </tr>
                    <?php
                        $i++;
                        }
                    ?>
                </tbody>
            </table>
                <p></p>
              </div>
            </div>
    
          </div>
    
        </div>
</div>
<?php
include 'footer.php';
?>
<script src="../assets/js/rank.js" type="text/javascript"></script>
