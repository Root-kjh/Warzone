<?php
include 'header.php';
$id=$_POST['id'];
if(isset($id)){
    include 'searchProfile.php';
}else{
  include 'defaultProfile.php';
}
include 'footer.php';
?>