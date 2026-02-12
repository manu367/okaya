<?php
require_once("../includes/config.php");
class HandleRequest{
    public static function GET(){
        return $_SERVER['REQUEST_METHOD']==='GET';
    }
    public static function POST(){
        return $_SERVER['REQUEST_METHOD']==='POST';
    }
    public static function PUT(){
        return $_SERVER['REQUEST_METHOD']==='PUT';
    }
}


if(HandleRequest::GET()){
    echo "~sddc~";
}
elseif (HandleRequest::POST()){
    echo "~sddc1~";
}



















