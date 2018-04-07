<?php
require 'config.php';
$id=trim(RemoveXSS($_POST['id']));
$pw=hash('sha512',$_POST['pw']);
$pwr=hash('sha512',$_POST['pwr']);
$comment=RemoveXSS($_POST['comment']);
if(strlen($id)>20 || strlen($comment)>30){
    echo "<script>alert('입력값의 길이가 너무 깁니다!');
    history.back();
    </script>";
die();
}
if(!isset($comment))
    $comment=null;
    
if(!matchId($id)){
    echo "<script>alert('동일한 아이디가 존재합니다!');
        history.back();
        </script>";
    die();
}

if(isset($id,$pw) && pwChk($pw,$pwr)){
    SignUP($id,$pw,$comment);
    echo "<script> alert('$id 님! 회원가입이 성공적으로 처리되었습니다.');
            history.back();
            </script>";
    die();
}
else{
    echo "<script> alert('입력이 잘못되었습니다.');
        history.back();
        </script>";
        die();
}

?>