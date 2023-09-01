<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 30.10.2022
 * Time: 00:32
 */
namespace application\controllers;

use application\core\Controller;
use application\models\Dog;

class MainController extends Controller
{
    public function indexAction()
    {
        $this->view->render('Главная страница');
    }

    public function run_commandAction()
    {
        if (isset($_GET["command"])) {
            $entered_command = $_GET["command"];
            $words = $entered_command ? explode(" ", $entered_command) : [];
            $dogs_action = "";
            if (in_array("sound", $words)) {
                $dogs_action = "sound";
            }
            if (in_array("hunt", $words) || in_array("hunting", $words)) {
                $dogs_action = "hunting";
            }

            $dogs = (new Dog)->all();
            extract(compact('dogs', 'dogs_action'));
            $path = "application/views/_partials/_dogs_actions.php";
            return require $path;
        }

    }
}