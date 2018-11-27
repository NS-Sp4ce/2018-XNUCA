<?php
$param = array();
parse_str($_SERVER['QUERY_STRING']);
if (isset($action)){
    switch($action){
        case "php_info":
        echo call_user_func_array("php_info",$param);
        break;
        case "cmd":
        if(isset($cmd)){
            if(is_string($cmd)){
                if (strlen($cmd)>9){
                    die();
                }
                $pat1 = "/[^0-9a-zA-Z \/\*]/";
                if (preg_match($pat1, $cmd)>0){
                    die();
                }
                $pat2 = "/^[a-zA-Z]+ [0-9a-zA-Z\/\*]+$/";
                if (preg_match($pat2, $cmd)==0){
                    die();
                }
                system("busybox " . $cmd);
            }
        } 
        break;
        default:
        echo call_user_func_array("hello",$param);
        break;
    }
}else{
    show_source(__FILE__);
}