<?php
    $pid=`pgrep "mysqld"`;
    exec("top -d 0.5 -n 1 -b -p ".$pid,$cpu,$cpu_ok);
    //echo "<pre>";print_r($cpu);
    $c=preg_replace('/\s+/', ' ',$cpu[7]);
    $c=explode(" ",trim($c));
    echo $c[8]."-".$c[9]; //%CPU - %MEM
