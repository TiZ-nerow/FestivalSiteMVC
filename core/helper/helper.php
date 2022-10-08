<?php

function config($file)
{
    $path = ROOT . '/config/' . $file . '.php';

    if (!file_exists($path))
        return null;

    return require $path;
}
