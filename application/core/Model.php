<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 31.10.2022
 * Time: 14:43
 */

namespace application\core;

use application\lib\Db;

abstract class Model
{
    public $db;

    public function __construct()
    {
        $this->db = new Db;
    }

    public function where($key, $condition = "==", $value)
    {
        return $this->db->where($key, $condition, $value);
    }
}