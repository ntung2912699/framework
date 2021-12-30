<?php
namespace app\Middleware;
use app\middleware\InterfaceMiddleware;
require '../app/Middleware/InterfaceMiddleware.php';

class LogMiddleware implements InterfaceMiddleware {
    public $next = true;

    public function checklogin()
    {
        if (!isset($_SESSION['name'])){
            $this->next = false;
            return;
        }
        $this->next = true;
    }

    public function checkAdmin()
    {
        if (isset($_SESSION['name'])){
            if ($_SESSION['roles'] === 1){
                $this->next = false;
                return;
            }
        }else{
            echo "no user login";
        }
        $this->next = true;
    }
}