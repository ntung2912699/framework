<?php
namespace libs;

class BaseController{

    public static function view($view,$args = []){
        extract($args);
        $template = "../resource/View/$view";
        if (file_exists($template)){
            require $template;
        }else{
            echo "$template not found";
        }
    }
}