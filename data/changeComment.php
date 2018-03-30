<?php
require 'config.php';
$id=$_SESSION['id'];
$pw=hash('sha512',$_POST['pw']);
$comment=$_POST['comment'];
if(strlen($comment)>30){
    echo "<script>alert('입력값의 길이가 너무 깁니다!');
    history.back();
    </script>";
die();
}
if(isset($pw) && isset($comment) && CheckPW($id,$pw)){
    changeComment($pw,$comment,$id);
    echo "<script>alert('변경완료');location.href='/status';</script>";
    die;
}else{
    echo "<script>alert('입력이 잘못되었습니다.');location.href='/status';</script>";
    die;
}
?>