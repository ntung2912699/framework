<?php
namespace app\Middleware;
use app\middleware\InterfaceMiddleware;
require '../app/Middleware/InterfaceMiddleware.php';

class LogMiddleware implements InterfaceMiddleware {
    public $next = true;

    public function checkLogin()
    {
        if (!isset($_SESSION['name'])){
            $this->next = false;
            return;
        }
        $this->next = true;
    }

    public function checkAdmin()
    {
        // TODO: Implement checkAdmin() method.
    }
}