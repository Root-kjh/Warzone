<?php
if($_SESSION['id']!="root"){
    include(__DIR__.'/404.php');
    die;
}
include 'header.php';
?>

<div class="site-wrapper">
          
          <div class="site-wrapper-inner">
    
            <div class="cover-container">

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../data/upchall.php" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="color: #333;">UploadChall</h4>
      </div>
      <div class="modal-body">
      <input type="text" class="form-control" name="title" placeholder="title" required>
        <input type="text" class="form-control" name="content" placeholder="content" required>
        <input type="text" class="form-control" name="link" placeholder="link">
        <input type="text" class="form-control" name="point" placeholder="point" required>
        <input type="text" class="form-control" name="flag" placeholder="flag" required>
        <select class="form-control" name="track" style="margin-top: 2%;" required>
        <option value="web">WEB</option>
        <option value="reversing">reversing</option>
        <option value="pwnable">pwnable</option>
        <option value="crypto">crypto</option>
        <option value="misc">misc</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
</form>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../data/editchall.php" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="color: #333;">EditChall</h4>
      </div>
      <div class="modal-body">
      <input type="text" class="form-control" name="title" placeholder="title" required>
        <input type="text" class="form-control" name="content" placeholder="content" required>
        <input type="text" class="form-control" name="link" placeholder="link">
        <input type="text" class="form-control" name="point" placeholder="point" required>
        <input type="text" class="form-control" name="flag" placeholder="flag" required>
        <select class="form-control" name="track" style="margin-top: 2%;" required>
        <option value="web">WEB</option>
        <option value="reversing">reversing</option>
        <option value="pwnable">pwnable</option>
        <option value="crypto">crypte</option>
        <option value="misc">misc</option>
        </select>
        <input type="text" class="form-control" name="idx" placeholder="idx" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Edit</button>
      </div>
</form>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../data/delchall.php" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="color: #333;">DeleteChall</h4>
      </div>
      <div class="modal-body">
      <input type="text" class="form-control" name="idx" placeholder="idx" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Delete</button>
      </div>
</form>
    </div>
  </div>
</div>

              <div class="inner cover">
                <p class="lead">
                  <a data-toggle="modal" data-target="#myModal1" class="btn btn-lg btn-default">Upload Chall</a>
                  <a data-toggle="modal" data-target="#myModal2" class="btn btn-lg btn-default">Edit Chall</a>
                  <a data-toggle="modal" data-target="#myModal3" class="btn btn-lg btn-default">Del Chall</a>
                </p>
              </div>
            </div>
    
          </div>
    
        </div>
<?php

include 'footer.php';
?>