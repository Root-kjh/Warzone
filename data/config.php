<?php
session_start();
$dsn = "mysql:host=localhost;port=3306;dbname=warzone;charset=utf8";

try {
    $con = new PDO($dsn, "DBID", "DBPW");
    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
    echo $e->getMessage();
    }

    function matchId($id){
        global $con;
        $stmt=$con->prepare('select id from users');
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_NUM);
        foreach($row as $r){
            if(strtolower($r[0])==strtolower($id))
            return false;
        }
        return true;
    }

    function RemoveXSS($val) {
        // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
        // this prevents some character re-spacing such as <java\0script>
        // note that you have to handle splits with \n, \r, and \t later since they *are*
        // allowed in some inputs
        $val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val);

        // straight replacements, the user should never need these since they're normal characters
        // this prevents like <IMG SRC=&#X40&#X61&#X76&#X61&#X73&#X63&#X72&#X69&#X70&#X74&
        // #X3A&#X61&#X6C&#X65&#X72&#X74&#X28&#X27&#X58&#X53&#X53&#X27&#X29>
        $search = 'abcdefghijklmnopqrstuvwxyz';
        $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $search .= '1234567890!@#$%^&*()'; 
        $search .= '~`";:?+/={}[]-_|\'\\'; 
        for ($i = 0; $i < strlen($search); $i++) { 
            // ;? matches the ;, which is optional
            // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars

            // &#x0040 @ search for the hex values
            $val = preg_replace('/(&#[x|X]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val);
            // with a ;

            // &#00064 @ 0{0,7} matches '0' zero to seven times
            $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
        }

        // now the only remaining whitespace attacks are \t, \n, and \r
        $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style',
        'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
        $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload'); 
        $ra = array_merge($ra1, $ra2);
            
        $found = true; // keep replacing as long as the previous round replaced something 
        while ($found == true) {
            $val_before = $val;
            for ($i = 0; $i < sizeof($ra); $i++) {
                $pattern = '/';
                for ($j = 0; $j < strlen($ra[$i]); $j++) {
                        if ($j > 0) {
                        $pattern .= '(';
                        $pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?';
                        $pattern .= '|(&#0{0,8}([9][10][13]);?)?';
                        $pattern .= ')?';
                    }
                    $pattern .= $ra[$i][$j];
                } 
                $pattern .= '/i'; 
                $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
                $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
                if ($val_before == $val) {
                    // no replacements were made, so exit the loop
                    $found = false;
                }
            }
        }
        return $val;
    }

    function pwChk($pw,$pwr){
        if($pw==$pwr)
            return true;
        else
            return false;
    }

    function SignUP($id,$pw,$comment){
        global $con;
        $statement = $con->prepare('insert into users (id, pw, comment) values(:id, :pw, :comment)');
        $statement->bindParam(':id',$id, PDO::PARAM_STR);
        $statement->bindParam(':pw',$pw, PDO::PARAM_STR);
        $statement->bindParam(':comment',$comment, PDO::PARAM_STR);
        $statement->execute();
    }

    function Login($id,$pw){
        global $con;
        $stmt=$con->prepare('select id from users where id=:id and pw=:pw');
        $stmt->bindParam(':id',$id, PDO::PARAM_STR);
        $stmt->bindParam(':pw',$pw, PDO::PARAM_STR);
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_NUM);
        foreach($row as $r){
            $_SESSION['id']=$r[0];
        }
    }

    function matchTitle($title){
        global $con;
        $stmt=$con->prepare('select title from chall');
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_NUM);
        foreach($row as $r){
            if($r[0]==$title)
            return false;
        }
        return true;
    }

    function UpChall($title,$content,$link,$point,$flag,$track){
        global $con;
        if(isset($link)){
        $statement = $con->prepare('insert into chall (title, content, link, point, flag, track)
                                    values(:title, :content, :link, :point, :flag, :track)');
        $statement->bindParam(':title',$title, PDO::PARAM_STR);
        $statement->bindParam(':content',$content, PDO::PARAM_STR);
        $statement->bindParam(':link',$link, PDO::PARAM_STR);
        $statement->bindParam(':point',$point, PDO::PARAM_INT);
        $statement->bindParam(':flag',$flag, PDO::PARAM_STR);
        $statement->bindParam(':track',$track, PDO::PARAM_STR);
        }else{
            $statement = $con->prepare('insert into chall (title, content, point, flag, track)
            values(:title, :content, :point, :flag, :track)');
            $statement->bindParam(':title',$title, PDO::PARAM_STR);
            $statement->bindParam(':content',$content, PDO::PARAM_STR);
            $statement->bindParam(':point',$point, PDO::PARAM_INT);
            $statement->bindParam(':flag',$flag, PDO::PARAM_STR);
            $statement->bindParam(':track',$track, PDO::PARAM_STR);
        }
        $statement->execute();
    }
    
    function editChall($title,$content,$link,$point,$flag,$track,$idx){
        global $con;
        if(isset($link)){
        $statement = $con->prepare('update chall set title=:title, content=:content, link=:link, point=:point,
                                    flag=:flag, track=:track where idx=:idx');
        $statement->bindParam(':title',$title, PDO::PARAM_STR);
        $statement->bindParam(':content',$content, PDO::PARAM_STR);
        $statement->bindParam(':link',$link, PDO::PARAM_STR);
        $statement->bindParam(':point',$point, PDO::PARAM_INT);
        $statement->bindParam(':flag',$flag, PDO::PARAM_STR);
        $statement->bindParam(':track',$track, PDO::PARAM_STR);
        $statement->bindParam(':idx',$idx, PDO::PARAM_INT);
        }else{
            $statement = $con->prepare('update chall set title=:title, content=:content, point=:point,
            flag=:flag, track=:track where idx=:idx');
            $statement->bindParam(':title',$title, PDO::PARAM_STR);
            $statement->bindParam(':content',$content, PDO::PARAM_STR);
            $statement->bindParam(':point',$point, PDO::PARAM_INT);
            $statement->bindParam(':flag',$flag, PDO::PARAM_STR);
            $statement->bindParam(':track',$track, PDO::PARAM_STR);
            $statement->bindParam(':idx',$idx, PDO::PARAM_INT);
        }
        $statement->execute();
    }

    function delChall($idx){
        global $con;
        $statement = $con->prepare('delete from chall where idx=:idx');
        $statement->bindParam(':idx',$idx, PDO::PARAM_INT);
        $statement->execute();
    }

    function search($id){
        global $con;
        $stmt=$con->prepare('select id,comment,point from users where id=:id');
        $stmt->bindParam(':id',$id, PDO::PARAM_STR);
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_NUM);
        foreach($row as $r){
            $ret=[$r[0],$r[1],$r[2]];
        }
        return $ret;
    }
    
    function webList(){
        global $con;
        $stmt=$con->prepare("select title,point,idx from chall where track='web'");
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_NUM);
        $count=0;
        foreach($row as $r){
            $ret[$count]=[$r[0],$r[1],$r[2]];
            $count++;
        }
        return $ret;
    }

    function pwnList(){
        global $con;
        $stmt=$con->prepare("select title,point,idx from chall where track='pwnable'");
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_NUM);
        $count=0;
        foreach($row as $r){
            $ret[$count]=[$r[0],$r[1],$r[2]];
            $count++;
        }
        return $ret;
    }

    function revList(){
        global $con;
        $stmt=$con->prepare("select title,point,idx from chall where track='reversing'");
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_NUM);
        $count=0;
        foreach($row as $r){
            $ret[$count]=[$r[0],$r[1],$r[2]];
            $count++;
        }
        return $ret;
    }

    function cryptoList(){
        global $con;
        $stmt=$con->prepare("select title,point,idx from chall where track='crypto'");
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_NUM);
        $count=0;
        foreach($row as $r){
            $ret[$count]=[$r[0],$r[1],$r[2]];
            $count++;
        }
        return $ret;
    }

    function miscList(){
        global $con;
        $stmt=$con->prepare("select title,point,idx from chall where track='misc'");
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_NUM);
        $count=0;
        foreach($row as $r){
            $ret[$count]=[$r[0],$r[1],$r[2]];
            $count++;
        }
        return $ret;
    }

    function solveList($id){
            global $con;
            $stmt=$con->prepare('select solve from users where id=:id');
            $stmt->bindParam(':id',$id, PDO::PARAM_STR);
            $stmt->execute();
            $row=$stmt->fetchAll(PDO::FETCH_NUM);
            foreach ($row as $r) {
                $solve=$r[0];
            }
            $ret=explode(',',$solve);
            return $ret;
    }

    function flagSearch($flag){
        global $con;
        $stmt=$con->prepare('select idx,flag,point from chall where flag=:flag');
        $stmt->bindParam(':flag',$flag,PDO::PARAM_STR);
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_NUM);
        
        return $row;
    }

    function flag($flag,$id){
        $row=flagSearch($flag);
        foreach ($row as $r) {
            $fflag=$r[1];
            $idx=$r[0];
            $point=$r[2];
        }
        if($flag!=null){
            if($flag==$fflag){
                addSolve($idx,$id,$point);
                return true;
            }
        }
            return false;
    }

    function addSolve($idx,$id,$point){
        global $con;
        $idx=",".$idx;
        $stmt=$con->prepare('update users set solve=concat(solve,:idx),point=point+:point where id=:id');
        $stmt->bindParam(':idx',$idx,PDO::PARAM_STR);
        $stmt->bindParam(':point',$point,PDO::PARAM_INT);
        $stmt->bindParam(':id',$id,PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }

    function flagCheck($flag,$id){
        $row=flagSearch($flag);
        foreach ($row as $r) {
            $idx=$r[0];
        }
        $solve=solveList($id);
        foreach($solve as $s){
                if($idx!=null){
                    if($s==$idx)
                            return true;
            }
        }
        return false;
    }

    function printChall($idx){
        global $con;
        $stmt=$con->prepare('select title,point,idx from chall where idx=:idx');
        $stmt->bindParam(':idx',$idx,PDO::PARAM_INT);
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_NUM);
        
        foreach ($row as $r) {
            $ret=[$r[0],$r[1],$r[2]];
        }
        return $ret;
    }

    function changePW($pw,$id){
        global $con;
        $stmt=$con->prepare('update users set pw=:pw where id=:id');
        $stmt->bindParam(':pw',$pw,PDO::PARAM_STR);
        $stmt->bindParam(':id',$id,PDO::PARAM_STR);
        $stmt->execute();
    }

    function changeComment($pw,$comment,$id){
        global $con;
        $stmt=$con->prepare('update users set comment=:comment where id=:id and pw=:pw');
        $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
        $stmt->bindParam(':pw',$pw,PDO::PARAM_STR);
        $stmt->bindParam(':id',$id,PDO::PARAM_STR);
        $stmt->execute();
    }
    
    function AllChall(){
        global $con;
        $stmt=$con->prepare('select title,content,link,point,idx from chall');
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_NUM);
        $i=0;
        foreach ($row as $r) {
            $ret[$i]=[$r[0],$r[1],$r[2],$r[3],$r[4]];
            $i++;
        }
        return $ret;
    }

    function AllUsers(){
        global $con;
        $stmt=$con->prepare('select id,point,comment,time from users order by point desc, time limit 51');
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_NUM);
        $i=0;
        foreach ($row as $r) {
            $ret[$i]=[$r[0],$r[1],$r[2],$r[3]];
            $i++;
        }
        return $ret;
    }

    function CheckPW($id,$pw){
        global $con;
        $stmt=$con->prepare('select id,pw from users where id=:id and pw=:pw');
        $stmt->bindParam(':id',$id,PDO::PARAM_STR);
        $stmt->bindParam(':pw',$pw,PDO::PARAM_STR);
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_NUM);
        
        foreach ($row as $r) {
            $user=[$r[0],$r[1]];
        }
        if($id==$r[0] && $pw==$r[1])
            return true;
        else
            return false;
    }
    function Rank($id){
	global $con;
	$stmt=$con->prepare('select rank from users as T1, (select id,(@rank:=@rank+1) AS rank from users as a,(select @rank:=0) as b order by a.point desc) AS T2 where T1.id=T2.id and T1.id=:id;');
	$stmt->bindParam(':id',$id,PDO::PARAM_STR);
	$stmt->execute();
	$row=$stmt->fetchAll(PDO::FETCH_NUM);
	foreach($row as $r){
	    $rank[0]=$r[0];
	}
	$st=$con->prepare('select count(*) from users');
	$st->execute();
	$row=$st->fetchAll(PDO::FETCH_NUM);
	foreach($row as $r){
	    $rank[1]=$r[0];
	}
	return $rank;
    }
?>
