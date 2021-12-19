<?php
namespace app\Middleware;

class LogMiddleware{
    public $next = true;

    public function action($router, $method, $params){
        print_r($params);
        if ($params['id'] == 3){
            $this->next = false;
            return;
        }
        $this->next = true;
    }
}