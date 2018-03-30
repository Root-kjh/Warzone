<?php
require 'config.php';
$id=RemoveXSS($_POST['id']);
$pw=hash('sha512',$_POST['pw']);
if(isset($id) && isset($pw)){
    Login($id,$pw);
}

if(isset($_SESSION['id'])){
    echo "<script> 
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