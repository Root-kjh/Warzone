<?php
require 'config.php';

$idx=$_POST['idx'];
$title=$_POST['title'];
$content=$_POST['content'];
$link=$_POST['link'];
$flag=$_POST['flag'];
$point=$_POST['point'];
$track=$_POST['track'];

if(matchTitle($title)){
    editChall($title,$content,$link,$point,$flag,$track,$idx);
    echo "<script>alert('수정 완료');
            location.href='/admin';
            </script>";
}else{
    echo "<script>alert('제목이 곂칩니다.');
    location.href='/admin';
    </script>";
    die();
}
?>