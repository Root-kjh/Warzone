<?php
require 'config.php';
$id=$_SESSION['id'];
$pw=hash('sha512',$_POST['pw']);
$pwr=hash('sha512',$_POST['pwr']);
if($pw===$pwr && isset($pw) && isset($pwr) && CheckPW($id,$pw)){
    changePW($pw,$id);
    echo "<script>alert('변경완료');location.href='/status';</script>";
    die;
}else{
    echo "<script>alert('입력이 잘못되었습니다.');location.href='/status';</script>";
    die;
}
?>