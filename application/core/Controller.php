<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 30.10.2022
 * Time: 00:46
 */

namespace application\core;

use application\core\View;

abstract class Controller
{
    public $route;
    public $view;
    public $acl;

    public function __construct($route)
    {
        $this->route = $route;
//        $this->checkAcl();
        $this->view = new View($route);
        $this->model = $this->loadModel($route["controller"]);
    }
    public function loadModel($name)
    {
        $path = "application/model/" . ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }

    public function checkAcl()
    {
        $this->acl = require 'application/acl/' . $this->route["controller"] . ".php";
        if ($this->isAcl("all")) {

        }
    }

}