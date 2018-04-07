<?php
require 'config.php';
$id=RemoveXSS($_POST['id']);
$pw=hash('sha512',$_POST['pw']);
if(isset($id,$pw)){
    Login($id,$pw);
}
header("Location: /");
?>
