<?php
session_start();
if(isset($_SESSION['id']))
{
    include(__DIR__.'home.php');
    die;
}
?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Warzone">
    <meta name="author" content="kjh">
    <link rel="icon" href="../assets/img/favicon.ico">
    <title>Warzone</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/cover.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="site-wrapper">
          
      <div class="site-wrapper-inner">

        <div class="cover-container">
                  <!-- Modal -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="../data/login.php" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="color: #333;">Login</h4>
      </div>
      <div class="modal-body">
          <input type="text" class="form-control" name="id" placeholder="Name" required>
          <input type="password" class="form-control" name="pw" placeholder="Password" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#myModal2">SignUP</button>
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../data/signup.php" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="color: #333;">SignUP</h4>
      </div>
      <div class="modal-body">
      <input type="text" class="form-control" name="id" placeholder="Name" required>
        <input type="password" class="form-control" name="pw" placeholder="Password" required>
        <input type="password" class="form-control" name="pwr" placeholder="Confirm Password" required>
        <input type="text" class="form-control" name="comment" placeholder="Comment">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#myModal">Login</button>
        <button type="submit" class="btn btn-primary">SignUP</button>
      </div>
</form>
    </div>
  </div>
</div>

          <div class="inner cover">
            <h1 class="cover-heading">Warzone에 오신걸 환영합니다!</h1>
            <p class="lead">리버싱, 포너블, 웹해킹 등의 다양한 문제들이 업로드 될 예정입니다.</p>
            <p class="lead">
              <a data-toggle="modal" data-target="#myModal" class="btn btn-lg btn-default">즐기러 가기!</a>
            </p>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p><a href="http://rootjonghyun.tistory.com/">@root_kjh.</a> All Rights Reserved.</p>
            </div> 
          </div>

        </div>

      </div>

    </div>
    <div id="particles-js"></div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/start.js" type="text/javascript"></script>
  </body>
</html>
