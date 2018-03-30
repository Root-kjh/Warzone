<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'config.php';

$title=$_POST['title'];
$content=$_POST['content'];
$link=$_POST['link'];
$flag=$_POST['flag'];
$point=$_POST['point'];
$track=$_POST['track'];

if(matchTitle($title)){
    UpChall($title,$content,$link,$point,$flag,$track);
    echo "<script>alert('업로드 완료');
            location.href='/admin';
            </script>";
}else{
    echo "<script>alert('제목이 곂칩니다.');
    location.href='/admin';
    </script>";
    die();
}
?>