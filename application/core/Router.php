<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.10.2022
 * Time: 00:55
 */
namespace application\core;

class Router
{
    protected $routes = [];
    protected $params = [];

    function __construct()
    {
        $arr = require "application/config/routes.php";
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    public function add($route, $params)
    {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');

        foreach ($this->routes as $route => $params) {
            // Parse the URL
            $urlComponents = parse_url($url);

            if (preg_match($route, $urlComponents['path'], $matches)) {

                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    public function run()
    {
        if ($this->match()) {
            $path = 'application\controllers\\' . ucfirst($this->params["controller"])."Controller";
            if (class_exists($path)) {
                $action = $this->params['action'].'Action';
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}