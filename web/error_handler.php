<?php

set_error_handler(
    function ($errno, $errstr, $errfile = null, $errline = null, $errcontext = [])
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error", true, 500);
        $dateTime = new DateTime();
        file_put_contents(__DIR__ . "/logs/error.log", "[{$dateTime->format("c")}] [$errno] $errstr in $errfile on line $errline\n", FILE_APPEND | LOCK_EX);
    }
);

set_exception_handler(
    function ($exception)
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error", true, 500);
        $dateTime = new DateTime();
        file_put_contents(__DIR__ . "/logs/error.log", "[{$dateTime->format("c")}] " . $exception->getMessage() . "\n", FILE_APPEND | LOCK_EX);
    }
);
