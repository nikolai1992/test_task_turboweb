<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 31.10.2022
 * Time: 13:45
 */
namespace application\models;

use application\core\Model;

class Dog extends Model
{
    public function all()
    {
        return $this->db->row('SELECT * FROM `dogs`');
    }
}