<?php
namespace libs;

use app\Middleware\LogMiddleware;

/**
 * Router
 *
 * PHP version 5.4
 */
class BaseRouter
{
    /**
     * @param $method
     * @param $pattern
     * @param array $dest
     * /users/detail/23
     */
    private $routeTable = [];
    private $currentRoute = null;

    public function register($method, $pattern, $dest = [])
    {
        if (!is_array($dest)) {
            $dest = [$dest];
        }
        $method = strtolower($method);
        $this->routeTable[$method][$pattern] = [
            'controller' => $dest[0],
            'action' => $dest[1]
        ];
    }

    private function matching()
    {
        $url = parse_url($_SERVER['REQUEST_URI']);
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $path = $url['path'];

        $patternScore = [];
//        print_r($this->routeTable[$method]);
        foreach ($this->routeTable[$method] as $pattern => $controller) {
            if ($pattern === $path) {
                $this->currentRoute = $this->routeTable[$method][$pattern];
                break;
            }
            $patternScore[] = $this->patternScore($path, $pattern);
        }
        usort($patternScore, function ($a, $b) {
            if ($a['score'] == $b['score']) {
                return count($a['params']) < count($b['params']);
            }
            return $a['score'] < $b['score'];
        });

        $this->currentRoute = $this->routeTable[$method][$patternScore[0]['pattern']];
        $this->currentRoute['params'] = $patternScore[0]['params'];
//        if (count($this->currentRoute['Middleware'])){
//            foreach ($this->currentRoute['Middleware'] as $middleware){
//                $objectM = new $middleware;
//                $objectM->action($this->currentRoute);
//            }
//        }
    }

    private function patternScore($path, $patternStr)
    {
        $path = explode('/', $path);
        $pattern = explode('/', $patternStr);

        if (count($path) != count($pattern)) {
            return ['score' => 0, 'params' => [], 'pattern' => $patternStr];
        }

        $score = 0;
        $param = [];
        foreach ($pattern as $i => $section) {
            if ($path[$i] == $section) {
                $score += 1;
            } else {
                $p = $this->convertParam($section);
                if ($p) {
                    $param[$p] = $path[$i];
                }
            }
        }
        return ['score' => $score, 'params' => $param, 'pattern' => $pattern];
    }

    public function convertParam($section)
    {
        $start = substr($section, 0, 1);
        $end = substr($section, -1, 1);

        if ($start == '(' && $end == ')') {
            return str_replace(['(', ')'], '', $section);
        }
        return '';
    }

    public function getRouter()
    {
        $this->matching();
        return $this->currentRoute;
    }

}
