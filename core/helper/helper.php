<?php

function config($args, $default = null)
{
    $path = ROOT . '/config';

    $res = null;

    foreach (explode('.', $args) as $arg) {
        $path .= '/' . $arg;
        if (!is_null($res))
            if (isset($res[$arg]))
                $res = $res[$arg];
            else
                return $default;
        else if (file_exists($path . '.php'))
            $res = require $path . '.php';
    }

    return $res;
}

function view($view, $args = [])
{
    require ROOT . '/public/views/' . php($view);
}

function php($name)
{
    return str_replace('.php', '', $name) . '.php';
}
