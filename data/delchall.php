<?php
require 'config.php';

$idx=$_POST['idx'];

    delChall($idx);
    echo "<script>alert('삭제 완료');
            location.href='/admin';
            </script>";
?>