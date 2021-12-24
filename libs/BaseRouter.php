<?php
namespace libs;

class BaseRouter
{
    /**
     * @param $pattern
     * @param string $dest
     * Note:
     *
     */
    private static $routeTable = [];
    public $currentRoute = 'null';

    public static function get($path, $action, $classMiddle = [])
    {
        $method = RouterMethod::GET;
        $pattern = $path;
        $dest = explode("@", $action);
        $middleware = $classMiddle;
        self::setRouteTable($method, $pattern, $dest, $middleware);
    }

    public static function post($path, $action,  $classMiddle = [])
    {
        $method = RouterMethod::POST;
        $pattern = $path;
        $dest = explode("@", $action);
        $middleware = $classMiddle;
        self::setRouteTable($method, $pattern, $dest, $middleware);
    }

    public static function setRouteTable($method, $pattern, $dest = [], $middleware = [])
    {
        self::$routeTable[$method][$pattern] = [
            'controller' => $dest[0],
            'action' => $dest[1] ?? 'index',
            'middleware' => $middleware,
        ];
    }
    private function matching()
    {
        $url = parse_url($_SERVER['REQUEST_URI']);
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $url['path'];
        $routeTables = self::$routeTable[$method];
        $patternScore = [];

        foreach ($routeTables as $pattern => $value) {
            $patternScore[] = $this->patternScore($path, $pattern);
        }

        usort($patternScore, function($a, $b) {
            if ($a['score'] === $b['score']) {
                if ($a['param'] == "" && $b['param'] == "") {
                    $a['param'] = $b['param'] = "";
                } else {
                    return count($a['param']) < count($b['param']);
                }
            }
            return $a['score'] < $b['score'];
        });

        if ($patternScore[0]['score'] == 0) {
            http_response_code(404);
            exit();
        }

        $this->currentRoute = self::$routeTable[$method][$patternScore[0]['pattern']];
        $this->currentRoute['param'] = $patternScore[0]['param'];
        if (count($this->currentRoute['middleware'])) {
            foreach ($this->currentRoute['middleware'] as $middleware) {
                $objMiddle = new $middleware;
                $objMiddle->action($this->currentRoute, $method, $this->currentRoute['param']);
                if ($objMiddle->next == false) {
                    $message = "Request không hợp lệ";
                    throw new MiddlewareException($message);
                }
            }
        }
    }

    private function patternScore($path, $pattern)
    {
        $path = explode('/', $path);

        $exPattern = explode('/', $pattern);

        if (count($path) != count($exPattern)) {
            return ['score' => 0, 'param' => '', 'pattern' => $pattern];
        }
        $score = 0;
        $param = [];

        foreach ($exPattern as $key => $value) {
            if ($path[$key] == $value) {
                $score += 1;
            } else {
                $convertP = $this->convertParam($value);
                if ($convertP) {
                    $param[$convertP] = $path[$key];
                }
            }
        }
        return ['score' => $score, 'param' => $param, 'pattern' => $pattern];
    }

    private function convertParam($value)
    {
        $start = substr($value, 0, 1);
        $end = substr($value, -1, 1);

        if ($start == "{" && $end == "}") {
            return str_replace(['{', '}'], '', $value);
        }
        return '';
    }

    public function getRoute()
    {
        $this->matching();
        return $this->currentRoute;
    }

    public function matchController()
    {
        $current = $this->getRoute();
        $convertController = "app\\Controller\\".$current['controller']."";
        $controller = new $convertController;
        $action = $current['action'];
        call_user_func_array([$controller, $action], $current['param']);
    }
}
