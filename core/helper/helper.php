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
