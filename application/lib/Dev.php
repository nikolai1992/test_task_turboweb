<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.10.2022
 * Time: 00:39
 */
ini_set("display_errors", 1);
error_reporting(E_ALL);

function debug($str)
{
    echo "<pre>";
    var_dump($str);
    echo "</pre>";
    exit;
}

function getTranslWord($words, $sel_lang, $code)
{
    return $words->where('name', $code)->first() ? $words->where('name', $code)->first()->translations->where("language_id", $sel_lang->id)->first()->value : '';
}