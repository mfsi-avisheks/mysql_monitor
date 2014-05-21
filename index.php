<html>
    <head>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="js/jquery.js"></script>
    <script src="js/events.js"></script>
    </head>
    <body>
        <center>
            <h2><u>MySQL Process Monitoring Tool</u></h2>
        </center>
        <div>
            <input type='button' value='Refresh List' class='refresh' id='refresh'>
            <div class="cpu">MySQL CPU Usage:<span></span></div>            
        </div>
        <?php
        require_once('config.php');
        
        $performce_col=array(0=>'ID',1=>'USER',2=>'HOST',3=>'DB',4=>'COMMAND',5=>'TIME',6=>'STATE',7=>'INFO');
        $ordering=array(0=>"ASC",1=>"DESC");
        
        $q="SELECT ID,USER,HOST,DB,COMMAND,TIME,STATE,INFO FROM INFORMATION_SCHEMA.PROCESSLIST";
        //exec('mysqladmin -uroot -pmindfire processlist -v',$output, $result);
        
        if(isset($_GET['id'])){
            $q=$q." ORDER BY ".$performce_col[$_GET['id']];
            if(isset($_GET['order']))$q=$q." ".$ordering[$_GET['order']];
        }
        exec('mysql -u'.USER.' -p'.PASSWORD.' -h'.HOST.' -B -e "'.$q.'"',$output, $result);
        
        if(!$result){
            $columns=array();
            
            if(count($output)){
                
                $output[0]=trim($output[0],"\t");
                $columns=explode("\t",$output[0]); #picking out the header columns
                unset($output[0]); #unsetting header column line
                echo "<table cellspacing='0'><thead><tr>";

                foreach($columns as $key=>$row){
                    echo "<th><a href='#' class='ordering' id=$key ordering='0' title='click to order it by column,click again to change the order'>$row</a></th>";
                }
                
                echo "<th>Action</th>";
                echo "<tr></thead>";
                echo "<tbody>";
                
                foreach($output as $row){
                    $row=trim($row,"\t");
                    $columns=explode("\t",$row);
                    echo "<tr>";
                    foreach($columns as $k=>$v){
                        echo "<td>$v</td>";
                    }
                    echo "<td><input type='button' name=b_".trim($columns[0])." value='Kill' class='kill' id=".trim($columns[0])."></td>";
                    echo "</tr>";
                }
                
                echo "</tbody></table>";                
            }
        }else
            echo "sql error";       
        ?>
    </body>
</html>