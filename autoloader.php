<?php

spl_autoload_register(
    function ($className)
    {
        if (stream_resolve_include_path($file = ("src/" . str_replace("\\", "/", $className) . ".php"))) {
            include $file;
        }
    }
);
