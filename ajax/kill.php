<?php
    require_once('../config.php');
    if(isset($_POST['id'])){
        $pid=$_POST['id'];
        exec('mysqladmin -u'.USER.' -p'.PASSWORD.' -h'.HOST.' kill '.$pid,$dummy, $ok);
        if(!$ok)echo "ok";
        else "error";
    }
