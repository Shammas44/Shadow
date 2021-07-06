<?php
declare (strict_types = 1);
namespace controllers;

class ClassAutoLoader
{
    public function autoLoader(string $className = '')
    {
        spl_autoload_register(function ($className) {
            $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
            require_once $className . '.php';
        });
    }
}
