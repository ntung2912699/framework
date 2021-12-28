<?php
namespace app\Middleware;

class LogMiddleware implements InterfaceMiddleware {
    public $next = true;

    public function checkAdmin()
    {
        // TODO: Implement checkAdmin() method.
    }

    public function action($router, $method, $params){
        if ($params['id'] == 3){
            $this->next = false;
            return;
        }
        $this->next = true;
    }
}