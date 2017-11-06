<?php
    error_reporting(0);
    set_error_handler("feil", E_ALL);
    register_shutdown_function("avslutt");
    
    
    function avslutt() {
        $error = error_get_last();
        if($error["type"] == E_ERROR) {
            feil($error["type"], $error["message"], $error["file"], $error["line"]);
            //echo $error["type"].$error["message"].$error["file"].$error["line"];
            header("location: feilside.php");
            die();
            
        }
    }
    
    function feil($error_no, $error_string, $error_file, $error_line) {
        $dato = date('d.m.Y H:i');
        $feilmelding = "$dato $error_no $error_string $error_file $error_line \r\n";
        //echo $feilmelding;
        error_log($feilmelding, 3, "/xampp/htdocs/ObligPHP/logg.txt");
    }

