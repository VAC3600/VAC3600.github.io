<?php // redirect.php
    
    // соединение с БД и прочая подготовуха
    // ...
    
    if (empty($_GET['id'])) {
        header('HTTP/1.1 404 Not found');
        die();
    } else {
        
        $id = mysql_real_escape_string($_GET['id']);
        $result = mysql_query("select url from infotable where id = '$id'");
        
        if (!mysql_num_rows($result)) {
            header('HTTP/1.1 404 Not found');
            die();
        }
        
        $url = mysql_result($result, 0);
        
        mysql_query("update infotable set perehody = perehody + 1 where id = '$id'");
        header('Location: http://'.$url);
    
    }