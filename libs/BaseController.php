<?php
namespace libs;

class BaseController{

    public static function view($view,$args = []){
        extract($args,EXTR_SKIP);
        $template = "../resource/View/$view";
        if (is_readable($template)){
            require $template;
        }else{
            echo "$template not found";
        }
    }
}