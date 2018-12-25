<?php

class ModelBase
{

    public static function GetValue($name, $default)
    {
        $default = isset($_GET[$name]) ? $_GET[$name] : $default;
        $default = isset($_POST[$name]) ? $_POST[$name] : $default;
        return $default;
    }
}