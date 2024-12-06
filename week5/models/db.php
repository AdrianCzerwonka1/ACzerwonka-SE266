<?php

    //Connection to get into the sql database using a dbconfig.ini file to pass in the information so that others can not access it

    $ini = parse_ini_file('dbconfig.ini');


    $db = new PDO("mysql:host=" . $ini['servername'] . 
            ";port=" . $ini['port'] . 
            ";dbname=" . $ini['dbname'], 
            $ini['username'], 
            $ini['password']);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


?>