<?php
session_start();
$link = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$argv=explode('/',strtolower($link));
$argc=count($argv);
switch($argv[1]){
    case '':
        if(isset($_SESSION['id'])){
            include 'components/home.php';
            die;
        }
        else{
            include 'components/start.php';
            die;
        }
    case 'login':
        include 'components/login.php';
        die;
    case 'signup':
        include 'components/signup.php';
        die;
    case 'logout':
        include 'components/logout.php';
        die;
    case 'chall':
        include 'components/chall.php';
        die;
    case 'rank':
        include 'components/rank.php';
        die;
    case 'status':
        include 'components/status.php';
        die;
    case 'admin':
        include 'components/admin.php';
        die;
    case 'profile':
        include 'components/profile.php';
        die;
    default:
        include 'components/404.php';
        die;
}
?>
